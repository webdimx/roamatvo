<?php
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class SwapModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;


	public function __construct( $db = false ) {

		$this->db = $db;
		$this->table = 'wd_swap';
		$this->tableTransacoes = 'wd_transacoes';
		$this->tableFornecedores = 'wd_fornecedores';
		$this->tableSwapTransacao = 'wd_swap_transacoes';
		$this->tableSIM = 'wd_simcards';
		$this->tableMDN = 'wd_mdns';
		$this->tableSIME = 'wd_mdn_excluidos';
		$this->tableTipo = 'wd_tipo_de_uso';
		$this->tableDataOff = 'wd_data_off';

		$notify = $this->load_model('relatorios/relatorios-model');
		$this->notify = $notify->checkNotify();
	}

	public function getList() {

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		echo $historico = $_GET[historico];

		unset($_GET[path], $_GET[p], $_GET[debug], $_GET[historico]);



		foreach($_GET as $key => $search):

		  if($search){

		  switch($key):

		  	case"ID":
		  	  $qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  	break;

			case"email":

				$qs .= str_replace('|','.', $key)." = '".$search."' and ";

		  	break;

			case"valor":

				$qs .=  $key." = '".formatMoney($search)."' and ";

		  	break;

			case"data_ativacao":

				$search = explode('-', $search);

			  	if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;

		  	break;

			case"data_transacao":

				$search = explode('-', $search);

			  	if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;

		  	break;

			case"a|status":

				$qs .= str_replace('|','.', $key)." = '".$search."' and ";

		  	break;

			case"todos":

				$qs .=  "a.ID <> '0' and ";

		  	break;

			default:
			  $qs .= str_replace('|','.', $key)." like '%".$search."%' and ";
		  	break;

		  endswitch;

		  }

		endforeach;

		$qs = ($qs)?'and '.substr($qs, 0, -4):'';



		$query = $this->db->query('SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao,  date_format(a.data_transacao, "%d/%m/%Y %H:%iHs") as data_transacao, date_format(a.data_off, "%d/%m/%Y") as data_off, IF(status=1, "Ativação", "Desativação") as tipo_swap, date_format(a.data_transacao, "%d/%m/%Y  %H:%iHs") as data_transacao,
		e.nome as fornecedor_simcard,
		f.nome as fornecedor_mdn,
		g.nome as atendente,
		h.`local` as local_venda,
		i.ponto as ponto_venda,
		j.local as local_uso,
		k.forma_pagamento as forma_pagamento,
		l.moeda as moeda  FROM '.$this->tableTransacoes.' a

		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN '.($historico?'wd_mdn_excluidos':'wd_mdn').' c ON  a.iccid = c.simcard

		LEFT JOIN wd_fornecedores e ON c.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON c.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID


		where sa = "0" and a.status  in(1,3)  '.($qs?$qs:'and (datediff(data_ativacao, now()) <= "0" or datediff(data_off, now()) <= "0")').' ORDER BY a.ID DESC '.($page?"LIMIT ".($page - 1) * 20 .",20":"").'');

		$count = $this->db->query('SELECT * FROM '.$this->tableTransacoes.' a LEFT JOIN wd_planos b ON a.plano = b.ID where sa = "0" and status  in(1,3)  '.($qs?$qs:'and (datediff(data_ativacao, now()) = "0" or datediff(data_off, now()) = "0")').' ');



		if ( ! $query ) {
			return array();
		}

		$fetch = $query->fetchAll();


		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);
	}

	public function getListSwaps(){

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		unset($_GET[path], $_GET[p], $_GET[debug]);

		foreach($_GET as $key => $search):

		  if($search){

		  switch($key):

		  	case"ID":
		  	  $qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  	break;

			case"fornecedor":

				$qs .= $key." = ".substr($search, 0 ,-1)."' and ";

		  	break;

			case"valor":

				$qs .=  $key." = '".formatMoney($search)."' and ";

		  	break;

			case"data":

				$search = explode('-', $search);

			  	if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;

		  	break;

			case"a|status":

				$qs .= str_replace('|','.', $key)." = '".$search."' and ";

		  	break;

			case"todos":


			  		$qs .=  "";


		  	break;

			default:
			  $qs .= str_replace('|','.', $key)." like '%".$search."%' and ";
		  	break;

		  endswitch;

		  }

		endforeach;

		$qs = ($qs)?'and '.substr($qs, 0, -4):'';



		$query = $this->db->query("Select a.*, date_format(data, '%d_%m_%Y') as data, date_format(data, '%d/%m/%Y') as swap_data,  concat(date_format(data, '%H_%i'),'hr') as hora, c.nome as name    FROM $this->table  a LEFT JOIN users b ON a.usuario = b.user_id left join wd_colaboradores c on b.entity_id = c.ID ".($qs?"where a.ID > '0' ". $qs:($_GET[todos]?'':"where  datediff(now(), data) = 0"))." Order by a.ID desc ".($page?"LIMIT ".($page - 1) * 20 .",20":"")." ");
		$count = $this->db->query("Select * FROM $this->table ".($_GET[todos]?'':"where  datediff(now(), data) = 0")."");


		if ( ! $query ) {
			return array();
		}

		$fetch = $query->fetchAll();

		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);

	}



	public function getRegistry($id) {

		$query = $this->db->query("SELECT a.*, date_format(data, '%d_%m_%Y') as data, concat(date_format(data, '%H_%i'),'hr') as hora  FROM `".$this->table."` a   where a.ID = '".$id."' ");
		if ( ! $query ) {
		return array();
		}


		return $query->fetchAll();
	}

	public function getSwapItens($id){


		$query = $this->db->query("select a.*, c.tipo, b.iccid, b.mdn, date_format(b.data_ativacao, '%d/%m/%Y') as data_ativacao, date_format(b.data_off, '%d/%m/%Y') as data_desativacao, b.data_ativacao as da, b.nome,d.nome as plano, dias_uso as dias, concat(date_format(c.data, '%H_%i'),'hr') as hora from wd_swap_transacoes a LEFT JOIN wd_transacoes b ON a.id_transacao = b.ID   LEFT JOIN wd_swap c ON a.id_swap = c.ID LEFT JOIN wd_planos d on b.plano = d.ID where id_swap = '$id' ");
		if ( ! $query ) {
		return array();
		}

		return $query->fetchAll();



	}

	public function getLastInfo($id, $mdn, $tipo){



		$query = $this->db->query("SELECT *,  date_format(".($tipo==1?'data_ativacao':'data_off').", '%d/%m/%Y') as data_ativacao, date_format(".($tipo==1?'data_off':'data_off').", '%d/%m/%Y') as data_off FROM wd_transacoes WHERE ID = (SELECT ID FROM wd_transacoes WHERE datediff(".($tipo==1?'data_ativacao':'data_off').", '$id') < 0 and  mdn = '$mdn' ORDER BY ".($tipo==1?'data_ativacao':'data_off')." DESC LIMIT 1) ");
		if ( ! $query ) {
		return array();
		}

		return $query->fetch();



	}

	public function getSwapPendent(){

		if($_POST[selecionados]):

		 $sel = "and a.ID in (".implode(',', json_decode($_POST[ids])).")";

		endif;

		foreach(json_decode($_POST[fornecedores]) as $fornecedores):

		if($_POST[tipo] == 1):

			$date = "and datediff(data_ativacao, now()) <= ".($_POST['nextDay']?1:0)."";

		else:

			$date = "and (datediff(date_add(date(data_off), Interval if(adiar, adiar, 0) day), now()) <= ".($_POST['nextDay']?1:0)." or tipo = 3 )";

		endif;



		$query = $this->db->query("SELECT a.*,  concat(date(data_ativacao), ' ', TIME(NOW())) data_ativacao, concat(b.nome,'/',c.nome) as fornecedores  FROM `".$this->tableTransacoes."` a LEFT JOIN ".$this->tableFornecedores." b ON a.fornecedor_simcard = b.ID LEFT JOIN ".$this->tableFornecedores." c ON a.fornecedor_mdn = c.ID  where Concat(fornecedor_simcard,'-', fornecedor_mdn) in (".$fornecedores.") and  ".($_POST[tipo]==1? 'status in(1)' :($_POST['nextDay']?'status in(2,3)':'status in(3)'))." $date $sel ");




		if ( ! $query ) {
		return array();
		}




		$fetch = $query->fetchAll();





		$query = $this->db->insert($this->table, array(

			'tipo' => $_POST[tipo],
			'qtd_lote' => count($fetch),
			'fornecedor' => $fornecedores,
			'usuario' => $_SESSION['userdata']['user_id']

		));



		$last_id = $this->db->last_id;

		foreach($fetch as $data):

			$this->db->update($this->tableTransacoes, 'ID', $data[ID], array(
				'status' => ($_POST[tipo]==1?2:4)
			));

			if ($_POST[tipo]==1) {
				$this->db->update($this->tableTransacoes, 'ID', $data[ID], array(
					'data_ativacao' => $data['data_ativacao'],
				));
			}



			$q = $this->db->insert($this->tableSwapTransacao, array(

				'id_swap' => $last_id,
				'id_transacao' => $data[ID],


			));

			if($_POST[tipo]==1):

			$query = $this->db->update($this->tableSIM, 'simcard', $data[iccid], array(

			'status' => 2,
			'status_old' => ''

			));

			$query = $this->db->update($this->tableMDN, 'mdn', $data[mdn], array(

			'status' => 6,
			'status_old' => ''

			));

		    else:

			$this->setStatus($data[iccid], $data[mdn],  $data[ID]);

			endif;



		endforeach;

		endforeach;



		echo  'success';

	}

	public function getFornecedores(){



		if($_POST[selecionados]):

		 $sel = "and a.ID in (".implode(',', json_decode($_POST[ids])).")";

		endif;



		$query = $this->db->query("select a.*, b.*, Concat(b.nome,'/', c.nome) as fornecedor, Concat(b.ID,'-', c.ID) as ID from `".$this->tableTransacoes."` a LEFT JOIN ".$this->tableFornecedores." b ON a.fornecedor_simcard = b.ID LEFT JOIN ".$this->tableFornecedores." c ON a.fornecedor_mdn = c.ID where sa = '0' and   ".($_POST[tipo]==1? 'status in(1)' :($_POST[adiar]?'status in(2,3)':'status in(3)'))."  and ".($_POST[tipo]==1?"datediff(data_ativacao,now() ) <= ".($_POST[adiar]?1:0)." ":"(datediff(date_add(date(data_off), Interval if(adiar, adiar, 0) day), now()) <= ".($_POST[adiar]?1:0)." or tipo = 3)")."  $sel group by Concat(fornecedor_simcard,'/', fornecedor_mdn)  ");
		if ( ! $query ) {
		return array();
		}

		$fetch = $query->fetchAll();

		return $fetch;

	}


	public function setStatus($iccid, $mdn, $id_transacao){



		$query = $this->db->query("SELECT a.*, b.codigo as cod  FROM `".$this->tableSIM."` a LEFT JOIN `".$this->tableMDN."` c ON a.id_associacao = c.ID  LEFT JOIN ".$this->tableTipo." b ON c.tipo_uso = b.ID   where a.simcard = '".$iccid."' ");
		$data = $query->fetch();


		switch($data[cod]):

			case"1":

			  $mdns = 3;

			break;

			case"2":

			  $mdns = 1;

			break;

			case"3":

			 $mdns = 1;

			break;

			case"4":

			 $mdns = 1;

			break;

		    default:

			  $mdns = 1;

			break;



		endswitch;

		$query = $this->db->query("select * from wd_mdns where mdn = '$mdn' ");

		$sim = $query->fetch();



		/*$query = $this->db->insert($this->tableSIME, array(

			    'id_transacao' => $id_transacao,
				'simcard' => $sim[simcard],
				'mdn' => $sim[mdn],
				'codigo_uso' => $sim[codigo_uso],
				'fornecedor_simcard' => $sim[fornecedor_simcard],
				'fornecedor_mdn' => $sim[fornecedor_mdn],
				'status_mdn' => $mdns,
				'status_simcard' => 3,
				'tipo_uso' => $sim[tipo_uso],
				'local_estoque' => $sim[local_estoque],
				'lote' => $sim[lote],
				'observacoes' => $sim[observacoes],
				'data' => $sim[data],

		));*/


		if(!$query):

		   /*var_dump(array(

			    'id_transacao' => $id_transacao,
				'simcard' => $sim[simcard],
				'mdn' => $sim[mdn],
				'codigo_uso' => $sim[codigo_uso],
				'fornecedor_simcard' => $sim[fornecedor_simcard],
				'fornecedor_mdn' => $sim[fornecedor_mdn],
				'status_mdn' => $mdns,
				'status_simcard' => 3,
				'tipo_uso' => $sim[tipo_uso],
				'local_estoque' => $sim[local_estoque],
				'lote' => $sim[lote],
				'observacoes' => $sim[observacoes],
				'data' => $sim[data],

		));
		*/


		endif;



		if($mdns==1):


				$query = $this->db->update($this->tableSIM, 'simcard', $iccid, array(


					'status' => 3,
					'id_associacao' => 0,

				));


				$query = $this->db->update($this->tableMDN, 'mdn', $mdn, array(


					'status' => 1,
					'liberado' => date('Y-m-d H:i:s'),


				));


		else:

				$query = $this->db->update($this->tableSIM, 'simcard', $iccid, array(


					'status' => 3,

				));


				$query = $this->db->update($this->tableMDN, 'mdn', $mdn, array(


					'status' => 3,


				));


		endif;




	}


	public function geraDataOff(){

		/*$query = $this->db->query("select * from wd_transacoes where datediff(data_off + Interval if(adiar>0, adiar, 0) Day, now()) <= '0' and status = '2' ");
		$data = $query->fetchAll();

		foreach($data as $item):

			$query = $this->db->update($this->tableTransacoes, 'ID', $item[ID], array(

				'status' => 3,

			));

			$query = $this->db->insert($this->tableDataOff, array(

				'id_transacao' => $item[ID],

			));

		  	$query = $this->db->update($this->tableSIM, 'simcard', $item[iccid], array(

			'status_simcard' => 12,

			));

			$query = $this->db->update($this->tableMDN, 'mdn', $item[mdn], array(

			'status_mdn' => 20,

			));

		endforeach;*/


	}

	public function geraDataOffDayAfter(){

		$query = $this->db->query("select * from wd_transacoes where datediff(data_off + Interval if(adiar>0, adiar, 0) Day, now()) <= '0' and status = '2' ");
		$data = $query->fetchAll();

		foreach($data as $item):

			$query = $this->db->update($this->tableTransacoes, 'ID', $item[ID], array(

				'status' => 3,

			));

			$query = $this->db->insert($this->tableDataOff, array(

				'id_transacao' => $item[ID],

			));

		  	$query = $this->db->update($this->tableSIM, 'simcard', $item[iccid], array(

			'status_simcard' => 12,

			));

			$query = $this->db->update($this->tableMDN, 'mdn', $item[mdn], array(

			'status_mdn' => 20,

			));


		endforeach;

		$query = $this->db->query("select Concat(b.ID,'-', c.ID) as ID from `".$this->tableTransacoes."` a LEFT JOIN ".$this->tableFornecedores." b ON a.fornecedor_simcard = b.ID LEFT JOIN ".$this->tableFornecedores." c ON a.fornecedor_mdn = c.ID where sa = '0' and   status in(3)  and (datediff(date_add(date(data_off), Interval if(adiar, adiar, 0) day), now()) <= 0 or tipo = 3)  group by Concat(fornecedor_simcard,'/', fornecedor_mdn)  ");

		if ( ! $query ) {
		return array();
		}
		$fetch = $query->fetchAll();

		foreach($fetch as $id){
			$ids[] = "'$id[ID]'";
		}

		$_POST['fornecedores'] = json_encode($ids);
		$_POST['tipo'] = 2;

		$this->getSwapPendent();

	}

	public function sameRegistry($mdn, $simcard){

		$query = $this->db->query("select * from wd_mdn where mdn = '$mdn' and simcard = '$simcard'");
		$data = $query->fetch();

		return $data;

	}

	public function getFornecedor($id){


		$query = $this->db->query("select nome from wd_fornecedores where ID in($id) ");


		if ( ! $query ) {
		return array();
		}
		$data = $query->fetchAll();
		return $data[0][nome].'/'.($data[1][nome]?$data[1][nome]:$data[0][nome]);

	}

	public function getFornecedorList(){

		$for = array();
		$query = $this->db->query("select * from wd_swap group by fornecedor");
		$data = $query->fetchAll();

		foreach($data as $item):

			$f = $this->getFornecedor(str_replace(array("'", '-'), array('',','), $item[fornecedor]));
		    array_push($for, array($item[fornecedor] , $f));

		endforeach;



		return($for);

	}

	public function getLoteAtivacao($id){


		$query = $this->db->query("Select a.*, date_format(data, '%d_%m_%Y') as data, date_format(data, '%d/%m/%Y') as swap_data  FROM $this->table a LEFT JOIN $this->tableSwapTransacao b on a.ID = b.id_swap where tipo = '1' and id_transacao =  '$id'  " );

		if ( ! $query ) {

			return array();
		}

		$_item =  $query->fetch();

		if($_item):

		return '<a href="'.HOME_URI.'swap/detalhe/'.$_item[ID].'">SWAP Lote:'.$_item[ID].'-'.$this->getFornecedor(str_replace(array("'", '-'), array('', ','), $_item[fornecedor])).'-'.$_item[data].'</a>';

		else:

		return 'Não gerado';

		endif;

	}

	public function getLoteDesativacao($id){


		$query = $this->db->query("Select a.*, date_format(data, '%d_%m_%Y') as data, date_format(data, '%d/%m/%Y') as swap_data  FROM $this->table a LEFT JOIN $this->tableSwapTransacao b on a.ID = b.id_swap where tipo = '2' and id_transacao =  '$id'  " );

		if ( ! $query ) {

			return array();
		}

		$_item =  $query->fetch();

		if($_item):

		return '<a href="'.HOME_URI.'swap/detalhe/'.$_item[ID].'">SWAP Lote:'.$_item[ID].'-'.$this->getFornecedor(str_replace(array("'", '-'), array('', ','), $_item[fornecedor])).'-'.$_item[data].'</a>';

		else:

		return 'Não gerado';

		endif;

	}


	public function checkStatus(){

		$query = $this->db->query("select * from wd_mdn where fornecedor_mdn = '7' ");
		$data = $query->fetchAll();

		foreach($data as $item):

			$query2 = $this->db->query("select * from wd_transacoes where mdn = '$item[mdn]' order by ID DESC limit 1 ");
			$data2 = $query2->fetch();

			echo $item[mdn].' - '.$data2[status].'<br>';

			if($data2[status]==4){


				$query = $this->db->update($this->tableSIM, 'mdn', $item[mdn], array(

					'simcard' => '',
					'status_mdn' => 1,
					'codigo_uso' => '',
					'simcard' => '',
					'fornecedor_simcard' => '',
					'local_estoque' => '',
					'status_simcard' => '',
					'status_simcard_old' => ''

				));



			}

		endforeach;

	}



}
