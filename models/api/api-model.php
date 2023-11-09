<?php


class ApiModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;


	public function __construct( $db = false ) {

		$this->db = $db;
		$this->table = 'wd_client_rest';
		$this->tableTransacoes = 'wd_transacoes';
		$this->tableMdn = 'wd_mdns';

		self::checkCredentials();

	}

	public function checkCredentials(){


        $_POST  = $_REQUEST;



		if(!$_POST['customer']):

		$msg['code'] = '003';
		$msg['return'] = false;
		$msg['message'] = 'O customer não pode ser em branco!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;


		if(!$_POST['token']):



		$msg['code'] = '004';
		$msg['return'] = false;
		$msg['message'] = 'O token não pode ser em branco!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;


		$query = $this->db->query("SELECT count(*) as auth  FROM `".$this->table."` where login = '".$_POST['customer']."' and token = '".$_POST['token']."' ");
		if ( ! $query ) {
		return array();
		}

		$result = $query->fetch();

		if(!$result[auth]):

		$msg['code'] = '005';
		$msg['return'] = false;
		$msg['message'] = 'Acesso não permitido, credenciais inválidas!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;



		return ;

	}


	function getMdn(){




		$helper = $this->load_model('transacoes/transacoes-model');

		if(!$_POST['plano']):

		$msg['code'] = '006';
		$msg['return'] = false;
		$msg['message'] = 'O plano não pode estar vazio!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		endif;


		if($_POST[plano]==43 || $_POST[plano]==42):

		   	$repatriar =  $helper->repatriar($_POST[dias]);

		endif;

		if($repatriar):

			$data = $repatriar;

		endif;


		if(!$data):

		$data = $helper->GetMdnByPlane($_POST['plano']);

		endif;


		if($data):

		$query = $this->db->update($this->tableMdn, 'mdn', $_POST['mdn'], array(

		   'status' => 19,
		   'uso_externo' => 1

		));

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['data'] = $data;

		echo json_encode($msg);

		else:

		$msg['code'] = '002';
		$msg['return'] = false;
		$msg['message'] = 'Não foi encontrado nenhum MDN disponível';

		echo json_encode($msg);


		endif;

		die();

	}

	public function setStatus(){


		$lib = ($_POST['liberado']? array('liberado' => $_POST['liberado']) : array());


		$query = $this->db->update($this->tableMdn, 'mdn', $_POST['mdn'], array_merge(array(

		   'status' => $_POST['status'],
		   'uso_externo' => ($_POST['liberado']?0:1)

		), $lib));

		if($query):



		$msg['code'] = '001';
		$msg['return'] = true;


		echo json_encode($msg);


		else:


		$msg['code'] = '002';
		$msg['return'] = false;

		echo json_encode($msg);


		endif;

		die();

	}


	public function getTable(){



		if(!$_GET[table]):

		$msg['code'] = '007';
		$msg['return'] = false;
		$msg['info'] = 'O campo tabela não pode ficar vazio';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;

		$follow = array('wd_planos', 'wd_fornecedores', 'wd_atendentes', 'local_de_venda', 'wd_ponto_de_venda', 'wd_local_de_uso', 'wd_moedas');


		if(!in_array($_GET[table], $follow)):

		$msg['code'] = '008';
		$msg['return'] = false;
		$msg['info'] = 'Você não tem permissão para acessar essa tabela';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;


		$query = $this->db->query("SELECT * FROM ".$_GET[table]." ");

		if ( ! $query ) {
		return array();
		}

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		if($result):

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		endif;

	}

	function getReportTransacion(){


		$data = $this->db->query("select * from wd_transacoes where local_venda = 10");



		if(!$_POST['data_inicial']):

		$msg['code'] = '002';
		$msg['return'] = false;
		$msg['message'] = 'A data inicial não pode estar vazia!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		return;

		endif;


		if(!$_POST['data_final']):

		$msg['code'] = '002';
		$msg['return'] = false;
		$msg['message'] = 'A data final não pode estar vazia!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		return;

		endif;



		$sells = $this->db->query("select

		Concat('ven-',a.ID) as codVenda,
		format(valor_pago, 2, 'pt_BR') as total,
		date_format(a.data_transacao, '%d/%m/%Y  %H:%iHs') as data,
		b.nome as cod_produto,
		'plano_de_internet' as descricao,
		format(valor_pago, 2, 'pt_BR') as valor,
		1 as qtd

		from wd_transacoes a LEFT JOIN wd_planos b ON a.plano = b.ID where local_venda = '10' and datediff(data_transacao, date('2019-03-01')) >= 0 and date(data_transacao) between date('$_POST[data_inicial]') and date('$_POST[data_final]') ");

		$data  = $sells->fetchAll(PDO::FETCH_ASSOC);

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['data'] = $data;



		echo json_encode($msg);

		die();





	}

	function getReportSells(){

		$helper = MainController::load_model('transacoes/transacoes-model');
		$result = $helper->getList(true);



		if($result):

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		endif;

	}

	public function importTransaction(){

		if(!$_GET['ID']):

		$msg['code'] = '002';
		$msg['return'] = false;
		$msg['message'] = 'O ID da transação não pode estar vazio';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;

		$helper = MainController::load_model('transacoes/transacoes-model');
		$result = $helper->importTransaction($_GET[ID], true);


		if($result):

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		endif;

	}


	public function exportReport(){



		$helper = MainController::load_model('transacoes/transacoes-model');
		$result = $helper->exportReport($_GET[IDS], true);


		if($result):

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		endif;


	}

	public function cancelVoucher(){


		if(!$_GET['ID']):

		$msg['code'] = '002';
		$msg['return'] = false;
		$msg['message'] = 'O ID do voucher não pode estar vazio';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;


		$helper = MainController::load_model('relatorios/relatorios-model');
		$result = $helper->cancelVoucher($_GET[ID]);


		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['msg'] = 'Status alterado com sucesso';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);



	}


	public function cancelSell(){


		if(!$_GET['ID']):

		$msg['code'] = '002';
		$msg['return'] = false;
		$msg['message'] = 'O ID da transação não pode estar vazio';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

		die();

		endif;

		if(!$_GET['responsavel']):

			$msg['code'] = '002';
			$msg['return'] = false;
			$msg['message'] = 'O responsável pelo cancelamento não pode estar vazio!';

			echo json_encode($msg, JSON_UNESCAPED_UNICODE);

			die();

			endif;


		$helper = MainController::load_model('transacoes/transacoes-model');
		$result = $helper->cancelSell($_GET[ID], $_GET[responsavel]);


		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['msg'] = 'Venda cancelada com sucesso!';

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);



	}

	public function getNf(){

		$helper = $helper = $this->load_model('transacoes/transacoes-model');
		$result = $helper->getNfs();

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

	}


	public function getFaturas(){

		$helper = $helper = $this->load_model('transacoes/transacoes-model');
		$result = $helper->getFaturas();

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

	}


	public function getOptions(){

		$helper = $helper = $this->load_model('configuracoes/configuracoes-model');
		$result = $helper->getOptions($_GET[option], true);

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = $result;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

	}

	public function geraNota(){


			$date  = date("Y-m-d H:i:s");


		    foreach(explode(',', $_GET[ids]) as $id):

			$type = substr($id, 0, 1);

				if($type=='T'):

					$TID[] = substr($id, 1);

				else:

					$VID[] = substr($id, 1);

				endif;


			endforeach;




			$w = ($_GET[ids]=='full'?"WHERE (nota_d = 1 or emitir_nota = 1) AND (status_nota IS null OR status_nota = '0' ) AND origem !=2 AND DATEDIFF(data_transacao, DATE('2019-12-09')) >= 0":' where ID in ('.($TID?implode(',', $TID):"''").')');
			$w2 = ($_GET[ids]=='full'?"WHERE status_compra = '3' AND (status_nota IS null OR status_nota = '0' ) AND DATEDIFF(data_compra, DATE('2020-03-08')) >= 0":' where ID in ('.($VID?implode(',', $VID):"''").')');


			$data = $this->db->query("

			SELECT nome as Nome, if(documento,documento,cnpj) as 'CPF/CNPJ', valor_pago as VALOR, email as EMAIL, iccid as SIMCARD, date_format('$date' , '%d/%m/%Y') as 'DATA EMISSÃO' FROM wd_transacoes $w
			UNION
			SELECT nome as Nome, cpf as 'CPF/CNPJ', format(valor_total, 2) as VALOR, email as EMAIL, '' as SIMCARD, date_format('$date' , '%d/%m/%Y') as 'DATA EMISSÃO'FROM wd_vouchers $w2

			");


			$data = $data->fetchAll(PDO::FETCH_ASSOC);

			if($_GET[ids]=='full'):

			unset($TID, $VID);
			$dataID = $this->db->query("

			SELECT concat('T', ID) as ID FROM wd_transacoes $w
			UNION
			SELECT concat('V', ID) as ID from wd_vouchers $w2

			");

			$dataID = $dataID->fetchAll(PDO::FETCH_ASSOC);



			foreach($dataID as $items):

				$type = substr($items[ID], 0, 1);

					if($type=='T'):

						$TID[] = substr($items[ID], 1);

					else:

						$VID[] = substr($items[ID], 1);

					endif;


			endforeach;

			endif;


			$this->db->query("update wd_transacoes set status_nota = '2', data_nota = '".$date."' where ID in (".($TID?implode(',', $TID):"''").") ");
			$this->db->query("update wd_vouchers set status_nota = '2', data_nota = '".$date."' where ID in (".($VID?implode(',', $VID):"''").") ");

			$msg['code'] = '001';
			$msg['return'] = true;
			$msg['info'] = 'Notas geradas com sucesso!';
			$msg['data'] = $data;


			echo json_encode($msg, JSON_UNESCAPED_UNICODE);




	}

	public function getNfReport(){


		foreach(explode(',', $_GET[ids]) as $id):

			$type = substr($id, 0, 1);

				if($type=='T'):

					$TID[] = substr($id, 1);

				else:

					$VID[] = substr($id, 1);

				endif;


		endforeach;



		$data = $this->db->query("

		select nome as Nome, if(documento,documento,cnpj) as 'CPF/CNPJ', valor_pago as VALOR, email as EMAIL, iccid as SIMCARD, date_format(data_nota , '%d/%m/%Y') as 'DATA EMISSÃO' from wd_transacoes where ID in (".implode($TID).")
		UNION
		select nome as Nome, cpf as 'CPF/CNPJ', format(valor_total, 2) as VALOR, email as EMAIL, '' as SIMCARD, date_format(data_nota , '%d/%m/%Y') as 'DATA EMISSÃO' from wd_vouchers where ID in (".implode($VID).")

		");

			$msg['code'] = '001';
			$msg['return'] = true;
			$msg['info'] = 'Notas geradas com sucesso!';
			$msg['data'] = $data->fetchAll(PDO::FETCH_ASSOC);


			echo json_encode($msg, JSON_UNESCAPED_UNICODE);

	}

	public function emitirNota(){



		if($_POST[ids]):

		foreach(explode(',', $_POST[ids]) as $item):


			$type = substr($item, 0, 1);

			if($type=='T'):

			 $TID[] = substr($item, 1);

			else:

			 $VID[] = substr($item, 1);

			endif;


		endforeach;


		$query = $this->db->query("update wd_transacoes set status_nota = '3', responsavel_nota = '$_POST[responsavel]', data_nota = '".date("Y-m-d H:i:s")."' where ID in (".($TID?implode(',',$TID):"''").") ");
		$query = $this->db->query("update wd_vouchers set status_nota = '3', responsavel_nota = '$_POST[responsavel]', data_nota = '".date("Y-m-d H:i:s")."' where ID in (".($VID?implode(',',$VID):"''").") ");

		if($query):

			echo 'ok';

		endif;

		endif;


	}


}
