<?php
/**
 * Classe Ajax
 *
 * @package TutsupMVC
 * @since 0.1
 */

class AjaxModel
{


	public $db;



	public function __construct($db = false)
	{

		$this->db = $db;

	}


	public function getCountNotify($id)
	{


		$query = $this->db->query("SELECT count(*) as total FROM `wd_alertas` where status  = '1' and aluno_id = '$id' ");
		if (!$query) {
			return array();
		}

		$fetch = $query->fetch();

		return $fetch[total];


	}




	public function getNotify($id)
	{


		$query = $this->db->query("SELECT * FROM `wd_alertas` where aluno_id = '$id' order by ID DESC limit 0,8 ");
		if (!$query) {
			return array();
		}

		return $fetch = $query->fetchAll();


	}


	public function _markAlert()
	{

		$this->db->update('wd_alertas', 'ID', $_POST[id], array(

			'status' => 2,
		)
		);

	}




	public function getSells($modelSwap, $modelEmail)
	{


		die();


		$mysqli = new pdo('mysql:host=66.165.251.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');

		$res = $mysqli->query("Select
		a.id as id_skillsim,
		data_venda as data,
		data_ativacao,
		valor_recebido_dolar,
		valor_recebido_euro,
		valor_recebido_real,
		valor_recebido_credito,
		valor_recebido_debito,
		upper(codigo_chip) as iccid,
		if(destino='canada-mexico', 6, if(destino='eua', 5, if(destino='latina', 8, 3))) as local_uso,
		if(destino='canada-mexico', concat('CANMEX', periodo), if(destino='eua', concat('EUA', periodo), if(destino='latina', concat('AMI', periodo), concat('MUNDO', periodo)))) as plano,
		a.nome,
		voucher_id_purchase,
		f.nome as retirado,
		telefone as celular,
		if(valor_recebido_real>0, 5, if(valor_recebido_debito>0, 3, 2)) as forma_pagamento,
		if(valor_recebido_euro>0, 5, if(valor_recebido_dolar>0, 2, 1)) as moeda,
		valor_produto,
		valor_final_recebido as valor_pago,
		valor_desconto,
		cpf,
		CAST(periodo AS UNSIGNED)  as dias_uso,
		lower(a.email) as email,
		if(cpf_nota=0, 2, 1) as cpf_nota,
		a.email,
		observacoes,
		if(id_quiosque!=9999, b.nome  , id_quiosque) as local_venda,
		upper(c.nome) as atendente,
		a.aparelho,
		a.paises,
		d.nome as aeroporto,
		cpf_nota,
	    CONCAT(SUBSTR(data_venda, 7, 4),'-',SUBSTR(data_venda, 4, 2),'-',SUBSTR(data_venda, 1, 2),' ', SUBSTR(horario_venda, 1, 2),':', SUBSTR(horario_venda, 4, 2), ':00') as data_venda,
		datediff(CONCAT(SUBSTR(data_ativacao, 7, 4),'-',SUBSTR(data_ativacao, 4, 2),'-',SUBSTR(data_ativacao, 1, 2)), now()) as am

		from vendas a LEFT JOIN quiosques b on a.id_quiosque = b.id LEFT JOIN aeroportos d on b.id_aeroporto = d.id left join usuarios c on a.id_vendedor = c.id left join quiosques f on a.voucher_retirado_quiosque_id = f.id where a.id > 418 and datediff(date(CONCAT(SUBSTR(data_venda, 7, 4),'-',SUBSTR(data_venda, 4, 2),'-',SUBSTR(data_venda, 1, 2),' ', SUBSTR(horario_venda, 1, 2),':', SUBSTR(horario_venda, 4, 2), ':00')), now()) > -5 order by a.id ASC");



		$itens = $res->fetchAll(PDO::FETCH_ASSOC);


		foreach ($itens as $item):


			if (!$this->transactionExists($item[id_skillsim])):




				$query = $this->db->query("SELECT * FROM `wd_planos` where nome = '$item[plano]'");
				if ($query) {
					$data = $query->fetch();
				}
				$query2 = $this->db->query("SELECT * FROM `wd_ponto_de_venda` where " . ($item[local_venda] != '9999' ? "ponto = '$item[local_venda]'" : "ponto = '$item[retirado]'") . " ");
				if ($query2) {
					$data2 = $query2->fetch();
				}
				$query5 = $this->db->query("SELECT * FROM `wd_local_de_venda` where " . ($item[local_venda] != '9999' ? "local = '$item[aeroporto]'" : "ID = '9999'") . "  ");
				if ($query5) {
					$data5 = $query5->fetch();
				}

				$query3 = $this->db->query("SELECT * FROM `wd_atendentes` where upper(nome) = '$item[atendente]'");
				if ($query3) {
					$data3 = $query3->fetch();
				}





				$query4 = $this->db->query("SELECT a.*, b.*, a.fornecedor  fornecedor_simcard, b.fornecedor fornecedor_mdn, tipo_transacao FROM `wd_simcards` a left join wd_mdns b on a.id_associacao = b.ID left join wd_fornecedores c on a.fornecedor = c.ID where upper(simcard) =  '" . strtoupper($item[iccid]) . "'");

				if ($query4) {

					$data4 = $query4->fetch();

				}

				if (!$this->checkSim($item[iccid], $modelEmail, $item, $data3, $data2, $data5)):



				else:






					if ($data['am'] <= 1):


						if ($item[plano] == 'EUA10' || $item[plano] == 'EUA05'):


							$repatriar = $this->repatriar($item[dias_uso]);



						endif;



						if ($repatriar):
							$data4 = $repatriar;
						endif;


						/*if(!$data4[mdn]):

								$data4 = $this->getMDN($item[iccid]);

							endif;
							*/


						if (!$data4[mdn]):



							$query4 = $this->db->query("SELECT b.*, b.fornecedor fornecedor_mdn  from wd_planos a LEFT JOIN wd_mdns b on a.fornecedor = b.fornecedor  where a.ID = '$data[ID]' and b.status = '1' and if(b.fornecedor=7, if(b.fornecedor=7, if((select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), (select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), 0) < 36, a.ID>0) and if(qtd_dias<45, (a.qtd_dias+ if((select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), (select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn) , 0)) <= 45, a.ID>0), a.ID > 0) ORDER by liberado DESC LIMIT 1");

							if ($query4) {

								$data4 = $query4->fetch();





							}



						endif;

						if (!$data4[mdn]):

							$query4 = $this->db->query("SELECT b.*, b.fornecedor fornecedor_mdn  from wd_planos a LEFT JOIN wd_mdns b on a.fornecedor = b.fornecedor  where a.ID = '$data[ID]' and b.status = '1'  ORDER by liberado DESC LIMIT 1");

							if ($query4) {

								$data4 = $query4->fetch();


							}

						endif;




						if ($data4):

							$this->associate($data4[mdn], $item[iccid]);



						endif;

					endif; // Ativacao

					if ($item[local_venda] == '9999'):

						$getOrigin = $this->getCorp($item[voucher_id_purchase]);

					endif;

					$origem = ($item[local_venda] != '9999' ? 3 : ($getOrigin ? 4 : 2));



					$query = $this->db->insert('wd_transacoes', array(

						'id_skillsim' => $item[id_skillsim],
						'data_transacao' => $item[data_venda],
						'data_ativacao' => dateDB($item[data_ativacao]),
						'tipo' => 1,
						'atendente' => ($data3[ID] ? $data3[ID] : 60),
						'local_venda' => $data5[ID],
						'ponto_venda' => $data2[ID],
						'nome' => $item[nome],
						'celular' => $item[celular],
						'email' => $item[email],
						'documento' => $item[cpf],
						'plano' => $data[ID],
						'local_uso' => $item[local_uso],
						'dias_uso' => $item[dias_uso],
						'data_off' => getDataOff($item[data_ativacao], $item[dias_uso] - 1),
						'valor_plano' => formatPayment(($item[valor_produto] ? $item[valor_produto] : 0.00)),
						'forma_pagamento' => $item[forma_pagamento],
						'moeda' => $item[moeda],
						'desconto' => ($item[valor_recebido_desconto] ? formatMoney($item[valor_recebido_desconto]) : 0.00),
						'valor_pago' => formatMoney(($item[valor_pago] ? $item[valor_pago] : 0.00)),
						'valor_dolar' => formatMoney(($item[valor_recebido_dolar] ? $item[valor_recebido_dolar] : 0.00)),
						'valor_euro' => formatMoney(($item[valor_recebido_euro] ? $item[valor_recebido_euro] : 0.00)),
						'valor_real' => formatMoney(($item[valor_recebido_real] ? $item[valor_recebido_real] : 0.00)),
						'valor_debito' => formatMoney(($item[valor_recebido_debito] ? $item[valor_recebido_debito] : 0.00)),
						'valor_credito' => formatMoney(($item[valor_recebido_credito] ? $item[valor_recebido_credito] : 0.00)),
						'iccid' => strtoupper($item[iccid]),
						'mdn' => strtoupper($data4[mdn]),
						'observacao' => $item[observacoes],
						'emitir_nota' => $item[cpf_nota],
						'fornecedor_simcard' => ($data4[fornecedor_simcard] ? $data4[fornecedor_simcard] : 19),
						'fornecedor_mdn' => $data4[fornecedor_mdn],
						'aparelhos' => $item[aparelho],
						'paises' => $item[paises],
						'voucher' => ($item[local_venda] == 9999 ? $item[observacoes] : ''),
						'sa' => ($data4 ? '0' : 1),
						'repatriado' => ($repatriar ? '1' : 0),
						'origem' => $origem,
						'emitir_nota' => ($item[cpf_nota] ? '1' : 0),
						'detalhe' => ($getOrigin ? $getOrigin : $data5[sigla]),
						'tipo_transacao' => ($data4[tipo_transacao] ? $data4[tipo_transacao] : 2),

					)
					);

					if (!$query) {



						foreach ($item as $key => $it):

							$errors .= $key . ' : ' . $it . '<br>';

						endforeach;


						$data_ = array(

							'nome' => 'Administrador',
							'mensagem' => '<p>A transação com simcard ' . strtoupper($sim) . ' não pode ser importada!<br> Por favor verifique os dados abaixo</p>' . $errors . '',

						);

						//echo $modelEmail->_sendEmail($data_, 'Erro na integração', 'contato@webdim.com.br');


					}

					if ($data4):

						$this->setStatus($item[iccid]);

					endif;


				endif;

			endif;

			//$modelSwap->autoSwap(dateDB($item[data_ativacao]),1);
			//$modelSwap->autoSwap(dateDB($item[data_ativacao]),2);

			if ($repatriar):

				die();

			endif;

			unset($getOrigin);

		endforeach;



	}

	public function transactionExists($id)
	{

		$query = $this->db->query("SELECT count(*) as total FROM `wd_transacoes` where id_skillsim = '$id' ");
		if (!$query) {
			return array();
		}

		$fetch = $query->fetch();

		return $fetch[total];

	}


	public function associate($mdn, $simcard)
	{

		if ($mdn):


			$query = $this->db->query("SELECT *  FROM wd_simcards a left join wd_mdns b on a.id_associacao = b.ID  where mdn = '$mdn' and simcard = '$simcard' ");


			if (!$query->fetch()):


				$querySim = $this->db->query("SELECT * FROM wd_simcards a where id_associacao > 0 and simcard = '$simcard'  ");
				$dataSim = $querySim->fetch();

				if ($dataSim):

					$query = $this->db->update('wd_mdns', 'ID', $dataSim["id_associacao"], array(

						'status' => 1,
						'status_old' => '',

					)
					);

				endif;


				$query = $this->db->query("SELECT * FROM wd_mdns a where mdn = '$mdn' ");
				$data = $query->fetch();

				$query = $this->db->update('wd_simcards', 'simcard', $simcard, array(

					'id_associacao' => $data[ID],

				)
				);



			endif;
		endif;

	}


	public function setStatus($id)
	{



		$query = $this->db->query("SELECT a.status status_sim, b.status  status_mdn, id_associacao FROM wd_simcards a left join wd_mdns b on a.id_associacao = b.ID  where simcard = '$id'");
		$data = $query->fetch();



		$query = $this->db->update('wd_simcards', 'simcard', $id, array(

			'status' => 14,
			'status_old' => $data[status_sim],

		)
		);

		$query = $this->db->update('wd_mdns', 'ID', $data["id_associacao"], array(

			'status' => 19,
			'status_old' => $data[status_mdn],

		)
		);

	}


	public function getMDN($id)
	{


		$query = $this->db->query("SELECT a.*  FROM wd_importer a   where upper(a.simcard) = '" . strtoupper($id) . "' ");
		$data = $query->fetch();

		return $data;


	}




	public function checkSim($sim, $modelEmail, $item, $data3, $data2, $data5)
	{




		$query = $this->db->query("SELECT a.*  FROM wd_simcards a  where upper(a.simcard) = '" . strtoupper(trim($sim)) . "' ");
		$datas = $query->fetch();

		$if = $this->db->query("SELECT a.*  FROM wd_transacoes_erros a  where upper(a.iccid) = '" . strtoupper(trim($sim)) . "' ");
		$if = $if->fetch();



		if (!$datas):

			echo strtoupper($sim) . '<br>';

			if (!$if):

				$query = $this->db->insert('wd_transacoes_erros', array(

					'id_skillsim' => $item[id_skillsim],
					'data_transacao' => $item[data_venda],
					'atendente' => ($data3[ID] ? $data3[ID] : 60),
					'local_venda' => $data5[ID],
					'ponto_venda' => $data2[ID],
					'nome' => $item[nome],
					'iccid' => strtoupper($item[iccid]),
					//'erro' => $item[erro],
					//'descricao' => $item[detalhes],

				)
				);

			endif;

			$data_ = array(

				'nome' => 'Administrador',
				'mensagem' => 'O Simcard ' . strtoupper($sim) . ' não foi encontrado no sistema!<br> Por favor verifique para que a venda seja importada corretamente',
			);

			//$modelEmail->_sendEmail($data_, 'Erro na integração', 'diego.mmn@hotmail.com');


			return false;




		endif;

		return true;



	}


	public function repatriar($dias)
	{


		switch ($dias):

			case "10":

				$w = 'and (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) = 35';


				break;

			case "5":

				$w = 'and (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) >= 35 and (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) < 41';

				break;

		endswitch;



		$query = $this->db->query("select (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) as dias_uso, a.*, a.fornecedor fornecedor_mdn  from wd_mdns  a where fornecedor = 7 and status = 1 " . $w . " order by (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) DESC limit 1");


		$data = $query->fetch();



		if ($data):


			if (($dias + $data[dias_uso]) > 41):

				$this->db->update('wd_mdns', 'id', $data[ID], array('repatriado' => date('Y-m-d') . ' 00:00:00'));

			endif;

			return $data;

		endif;





	}

	public function getMdnByPlane($plano)
	{



		$query = $this->db->query("SELECT b.*, b.fornecedor fornecedor_mdn  from wd_planos a LEFT JOIN wd_mdns b on a.fornecedor = b.fornecedor  where a.ID = '$plano' and b.status = '1' and if(b.fornecedor=7, if(b.fornecedor=7, if((select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), (select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), 0) < 36, a.ID>0) and if(qtd_dias<45, (a.qtd_dias+ if((select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), (select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn) , 0)) <= 45, a.ID>0), a.ID > 0) ORDER by liberado ASC LIMIT 1");

		if ($query) {

			return $data = $query->fetch(PDO::FETCH_ASSOC);


		}

	}

	public function getCorp($id)
	{


		$t2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
		$query = $t2->query("select b.empresa as vendedor from purchases a left join usuarios b on a.id_vendedor = b.id where a.id = '$id' ");

		$data = $query->fetch();

		return $data[vendedor];
	}



	public function getCorpFix($v)
	{

		$t1 = new pdo('mysql:host=66.165.251.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');
		$query1 = $t1->query("SELECT d.nome as aeroporto, upper(trim(SUBSTRING_INDEX(observacoes, '-', 1))) as voucher, if(id_quiosque!=9999, b.nome  , id_quiosque) as local_venda, a.id  FROM vendas a LEFT JOIN quiosques b on a.id_quiosque = b.id LEFT JOIN aeroportos d on b.id_aeroporto = d.id");




		foreach ($query1 as $data):


			echo "SELECT * FROM `wd_local_de_venda` where " . ($data[local_venda] != '9999' ? "local = '$data[aeroporto]'" : "ID = '9999'") . " <br> ";

			$query5 = $this->db->query("SELECT * FROM `wd_local_de_venda` where " . ($data[local_venda] != '9999' ? "local = '$data[aeroporto]'" : "ID = '9999'") . "  ");
			if ($query5) {
				$data5 = $query5->fetch();
			}


			if ($data[local_venda] == '9999'):



				$t2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
				$query = $t2->query("SELECT b.empresa as vendedor FROM purchases a LEFT JOIN usuarios b ON a.id_vendedor = b.id where LOCATE('$data[voucher]', voucher) > 0 ");

				$data3 = $query->fetch();

				$getOrigin = $data3[vendedor];


			endif;



			$origem = ($data[local_venda] != '9999' ? 3 : ($getOrigin ? 4 : 2));


			$query = $this->db->update('wd_transacoes', 'id_skillsim', $data[id], array('origem' => $origem, 'detalhe' => ($getOrigin ? $getOrigin : $data5[local])));

			unset($getOrigin);
		endforeach;
	}


}
