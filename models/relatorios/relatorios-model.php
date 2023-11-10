<?php

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class RelatoriosModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;


	public function __construct($db = false)
	{

		$this->db = $db;
		$this->table = 'wd_financeiro';
		$this->tableStudent = 'wd_alunos';
		$this->sellPoint = 0;
		$this->ponto;
		//self::markPast();
	}



	public function SellReport($tipo)
	{

		if ($tipo == 'site'):

			$qs .= "a.origem = '1' and ";

		else:

			$qs .= "a.origem = '2' and ";

		endif;

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		unset($_GET[path], $_GET[p]);

		if ($_GET[sedex] == '0'):

			$qs .= str_replace('|', '.', 'sedex') . " = '" . $_GET[sedex] . "' and ";

		endif;

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):


					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;



					case "x|atendente":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "valor_total":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "data_compra":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_retirada":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "valor_base":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor_frete":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor_venda":

						$qs .= "format(valor_frete/a.valor_dolar,2, 'en_US') = '" . formatMoney($search) . "' and ";

						break;




					case "a|valor_dolar":

						$qs .= str_replace('|', '.', $key) . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor_total":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor_base_real":

						$qs .= "(valor_base*a.valor_dolar)  = '" . formatMoney($search) . "' and ";

						break;

					case "ponto_entrega":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "status_compra":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "resgatado":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "resgatado":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "vendedor":

						$qs .= $key . (strtolower($search) == 'site' ? ' is null and ' : " like '%" . trim($search) . "%' and ");

						break;



					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . trim($search) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';



		$query = $this->db->query("SELECT a.*, b.nome AS plano, if(sedex=1, 'Sedex', c.ponto) AS ponto_venda,   if(sedex=1, 'Sedex', 'Retirada no Quiosque') as retirada,  date_format(a.data_compra, \"%d/%m/%Y %H:%i:%s\") as data_compra, date_format(a.data_retirada, \"%d/%m/%Y\") as data_retirada,
		format(a.valor_plano,2,'en_US') as valor_plano, CONCAT('', format(valor_base,2,'en_US')) AS valor_base,
		CONCAT('', format((valor_base*a.valor_dolar),2,'en_US')) AS valor_base_real,
		CONCAT('', FORMAT(a.valor_dolar,2,'en_US')) AS valor_dolar,
		if(a.moeda='dolar', format((valor_total*a.valor_dolar), 2, 'en_US'), CONCAT('', format(valor_total,2,'en_US'))) AS valor_total_real,
		if(a.moeda='dolar', CONCAT('', valor_total), '') AS valor_total_dolar,
		if(a.moeda='dolar', CONCAT('', format(((valor_total*a.valor_dolar)-if(valor_frete>0 and sedex=1, valor_frete, '0.00')),2,'en_US')), CONCAT('', format((valor_total-if(valor_frete>0 and sedex=1, valor_frete, '0.00')),2,'en_US'))) AS valor_venda_real,
		if(a.moeda='dolar', CONCAT('', format(valor_total-if(valor_frete>0 and sedex=1, format(valor_frete/a.valor_dolar,2, 'en_US'), '0.00'), 2, 'en_US')), '') AS valor_venda_dolar,  if(sedex=1, CONCAT('', FORMAT(a.valor_frete,2,'en_US')), '0.00') AS valor_frete,
		y.nome AS atendente,
		if(vendedor is null, '', if(a.forma_pagamento='faturado', format(((valor_base*a.valor_dolar)+if(sedex=1, (a.valor_frete), '0.00')), 2, 'en_US'), '')) as valor_receber,
		if(vendedor is null, '', if(a.forma_pagamento!='faturado', format(((if(a.moeda='dolar', (valor_total*a.valor_dolar)-((valor_base*a.valor_dolar)+if(sedex=1, (a.valor_frete), '0.00')), (valor_total)-(valor_base*a.valor_dolar+if(sedex=1, (a.valor_frete), '0.00'))))), 2, 'en_US'), '')) as valor_repasse


		FROM wd_vouchers a LEFT JOIN wd_planos b ON a.plano = b.ID LEFT JOIN wd_ponto_de_venda c ON a.ponto_entrega = c.ID LEFT JOIN wd_transacoes x ON a.id_venda = x.id_skillsim left join wd_atendentes y ON x.atendente = y.ID " . $qs . " ORDER BY ID DESC " . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . " ");

		$fetch = $query->fetchAll();

		$count = $this->db->query("select * from wd_vouchers a LEFT JOIN wd_planos b ON a.plano = b.ID LEFT JOIN wd_local_de_venda c ON a.ponto_entrega = c.ID LEFT JOIN wd_transacoes x ON a.id_venda = x.id_skillsim left join wd_atendentes y ON x.atendente = y.ID " . $qs . " ");


		$queryFP = $this->db->query("select forma_pagamento from wd_vouchers group by forma_pagamento ");
		$fetchFP = $queryFP->fetchAll();


		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page, 'fp' => $fetchFP);


		return $res->fetchAll();



	}


	public function checkNotify()
	{

		$query = $this->db->query("SELECT COUNT(*) as total FROM wd_transacoes_erros WHERE iccid_novo IS null");
		$data = $query->fetch();

		return $data['total'];
	}


	public function ReportError()
	{





		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		unset($_GET[path], $_GET[p]);

		if ($_GET[sedex] == '0'):

			$qs .= str_replace('|', '.', 'sedex') . " = '" . $_GET[sedex] . "' and ";

		endif;

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):


					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "email":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "valor_total":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "data_compra":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_retirada":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "valor_base":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;



					case "a|valor_dolar":

						$qs .= str_replace('|', '.', $key) . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor_total":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "ponto_entrega":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "status_compra":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "resgatado":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . trim($search) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';

		$query2 = $this->db->query("SELECT * FROM wd_transacoes_erros a where iccid_novo is null  order by a.ID DESC");
		$fetch2 = $query2->fetchAll();

		foreach ($fetch2 as $sim):




			$s = $this->db->query("SELECT * from wd_simcards where simcard = '$sim[iccid]' ");
			$sd = $s->fetch();

			if ($sd):

				$del = $this->db->delete('wd_transacoes_erros', 'id', $sim[ID]);

			endif;



		endforeach;



		$query = $this->db->query("SELECT a.*, date_format(a.data_transacao, \"%d/%m/%Y\") as data_compra, b.`local`, c.ponto, d.nome as atendente FROM wd_transacoes_erros a LEFT JOIN wd_local_de_venda b on a.local_venda = b.ID LEFT JOIN wd_ponto_de_venda c ON a.ponto_venda = c.ID LEFT JOIN wd_atendentes d ON a.atendente = d.ID order by a.ID DESC");

		$fetch = $query->fetchAll();




		$count = $this->db->query("SELECT a.*, b.`local`, c.ponto, d.nome FROM wd_transacoes_erros a LEFT JOIN wd_local_de_venda b on a.local_venda = b.ID LEFT JOIN wd_ponto_de_venda c ON a.ponto_venda = c.ID LEFT JOIN wd_atendentes d ON a.atendente = d.ID  order by a.ID DESC");





		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);


		return $res->fetchAll();



	}




	public function getVoucherSeller($a)
	{

		$mysqli2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
		$query = $mysqli2->query("select  * from usuarios where id = '$a' ");


		if (!$query) {
			return array();
		}

		$fetch = $query->fetch();



		return $fetch[empresa];
	}


	public function getVoucher($a)
	{

		$mysqli2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
		$query = $mysqli2->query("select  voucher from purchases where id = '$a' ");


		if (!$query) {
			return array();
		}

		$fetch = $query->fetch();



		return $fetch[voucher];
	}


	public function getHelperData($a)
	{


		$query = $this->db->query("

		select

		b.nome as plano,
		h.`local` as local_venda,
		i.ponto as ponto_venda

		from wd_transacoes  a left join wd_planos b on a.plano = b.ID LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID where a.id_skillsim = '$a' ");

		$fetch = $query->fetch();


		return $fetch;
	}


	public function importTransactionVoucher($id)
	{



		/*$mysqli = new pdo('mysql:host=66.165.251.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');



			$query = $mysqli->query("select  a.*, a.id,  date_format(Concat(SUBSTR(data_venda, 7, 4),'-', SUBSTR(data_venda, 4, 2),'-', SUBSTR(data_venda, 1, 2) , ' ' , SUBSTR(horario_venda, 1, 2),':', SUBSTR(horario_venda, 4, 2), ':00'), '%d/%m/%Y %H:%iHs') as data_compra, date_format(Concat(SUBSTR(voucher_data_retirada, 7, 4),'-', SUBSTR(voucher_data_retirada, 4, 2),'-', SUBSTR(voucher_data_retirada, 1, 2)), '%d/%m/%Y ') as data_retirada, voucher_cod_referencia, voucher_forma_pagamento, if(voucher_sedex=1, 'Sedex', 'Retirada no Quiosque') as retirada,  voucher_nome_cliente, voucher_email, voucher_cupom,  voucher_status_compra, concat('R$', format(voucher_valor_total,2,'en_US')) as valor_total from  vendas a WHERE id_quiosque = 9999 AND id >= 41180 ".$qs." ORDER BY voucher_id_purchase DESC ".($page?"LIMIT ".($page - 1) * 20 .",20":"")."");





			$fetch = $query->fetchAll();



			$query = $mysqli->query("SELECT

					date_format(Concat(SUBSTR(data_compra, 7, 4),'-', SUBSTR(data_compra, 4, 2),'-', SUBSTR(data_compra, 1, 2) , ' ' ,  SUBSTR(data_compra, 12, 2),':', SUBSTR(trim(data_compra), 15, 2)), '%d/%m/%Y %H:%iHs') as 'Data da Compra',
			cod_referencia as 'Cod. Referência',
			forma_pagamento as 'Meio de Pagamento',
			b.empresa as 'Vendedor',
			if(sedex=1, 'Sedex', 'Retirada no Quiosque') as 'Opção de Retirada',

			voucher as 'Voucher',
			nome as 'Nome Cliente',
			a.email as 'E-mail',
				a.cupom as 'Cupom Utilizado',
				concat('R$', format(valor_total,2,'en_US')) as 'Valor Total',
			if(status_compra=1, 'Aguardando Pagamento', if(status_compra=2, 'Em análise',  if(status_compra=3, 'Paga',  if(status_compra=6, 'Devolvida',  if(status_compra=7, 'Cancelada',  if(status_compra=10, 'Compra Faturada', if(status_compra=4, 'Disponível',  '') )))))) as 'Status do Pagamento'



			from purchases a LEFT JOIN usuarios b on a.id_vendedor = b.id where a.id = '$id' ");*/


		$query = $this->db->query("SELECT


		date_format(a.data_compra, \"%d/%m/%Y %h:%i:%s\") as 'Data da Compra',
		if(a.status=1, 'Ativo', 'Cancelado') as 'Status',
		if(resgatado=1, 'Não', 'Sim') as 'Resgatado',
		cod_referencia  as 'Código de Referência',
		a.forma_pagamento as 'Forma de Pagamento',
		IF(vendedor>'', vendedor, 'Site') as 'Vendedor',
		if(sedex=1, 'Sedex', 'Retirada no Quiosque') as 'Opção de Retirada',
		a.voucher as Voucher,
		a.nome as 'Nome do Cliente',
		a.email as 'E-mail',
		a.cupom as 'Cupom Utilizado',
		b.nome AS Plano,
		format(a.valor_plano,2,'en_US') as 'Valor Original',
		CONCAT('$', format(valor_base,2,'en_US')) AS 'Valor Base U$',
		CONCAT('', format((valor_base*a.valor_dolar),2,'en_US')) AS 'Valor Base R$',
		CONCAT('R$', FORMAT(a.valor_dolar,2,'en_US')) AS 'Cotação',
		if(a.moeda='dolar', '', CONCAT('', format(valor_total,2,'en_US'))) AS 'Valor Total R$',
		if(a.moeda='dolar', CONCAT('', valor_total), '') AS 'Valor Total U$',
		if(a.moeda='dolar', CONCAT('', format(((valor_total*a.valor_dolar)-if(valor_frete>0 and sedex=1, valor_frete, '0.00')),2,'en_US')), CONCAT('', format((valor_total-if(valor_frete>0 and sedex=1, valor_frete, '0.00')),2,'en_US'))) AS 'Valor Venda R$',
		if(a.moeda='dolar', CONCAT('', format(valor_total-if(valor_frete>0 and sedex=1, format(valor_frete/a.valor_dolar,2, 'en_US'), '0.00'), 2, 'en_US')), '') AS 'Valor Venda U$',
		if(sedex=1, CONCAT('R$', FORMAT(a.valor_frete,2,'en_US')), '0.00') AS 'Valor Frete',
		if(a.moeda='dolar', CONCAT('$', format(valor_total-if(valor_frete>0 and sedex=1, format(valor_frete/a.valor_dolar,2, 'en_US'), '0.00'), 2, 'en_US')), CONCAT('R$', format((valor_total-if(valor_frete>0 and sedex=1, valor_frete, '0.00')),2,'en_US'))) AS 'Valor Venda',
		gateway as 'Gateway',
		if(vendedor is null, '', if(a.forma_pagamento='faturado', format(((valor_base*a.valor_dolar)+if(sedex=1, FORMAT(a.valor_frete,2,'en_US'), '0.00')), 2, 'en_US'), '')) as 'Valor a Receber',
		if(vendedor is null, '', if(a.forma_pagamento!='faturado', format(((if(a.moeda='dolar', format(valor_total*a.valor_dolar,2,'en_US'), (valor_total)-(valor_base*a.valor_dolar+if(sedex=1, FORMAT(a.valor_frete,2,'en_US'), '0.00'))))), 2, 'en_US'), '')) as 'Valor de Repasse',
		if(status_compra=1, 'Aguardando Pagamento', if(status_compra=2, 'Em análise',  if(status_compra=3, 'Paga',  if(status_compra=6, 'Devolvida',  if(status_compra=7, 'Cancelada',  if(status_compra=10, 'Compra Faturada', if(status_compra=4, 'Disponível',  '') )))))) as 'Status do Pagamento',
		simcard as Simcard,
		date_format(a.data_retirada, \"%d/%m/%Y\") as 'Data de Retirada',
		if(sedex=1, 'Sedex', c.`ponto`) AS 'Ponto de Entrega',
		y.nome AS Atendente


		FROM wd_vouchers a
		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_ponto_de_venda c ON a.ponto_entrega = c.ID
		LEFT JOIN wd_transacoes x ON a.id_venda = x.id_skillsim
		LEFT JOIN wd_atendentes y ON x.atendente = y.ID

		where a.ID = '$id'   ");




		if (!$query) {

			return array();
		}


		return $query->fetch(PDO::FETCH_ASSOC);


	}

	public function exportProrrogados()
	{



		unset($_GET[path], $_GET[p]);


		$qs .= "adiar  > '0' and ";


		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "IDS":

						$qs .= "a.id  in(" . implode(',', explode('|', $search)) . ") and ";

						break;

					case "adiar":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "data_transacao":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_ativacao":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_off":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_off_adiado":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(date_add(data_off, interval adiar day)) between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_adiamento":

						$search = explode('-', $search);


						if ($search[0] or $search[1]):

							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";

						endif;

						break;



					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . trim($search) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';




		$query = $this->db->query("

		SELECT

        a.nome as 'Nome do Cliente',
        b.nome AS Plano,
        a.dias_uso AS Dias,
        date_format(a.data_transacao, \"%d/%m/%Y %h:%i:%s\") as 'Data da Transação',
        date_format(a.data_ativacao, \"%d/%m/%Y %h:%i:%s\") as 'Data da Ativação',
        date_format(a.data_off, \"%d/%m/%Y %h:%i:%s\") as 'Data Off',
        date_format(a.data_adiamento, \"%d/%m/%Y %h:%i:%s\") as 'Data do Adiamento',
        date_format(date_add(a.data_off, Interval a.adiar day ), \"%d/%m/%Y %h:%i:%s\") as 'Data Adiado',
        a.adiar AS 'Adiados',
        a.iccid AS 'SIMCARD',
        a.mdn AS 'MDN',
        d.nome AS 'Fornecedor',
        if(a.tipo_transacao=1, 'Nacional', 'Internacional') AS 'Tipo',
        if(a.origem=1, 'Painel', if(a.tipo_transacao=2, 'Site', if(a.tipo_transacao=3, 'Aero', 'CORP'))) AS 'Origem',
        if(a.status=1, 'Aguardando Swap Ativação', if(a.tipo_transacao=2, 'Ativo', if(a.tipo_transacao=3, 'Aguardando Swap Desativação', 'Desativado'))) AS 'Status'


        FROM wd_transacoes a
        LEFT JOIN wd_planos b ON a.plano = b.ID
        LEFT JOIN wd_fornecedores d ON a.fornecedor_mdn = d.ID


		" . $qs . " order by a.ID DESC ");



		if (!$query) {

			return array();
		}


		return $query->fetchAll(PDO::FETCH_ASSOC);


	}

	public function exportReportVoucher($id, $tipo)
	{



		unset($_GET[path], $_GET[p]);


		if ($tipo == 'site'):

			$qs .= "vendedor is null and ";

		else:

			$qs .= "vendedor  > '' and ";

		endif;

		if ($_GET[sedex] == '0'):

			$qs .= str_replace('|', '.', 'sedex') . " = '" . $_GET[sedex] . "' and ";

		endif;

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "IDS":

						$qs .= "a.id  in(" . implode(',', explode('|', $search)) . ") and ";

						break;

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "email":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "valor_total":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "data_compra":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "data_retirada":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;

					case "valor_base":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "a|valor_dolar":

						$qs .= str_replace('|', '.', $key) . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor_total":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;



					case "status_compra":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "resgatado":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "vendedor":



						$qs .= $key . (strtolower($search) == 'site' ? ' is null and ' : " like '%" . trim($search) . "%' and ");

						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . trim($search) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';



		$query = $this->db->query("SELECT


		date_format(a.data_compra, \"%d/%m/%Y %h:%i:%s\") as 'Data da Compra',
		if(a.status=1, 'Ativo', 'Cancelado') as 'Status',
		if(resgatado=1, 'Não', 'Sim') as 'Resgatado',
		cod_referencia  as 'Código de Referência',
		a.forma_pagamento as 'Forma de Pagamento',
		IF(vendedor>'', vendedor, 'Site') as 'Vendedor',
		if(sedex=1, 'Sedex', 'Retirada no Quiosque') as 'Opção de Retirada',
		a.voucher as Voucher,
		a.nome as 'Nome do Cliente',
		a.email as 'E-mail',
		a.cupom as 'Cupom Utilizado',
		b.nome AS Plano,
		format(a.valor_plano,2,'en_US') as 'Valor Original',
		CONCAT( format(valor_base,2,'en_US')) AS 'Valor Base U$',
		CONCAT('', format((valor_base*a.valor_dolar),2,'en_US')) AS 'Valor Base R$',
		CONCAT(FORMAT(a.valor_dolar,2,'en_US')) AS 'Cotação',
		if(a.moeda='dolar', format((valor_total*a.valor_dolar), 2, 'en_US'), CONCAT('', format(valor_total,2,'en_US'))) AS 'Valor Total R$',
		if(a.moeda='dolar', CONCAT('', valor_total), '') AS 'Valor Total U$',
		if(a.moeda='dolar', '', CONCAT('', format((valor_total-if(valor_frete>0 and sedex=1, valor_frete, '0.00')),2,'en_US'))) AS 'Valor Venda R$',
		if(a.moeda='dolar', CONCAT('', format(valor_total-if(valor_frete>0 and sedex=1, format(valor_frete/a.valor_dolar,2, 'en_US'), '0.00'), 2, 'en_US')), '') AS 'Valor Venda U$',
		if(sedex=1, CONCAT('', FORMAT(a.valor_frete,2,'en_US')), '0.00') AS 'Valor Frete',
		gateway as 'Gateway',
		if(vendedor is null, '', if(a.forma_pagamento='faturado', format(((valor_base*a.valor_dolar)+if(sedex=1, FORMAT(a.valor_frete,2,'en_US'), '0.00')), 2, 'en_US'), '')) as 'Valor a Receber',
		if(vendedor is null, '', if(a.forma_pagamento!='faturado', format(((if(a.moeda='dolar', format(valor_total*a.valor_dolar,2)-((valor_base*a.valor_dolar)+if(sedex=1, (a.valor_frete), '0.00')), (valor_total)-(valor_base*a.valor_dolar+if(sedex=1, FORMAT(a.valor_frete,2), '0.00'))))), 2, 'en_US'), '')) as 'Valor de Repasse',
		if(status_compra=1, 'Aguardando Pagamento', if(status_compra=2, 'Em análise',  if(status_compra=3, 'Paga',  if(status_compra=6, 'Devolvida',  if(status_compra=7, 'Cancelada',  if(status_compra=10, 'Compra Faturada', if(status_compra=4, 'Disponível',  '') )))))) as 'Status do Pagamento',
		simcard as Simcard,
		date_format(a.data_retirada, \"%d/%m/%Y\") as 'Data de Retirada',
		if(sedex=1, 'Sedex', c.`ponto`) AS 'Ponto de Entrega',
		y.nome AS Atendente

		FROM wd_vouchers a
		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_ponto_de_venda c ON a.ponto_entrega = c.ID
		LEFT JOIN wd_transacoes x ON a.id_venda = x.id_skillsim
		LEFT JOIN wd_atendentes y ON x.atendente = y.ID

		" . $qs . " order by a.ID DESC ");



		if (!$query) {

			return array();
		}


		return $query->fetchAll(PDO::FETCH_ASSOC);


	}

	public function changeSim()
	{


		$mysqli = new pdo('mysql:host=66.165.234.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');
		$query = $mysqli->query("update vendas set codigo_chip = '$_POST[sim]' where id = '$_POST[id]' ");

		$query = $this->db->update('wd_transacoes_erros', 'id_skillsim', $_POST[id], array('iccid_novo' => $_POST[sim]));

		if ($query):

			echo 'ok';

		endif;


	}


	public function cancelVoucher()
	{

		$query = $this->db->update('wd_vouchers', 'id_voucher', $_POST[ID], array('status' => 2));

	}

	public function getSellersByDay($download)
	{

		if ($_GET['periodo']) {

			$periodo = explode('-', $_GET['periodo']);
			$period['start'] = str_replace(' ', '', dateDBS($periodo[0]));
			$period['end'] = dateAdd('day', 1, dateDBS($periodo[1]));

			$date = "and data_transacao BETWEEN date('" . $period['start'] . "') and date('" . $period['end'] . "')";

		} else {
			$date = "and DATE(data_transacao) = date(NOW())";
		}


		//require ABSPATH.'/frameworks/phpspreadsheet/vendor/autoload.php';
		require_once(ABSPATH . '/frameworks/mpdf/mpdf.php');

		$query = $this->db->query("
		SELECT
		data_transacao,
		COUNT(*) as total,
		SUM(a.valor_credito) credito,
		SUM(a.valor_debito) debito,
		SUM(a.valor_real) `real`,
		SUM(a.valor_dolar) dolar,
		SUM(a.valor_euro) euro,
		b.ponto,
		b.local
		FROM wd_transacoes a
		LEFT JOIN wd_ponto_de_venda b ON a.ponto_venda = b.id
		WHERE b.aeroporto = 1
		$date
		GROUP BY (a.ponto_venda)
		order by ordem
		");

		$reports = $query->fetchAll(PDO::FETCH_ASSOC);


		$data = array();

		$data['table'] = "
		<table style='width: 100%;  margin-bottom: 15px'>
		<tbody>
		";

		$i = 0;
		$t = 0;
		foreach ($reports as $report) {



			$total['chips'] += $report['total'];
			$total['cc'] += $report['credito'];
			$total['dd'] += $report['debito'];
			$total['real'] += $report['real'];
			$total['dolar'] += $report['dolar'];
			$total['euro'] += $report['euro'];

			$total_partial['chips'] += $report['total'];
			$total_partial['cc'] += $report['credito'];
			$total_partial['dd'] += $report['debito'];
			$total_partial['real'] += $report['real'];
			$total_partial['dolar'] += $report['dolar'];
			$total_partial['euro'] += $report['euro'];





			if ($i && $report['local'] != $reports[$i - 1]['local']) {

				$total_partial['chips'] -= $report['total'];
				$total_partial['cc'] -= $report['credito'];
				$total_partial['dd'] -= $report['debito'];
				$total_partial['real'] -= $report['real'];
				$total_partial['dolar'] -= $report['dolar'];
				$total_partial['euro'] -= $report['euro'];

				if ($t > 1) {
					$data['table'] .= $this->geraTableTotalPerLocal($total_partial);
				}

				$data['table'] .= "
					</tbody>
					</table>
					<table style='width: 100%;  margin-bottom: 15px'>
					<tbody>
					";

				$total_partial = [];
				$t = 0;

			}

			$data['table'] .= $this->geraTable($report);


			// 	if($t>1){
			// 	$data['table'] .= $this->geraTableTotalPerLocal($total_partial);
			// 	}

			// 	$data['table'] .= "
			// 	</tbody>
			// 	</table>
			// 	<table style='width: 100%;  margin-bottom: 15px'>
			// 	<tbody>
			// 	";

			// 	$i++;
			// 	$i++;
			// 	$t=0;

			// 	$total_partial = [];

			// 	$this->ponto = FALSE;


			// }


			$i++;
			$t++;


		}



		$data['table'] .= "
		</tbody>
		</table>
		";

		$data['table'] .= $this->geraTableTotal($total);

		$data['date'] = $periodo ? (str_replace(' ', '', $periodo[0]) != str_replace(' ', '', $periodo[1]) ? 'Período ' . $periodo[0] . "-" . $periodo[1] : $periodo[0]) : date('d/m/Y');
		$data['name'] = $nome = 'Relatório Diário ' . date("d-m-Y") . '.pdf';



		$body = file_get_contents(ABSPATH . '/views/relatorios/templates/dailyReport.html');



		foreach ($data as $k => $v) {
			$body = str_replace('{' . $k . '}', $v, $body);
		}


		$this->pdf = new Mpdf();
		$this->pdf->WriteHTML($body);
		$this->adjustFontDescLineheight = 1.14;
		$this->pdf->Output($data['name'], 'D');


	}

	public function geraTable($data)
	{

		return "

		<tr>
			<td style='width: 20%'><strong>" . strtoupper($data['ponto']) . "</strong></td>
			<td style='width: 10%'>" . $data['total'] . "</td>
			<td style='width: 15%'>R$ " . money($data['credito']) . "</td>
			<td style='width: 15%'>R$ " . money($data['debito']) . "</td>
			<td style='width:13.33333%'>R$ " . money($data['real']) . "</td>
			<td style='width:13.33333%'>$ " . money($data['dolar']) . "</td>
			<td style='width:13.33333%'>€ " . money($data['euro']) . "</td>
		</tr>

		";

	}

	public function geraTableTotalPerLocal($data)
	{

		return "

		<tr>
			<td style='width: 20%'><strong>TOTAL</strong></td>
			<td style='width: 10%'>" . $data['chips'] . "</td>
			<td style='width: 15%'>R$ " . money($data['cc']) . "</td>
			<td style='width: 15%'>R$ " . money($data['dd']) . "</td>
			<td style='width:13.33333%'>R$ " . money($data['real']) . "</td>
			<td style='width:13.33333%'>$ " . money($data['dolar']) . "</td>
			<td style='width:13.33333%'>€ " . money($data['euro']) . "</td>
		</tr>

		";

	}

	public function geraTableTotal($data)
	{

		return "
		<table style='width: 100%;  margin-bottom: 15px'>
		<thead></thead>
		<tbody>
		<tr>
			<td style='width: 20%'><strong>TOTAL GERAL</strong></td>
			<td style='width: 10%'>" . $data['chips'] . "</td>
			<td style='width: 15%'>R$ " . money($data['cc']) . "</td>
			<td style='width: 15%'>R$ " . money($data['dd']) . "</td>
			<td style='width:13.33333%'>R$ " . money($data['real']) . "</td>
			<td style='width:13.33333%'>$ " . money($data['dolar']) . "</td>
			<td style='width:13.33333%'>€ " . money($data['euro']) . "</td>
		</tr>
		</tbody>
		</table>
		";

	}


}
