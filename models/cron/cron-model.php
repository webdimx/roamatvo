<?php
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class CronModel extends MainController
{




	public function __construct($db = false)
	{

		$this->db = $db;

	}

	public function replicateTable()
	{


		$t2 = new pdo('mysql:host=mysql08-farm1.kinghost.net;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');

		$fields = array("data_compra", "cod_referencia", "forma_pagamento", "sedex", "voucher", "nome", "email", "cpf", "cupom", "valor_dolar", "valor_total", "valor_frete", "status_compra", "simcard", "data_venda", "vendedor", "gateway", "moeda");


		$query = $t2->query("select a.*, b.empresa as vendedor, b.empresa as vendedor, c.empresa as vendedor_responsavel,   if(b.empresa IS NULL OR tipo_vendedor = 'skillsim_corp' , '1', '2') AS origem from purchases a left join usuarios b on a.id_vendedor = b.id LEFT JOIN usuarios c ON b.vendedor_responsavel = c.id  where a.id > '" . ($this->getLastID() ? $this->getLastID() : 0) . "' and voucher > ''  ");


		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		//$this->db->insert($this->table, array());



		foreach ($data as $data1):




			$vb = explode('+', $data1[valor_net]);


			unset($dat);

			$dat[origem] = $data1[origem];
			$dat[valor_frete] = $data1[origem];
			$dat[id_voucher] = $data1[id];
			$dat[gateway] = ($data1[getway] == 'PagSeguro' ? 'PagSeguro' : ($data1[getway] == 'AuthorizeNet' ? 'AuthorizeNet' : 'Faturado'));
			$dat[valor_base] = formatMoney(trim($vb[0]));
			$voucher = explode('+', trim($data1[voucher]));
			$plano = explode('+', trim($data1[regiao]));
			$dias = explode('+', trim($data1[periodo]));



			$a = 0;

			foreach ($voucher as $v):


				switch (trim($plano[$a])):

					case "canada-mexico":

						$plano = $this->getPlan('CANMEX' . trim($dias[$a]));


						break;

					case "usa":

						$plano = $this->getPlan('EUA' . trim($dias[$a]));

						break;

					case "other":


						$plano = $this->getPlan('MUNDO' . trim($dias[$a]));

						break;

					case "latina":

						$plano = $this->getPlan('AMI' . trim($dias[$a]));

						break;

					case "europe":

						$plano = $this->getPlan('EUROPA' . trim($dias[$a]));

						break;

				endswitch;



				$dat[plano] = $plano[ID];
				$dat[valor_plano] = $plano[valor];



				foreach ($data1 as $key => $data2):


					if (in_array($key, $fields)):



						if ($key == 'data_compra'):

							$dat[$key] = $this->fixDate($data2);

						elseif ($key == 'voucher'):

							$dat[$key] = $this->fixDate($data2);

						elseif ($key == 'valor_frete'):



							$dat[$key] = ($data2 ? $data2 : 0.00);

						elseif ($key == 'valor_net'):

							$dat[$key] = trim($vb[$a]);



						elseif ($key == 'valor_total'):

							$dat[$key] = $data2 / count($voucher);

						else:


							$dat[$key] = $data2;

						endif;


					endif;

				endforeach;





				$query = $this->db->insert("wd_vouchers", $dat);




				$this->rescueVoucher($dat[id_voucher], trim($v));
				//var_dump($dat);
				$a++;
			endforeach;


		endforeach;







	}

	public function getPendentRescue()
	{

		$query = $this->db->query("select * from wd_vouchers where resgatado = '1' ");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $dat):

			$this->rescueVoucher($dat[id_voucher], $dat[voucher]);
			$this->voucherHelper($dat[id_venda]);

		endforeach;

	}


	public function getPendentVoucher()
	{

		$query = $this->db->query("select * from wd_vouchers where completo = '1' and resgatado = '2' ");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $dat):

			$this->voucherHelper($dat[id_venda]);

		endforeach;

	}


	public function getPendentNet()
	{

		die();

		$query = $this->db->query("select * from wd_vouchers where  resgatado = '2' and valor_base = 0.00 AND simcard > 0 AND vendedor IS NOT null");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $dat):


			$t1 = new pdo('mysql:host=66.165.234.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');
			$t2 = new pdo('mysql:host=mysql08-farm1.kinghost.net;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');


			$query = $t1->query("select periodo, destino from vendas where LOCATE('" . substr($dat[voucher], 0, -2) . "', observacoes) > 0 ");
			$data = $query->fetch();


			$query2 = $t2->query("SELECT price FROM purchases a LEFT JOIN usuarios b ON a.id_vendedor = b.id LEFT JOIN preco_net c ON b.id_net = c.id_net WHERE a.id = '$dat[id_voucher]'  AND c.region = '" . ($data[destino] == 'eua' ? 'usa' : $data[destino]) . "' AND days = '$data[periodo]'");

			$data2 = $query2->fetch();

			$query = $this->db->update('wd_vouchers', 'id_voucher', $dat[id_voucher], array('valor_base' => ($data2[price] ? formatMoney($data2[price]) : '0.00')));

			//echo ($data2[price]?formatMoney($data2[price]):0.00).'<br>';

			//return;


		endforeach;

	}

	public function fixDate($date)
	{

		$date = explode(' ', $date);
		$hour = $date[1];
		$date = explode('-', $date[0]);

		return $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . $hour;

	}

	public function rescueVoucher($id, $voucher)
	{

		echo "select * from vendas where LOCATE('" . substr($voucher, 0, -2) . "', observacoes) > 0<br>";


		$t1 = new pdo('mysql:host=66.165.234.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');



		$query = $t1->query("select * from vendas where LOCATE('" . substr($voucher, 0, -2) . "', observacoes) > 0");
		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data):
			$field = array('data_retirada' => dateDB($data[data_venda]), 'id_venda' => $data[id], 'simcard' => $data[codigo_chip], 'resgatado' => 2);
			$query = $this->db->update('wd_vouchers', 'voucher', $voucher, $field);

			$this->voucherHelper($data[id]);
			//$this->getNetPrice($data[voucher_id_purchase]);



		endif;

	}


	public function voucherHelper($id)
	{

		if ($id):

			$queryHelper = $this->db->query("select * from wd_transacoes where id_skillsim = '$id' ");
			$helper = $queryHelper->fetch(PDO::FETCH_ASSOC);

			if ($helper):
				$field = array('plano' => $helper[plano], 'ponto_entrega' => $helper[ponto_venda], 'completo' => 2);
				$query = $this->db->update('wd_vouchers', 'id_venda', $id, $field);
			endif;

		endif;

	}

	public function getNetPrice($id)
	{


		/*$t1 = new pdo('mysql:host=66.165.251.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');
					$t2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');

					$query = $t1->query("select periodo, destino from vendas where voucher_id_purchase = '$id' ");
					$data = $query->fetch();



					$query2 = $t2->query("SELECT price FROM purchases a LEFT JOIN usuarios b ON a.id_vendedor = b.id LEFT JOIN preco_net c ON b.id_net = c.id_net WHERE a.id = '$id'  AND c.region = ".($data[destino]=='eua'?'usa':$data[destino])."'' AND days = '$data[periodo]'");

					$data2 = $query2->fetch();

					$query = $this->db->update('wd_vouchers', 'id_voucher', $id, array('valor_base' => ($data2[price]?formatMoney($data2[price]):'0.00')));

					//return $data2[price];*/

	}

	public function getStatus()
	{

		$t = new pdo('mysql:host=mysql08-farm1.kinghost.net;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');

		$query = $this->db->query("SELECT * FROM wd_vouchers WHERE status_compra not IN (3,4,10) or status_compra IS NULL");
		$data = $query->fetchAll();

		foreach ($data as $dat):


			$query2 = $t->query("select * from purchases where id = '$dat[id_voucher]' ");
			$data2 = $query2->fetch();


			$query = $this->db->update('wd_vouchers', 'id_voucher', $dat[id_voucher], array('status_compra' => $data2[status_compra]));


		endforeach;


	}

	public function getLastID()
	{


		$query = $this->db->query("select * from wd_vouchers order  by id_voucher desc limit 1 ");
		$data = $query->fetch(PDO::FETCH_ASSOC);



		return $data[id_voucher];


	}


	public function sendSmsAlert($int)
	{

		$query = $this->db->query("SELECT a.*, b.*, a.ID as os_id from `so_orders` a LEFT JOIN so_clients b ON a.cliente = b.ID where a.tipo = '2' and data_finalizacao != '' and DATEDIFF(a.agendamento, NOW()) = '$int' ORDER BY a.ID DESC");


		if (!$query):
			return array();
		endif;

		return $query->fetchAll();



	}

	public function sendSurvey($int)
	{


		$query = $this->db->query("SELECT a.*, b.*, a.ID as os_id from `so_orders` a LEFT JOIN so_clients b ON a.cliente = b.ID where a.tipo = '2' and data_finalizacao != '' and DATEDIFF(NOW(), a.data_finalizacao) = '$int' ORDER BY a.ID DESC");

		if (!$query):
			return array();
		endif;

		return $query->fetchAll();

	}


	public function sync()
	{




	}


	public function getPlan($p)
	{


		$query = $this->db->query("SELECT * FROM `wd_planos` where nome = '$p'  ");
		if ($query) {
			$data = $query->fetch();
		}



		return $data;

	}


	public function autoSwap()
	{

		$model = $this->load_model('api/cmovel-model');
		$model->active();


	}


	public function getBalance()
	{

		$model = $this->load_model('api/cmovel-model');
		$model->getBalance();

	}

	public function getCountry()
	{

		$model = $this->load_model('api/cmovel-model');
		$model->getCountry();

	}

	public function recharge()
	{

		$model = $this->load_model('api/cmovel-model');
		$model->recharge();

	}

	public function generateDailyReport()
	{


		$model = $this->load_model('relatorios/relatorios-model');
		$modelEmail = $this->load_model('email/email-model');
		$file = $model->getSellersByDay();

		$data['login'] = 'financeiro@swapskillsim.com.br';
		$data['server'] = 'mail.swapskillsim.com.br';
		$data['password'] = 'Zgzr19yh@';
		$data['port'] = '587';
		$data['template'] = ABSPATH . '/views/email/report.html';
		$data['date'] = date('d/m/Y');

		$send = $modelEmail->_sendEmail($data, 'Relatório Diário Aeroporto ' . date("d/m/Y"), 'laniel@skillsim.com', $file, 'junior@skillsim.com');

	}


}
