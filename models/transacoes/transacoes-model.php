<?php
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

require_once(ABSPATH . '/frameworks/mpdf/mpdf.php');

class TransacoesModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;


	public function __construct($db = false)
	{

		$this->db = $db;
		$this->table = 'wd_transacoes';
		$this->tableSIM = 'wd_simcards';
		$this->tableMdn = 'wd_mdns';

		$this->pdf = new Mpdf();

	}

	public function _submit()
	{

		$this->form_data = array();

		if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST)) {
			foreach ($_POST[transacoes] as $key => $value) {
				$this->form_data[$key] = $value;
			}
		} else {
			return;
		}



		if (chk_array($this->form_data, 'action') == 'edit'):



			$this->associate(chk_array($this->form_data, 'mdn'), chk_array($this->form_data, 'iccid'));


			$query = $this->db->update(
				$this->table,
				'ID',
				chk_array($this->form_data, 'ID'),
				array(

					'data_transacao' => dateHDB(chk_array($this->form_data, 'data_transacao')),
					'data_ativacao' => dateHDB(chk_array($this->form_data, 'data_ativacao')),
					'tipo' => 1,
					'atendente' => chk_array($this->form_data, 'atendente'),
					'local_venda' => chk_array($this->form_data, 'local_venda'),
					'ponto_venda' => chk_array($this->form_data, 'ponto_venda'),
					'nome' => chk_array($this->form_data, 'nome'),
					'celular' => chk_array($this->form_data, 'celular'),
					'email' => chk_array($this->form_data, 'email'),
					'documento' => chk_array($this->form_data, 'documento'),
					'cnpj' => chk_array($this->form_data, 'cnpj'),
					'plano' => chk_array($this->form_data, 'planos'),
					'local_uso' => chk_array($this->form_data, 'local_uso'),
					'dias_uso' => chk_array($this->form_data, 'dias_uso'),
					'data_off' => dateDB(chk_array($this->form_data, 'data_off')),
					'adiar' => chk_array($this->form_data, 'adiar'),
					'valor_plano' => chk_array($this->form_data, 'valor_plano'),
					'forma_pagamento' => chk_array($this->form_data, 'forma_pagamento'),
					'moeda' => chk_array($this->form_data, 'moeda'),
					'desconto' => chk_array($this->form_data, 'desconto'),
					'valor_pago' => chk_array($this->form_data, 'valor_pago'),
					'valor_dolar' => chk_array($this->form_data, 'valor_dolar'),
					'valor_euro' => chk_array($this->form_data, 'valor_euro'),
					'valor_real' => chk_array($this->form_data, 'valor_real'),
					'valor_debito' => chk_array($this->form_data, 'valor_debito'),
					'valor_credito' => chk_array($this->form_data, 'valor_credito'),
					'iccid' => chk_array($this->form_data, 'iccid'),
					'mdn' => chk_array($this->form_data, 'mdn'),
					'fornecedor_simcard' => chk_array($this->form_data, 'fornecedor_simcard'),
					'fornecedor_mdn' => chk_array($this->form_data, 'fornecedor_mdn'),
					'observacao' => chk_array($this->form_data, 'observacao'),
					'emitir_nota' => chk_array($this->form_data, 'emitir_nota'),
					'nota_d' => chk_array($this->form_data, 'nota_d'),
					'aparelhos' => chk_array($this->form_data, 'aparelhos'),
					'paises' => chk_array($this->form_data, 'paises'),
					'motivo_troca' => chk_array($this->form_data, 'motivo_troca'),
					'motivo_ampliacao' => chk_array($this->form_data, 'motivo_ampliacao'),
					'descricao_motivo' => chk_array($this->form_data, 'descricao_motivo'),
					'tipo_transacao' => chk_array($this->form_data, 'tipo_transacao'),
					'ocorrencia' => chk_array($this->form_data, 'ocorrencia'),
					'adiar_motivo' => chk_array($this->form_data, 'adiar_motivo'),
					'adiar_forma' => chk_array($this->form_data, 'adiar_forma'),
					'adiar_valor' => chk_array($this->form_data, 'adiar_valor'),
					'sa' => 0,

				)
			);

			$this->setStatus(chk_array($this->form_data, 'iccid'), $_GET[status]);


			if ($this->getStatus(chk_array($this->form_data, 'ID')) == 3):

				$query = $this->db->update(
					$this->table,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'status' => 2,

					)
				);

			endif;


			if (chk_array($this->form_data, 'tipo') == 3):

				$this->cancel(chk_array($this->form_data, 'ID'));

			endif;



			if (!chk_array($this->form_data, 'cod_fatura') && (chk_array($this->form_data, 'emitir_nota') == 3 || chk_array($this->form_data, 'emitir_nota') == 1)):

				$this->gerFatura(chk_array($this->form_data, 'ID'));

			endif;


			if (chk_array($this->form_data, 'adiar')):

				$this->adiar(chk_array($this->form_data, 'ID'));

			endif;


			if (!$query) {
				echo $this->form_msg = 'error_update';
				return;
			} else {


				echo $this->form_msg = 'success_update';


				return;
			}

		else:


			$this->associate(chk_array($this->form_data, 'mdn'), chk_array($this->form_data, 'iccid'));


			$query = $this->db->insert(
				$this->table,
				array(


					'data_transacao' => dateHDB(chk_array($this->form_data, 'data_transacao')),
					'data_ativacao' => dateHDB(chk_array($this->form_data, 'data_ativacao')),
					'tipo' => 1,
					'atendente' => chk_array($this->form_data, 'atendente'),
					'local_venda' => chk_array($this->form_data, 'local_venda'),
					'ponto_venda' => chk_array($this->form_data, 'ponto_venda'),
					'nome' => chk_array($this->form_data, 'nome'),
					'celular' => chk_array($this->form_data, 'celular'),
					'email' => chk_array($this->form_data, 'email'),
					'documento' => chk_array($this->form_data, 'documento'),
					'cnpj' => chk_array($this->form_data, 'cnpj'),
					'plano' => chk_array($this->form_data, 'planos'),
					'local_uso' => chk_array($this->form_data, 'local_uso'),
					'dias_uso' => chk_array($this->form_data, 'dias_uso'),
					'data_off' => dateDB(chk_array($this->form_data, 'data_off')),
					'adiar' => chk_array($this->form_data, 'adiar'),
					'valor_plano' => chk_array($this->form_data, 'valor_plano'),
					'forma_pagamento' => chk_array($this->form_data, 'forma_pagamento'),
					'moeda' => chk_array($this->form_data, 'moeda'),
					'desconto' => chk_array($this->form_data, 'desconto'),
					'valor_pago' => chk_array($this->form_data, 'valor_pago'),
					'valor_dolar' => chk_array($this->form_data, 'valor_dolar'),
					'valor_euro' => chk_array($this->form_data, 'valor_euro'),
					'valor_real' => chk_array($this->form_data, 'valor_real'),
					'valor_debito' => chk_array($this->form_data, 'valor_debito'),
					'valor_credito' => chk_array($this->form_data, 'valor_credito'),
					'iccid' => chk_array($this->form_data, 'iccid'),
					'mdn' => chk_array($this->form_data, 'mdn'),
					'fornecedor_simcard' => chk_array($this->form_data, 'fornecedor_simcard'),
					'fornecedor_mdn' => chk_array($this->form_data, 'fornecedor_mdn'),
					'observacao' => chk_array($this->form_data, 'observacao'),
					'emitir_nota' => chk_array($this->form_data, 'emitir_nota'),
					'nota_d' => chk_array($this->form_data, 'nota_d'),
					'sa' => 0,
					'aparelhos' => chk_array($this->form_data, 'aparelhos'),
					'motivo_troca' => chk_array($this->form_data, 'motivo_troca'),
					'motivo_ampliacao' => chk_array($this->form_data, 'motivo_ampliacao'),
					'descricao_motivo' => chk_array($this->form_data, 'descricao_motivo'),
					'tipo_transacao' => chk_array($this->form_data, 'tipo_transacao'),
					'paises' => chk_array($this->form_data, 'paises'),
					'ocorrencia' => chk_array($this->form_data, 'ocorrencia'),
					'adiar_motivo' => chk_array($this->form_data, 'adiar_motivo'),
					'adiar_forma' => chk_array($this->form_data, 'adiar_forma'),
					'adiar_valor' => chk_array($this->form_data, 'adiar_valor'),

				)
			);

			$last_id = $this->db->last_id;


			$this->setStatus(chk_array($this->form_data, 'iccid'), '', true);
			if (chk_array($this->form_data, 'emitir_nota') != 2):
				$this->gerFatura($last_id);
			endif;

			if (!$query) {
				echo $this->form_msg = 'error';
				return;
			} else {
				echo $this->form_msg = 'success';
				return;
			}

		endif;

	}




	public function getList($yes = NULL, $helpdesk = NULL, $reembolso = NULL, $cancelamento = NULL, $prorrogacao = NULL, $controle = NULL)
	{

		$_GET[status_nota] = $_POST[status_nota];


		if (!$_GET[status_nota] && $controle):


			$qs .= "(nota_d = 1 or emitir_nota = 1 or origem = '2') AND (status_nota IS null OR status_nota = '0' ) AND DATEDIFF(data_transacao, DATE('2019-12-09')) >= 0  and ";


		endif;

		if ($yes):

			$qs .= "a.tipo_transacao =  '1' and ";

		endif;

		if ($prorrogacao):

			$qs .= "adiar  > '0' and ";

		endif;

		if ($cancelamento):

			$qs .= "tipo  =  '3' and ";

		endif;


		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		$debug = $_GET[db];

		unset($_GET[path], $_GET[p], $_GET[token], $_GET[customer], $_GET[debug]);

		$_GET[helpdesk] = ($helpdesk ? 2 : $_GET[helpdesk]);
		$_GET[reembolso] = ($reembolso ? 2 : $_GET[reembolso]);

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "a|ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "email":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "valor":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

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

					case "status":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "_status":

						switch ($search):

							case "1":

								$qs .= "tipo = '3' and ";

								break;

							case "2":

								$qs .= "helpdesk = '2' and ";

								break;

							case "3":

								$qs .= "reembolso = '2' and ";

								break;

							case "4":

								$qs .= "adiar > '0' and ";

								break;





						endswitch;



						break;

					case "dias_uso":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "a|fornecedor_mdn":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "atendente":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "local_venda":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "ponto_venda":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "helpdesk":

						$qs .= "helpdesk = " . $_GET[helpdesk] . " and ";

						break;

					case "reembolso":

						$qs .= "reembolso = " . $_GET[reembolso] . " and ";

						break;

					case "status_nota":

						$qs .= "status_nota = " . $_GET[status_nota] . " and ";

						break;


					case "nota_d":

						$qs .= ($_GET[nota_d] == 'A' ? 'nota_d  = 1 ' : ($_GET[nota_d] == 'S' ? 'emitir_nota  = 1 ' : ($_GET[nota_d] == 'C' ? 'emitir_nota = 3 ' : ''))) . " and ";

						break;

					case "final_plano":

						$qs .= "a.valor_plano = '" . ($search) . "' and ";

						break;

					case "desconto_plano":

						$qs .= "(b.valor-a.valor_plano) = '" . ($search) . "' and ";

						break;

					case "valor_plano":

						$qs .= "b.valor = '" . ($search) . "' and ";

						break;

					case "detalhe":

						$qs .= "a.detalhe = '" . ($search) . "' and ";

						break;

					case "origem":

						$qs .= "a.origem = '" . ($search) . "' and ";

						break;






					default:
						$qs .= "lower(" . str_replace('|', '.', $key) . ") like '%" . trim(strtolower($search)) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';


		if ($debug):

			echo '


			SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(a.data_off, "%d/%m/%Y") as data_off, date_format(a.data_transacao, "%d/%m/%Y %H:%iHs") as data_transacao,
			e.nome as fornecedor_simcard,
			f.nome as fornecedor_mdn,
			f.apelido as fornecedor_alias,
			g.nome as atendente,
			h.`local` as local_venda,
			i.ponto as ponto_venda,
			j.local as local_uso,
			k.forma_pagamento as forma_pagamento,
			l.moeda as moeda,
			n.status as status_mdn,
			o.status as status_simcard,
			c.lote as lote_simcard,
			if(g.area_atuacao=1, "AERO", if(g.area_atuacao=2, "HD", "") ) as area_atuacao,
			m.lote as lote_mdn,
			(b.valor-a.valor_plano) as desconto_plano,
			a.valor_plano as final_plano,
			b.valor as valor_plano,
			date_format(a.data_nota, "%d/%m/%Y %H:%iHs") as data_nota,
			date_format(a.data_cancelamento, "%d/%m/%Y") as cancelamento,
			if(documento, documento, cnpj) as documento






			FROM ' . $this->table . ' a

			LEFT JOIN wd_planos b ON a.plano = b.ID
			LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
			LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
			LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
			LEFT JOIN wd_atendentes g ON a.atendente = g.ID
			LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
			LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
			LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
			LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
			LEFT JOIN wd_moedas l on a.moeda = l.ID
			LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
			LEFT JOIN wd_status_mdn n ON m.status = n.ID
			LEFT JOIN wd_status_simcard o ON c.status = o.ID



			' . $qs . ' ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '';


		endif;

		$query = $this->db->query('

		SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(a.data_off, "%d/%m/%Y") as data_off, date_format(a.data_transacao, "%d/%m/%Y %H:%iHs") as data_transacao,
		e.nome as fornecedor_simcard,
		f.nome as fornecedor_mdn,
		f.apelido as fornecedor_alias,
		g.nome as atendente,
		h.`local` as local_venda,
		i.ponto as ponto_venda,
		j.local as local_uso,
		k.forma_pagamento as forma_pagamento,
		l.moeda as moeda,
		n.status as status_mdn,
		o.status as status_simcard,
		c.lote as lote_simcard,
		if(g.area_atuacao=1, "AERO", if(g.area_atuacao=2, "HD", "") ) as area_atuacao,
		m.lote as lote_mdn,
		(b.valor-a.valor_plano) as desconto_plano,
		a.valor_plano as final_plano,
		b.valor as valor_plano,
		date_format(a.data_nota, "%d/%m/%Y %H:%iHs") as data_nota,
		date_format(a.data_cancelamento, "%d/%m/%Y") as cancelamento,
		if(documento, documento, cnpj) as documento






		FROM ' . $this->table . ' a

		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID
	    LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
		LEFT JOIN wd_status_mdn n ON m.status = n.ID
		LEFT JOIN wd_status_simcard o ON c.status = o.ID



		' . $qs . ' ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');




		$count = $this->db->query('

		        SELECT count(a.ID) as total  FROM ' . $this->table . ' a

				LEFT JOIN wd_planos b ON a.plano = b.ID
				LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
				LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
				LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
				LEFT JOIN wd_atendentes g ON a.atendente = g.ID
				LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
				LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
				LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
				LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
				LEFT JOIN wd_moedas l on a.moeda = l.ID
				LEFT JOIN wd_mdns m ON  a.mdn = m.mdn



				' . $qs . '



				');


		if (!$query) {
			return array();
		}

		$fetch = $query->fetchAll();
		$count = $count->fetch();

		return array('data' => $fetch, 'total' => $count['total'], 'page' => $page);
	}


	public function getList30($yes, $helpdesk, $reembolso, $cancelamento, $prorrogacao, $controle)
	{

		$_GET[status_nota] = $_POST[status_nota];

		$qs .= "dias_uso  > 30 and ";

		if ($prorrogacao):

			$qs .= "adiar  > '0' and ";

		endif;

		if ($cancelamento):

			$qs .= "tipo  =  '3' and ";

		endif;


		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		$debug = $_GET[db];

		unset($_GET[path], $_GET[p], $_GET[token], $_GET[customer], $_GET[debug]);

		$_GET[helpdesk] = ($helpdesk ? 2 : $_GET[helpdesk]);
		$_GET[reembolso] = ($reembolso ? 2 : $_GET[reembolso]);

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "a|ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "email":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "valor":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

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

					case "status":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "_status":

						switch ($search):

							case "1":

								$qs .= "tipo = '3' and ";

								break;

							case "2":

								$qs .= "helpdesk = '2' and ";

								break;

							case "3":

								$qs .= "reembolso = '2' and ";

								break;

							case "4":

								$qs .= "adiar > '0' and ";

								break;





						endswitch;



						break;

					case "dias_uso":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "a|fornecedor_mdn":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "atendente":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "local_venda":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "ponto_venda":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "helpdesk":

						$qs .= "helpdesk = " . $_GET[helpdesk] . " and ";

						break;

					case "reembolso":

						$qs .= "reembolso = " . $_GET[reembolso] . " and ";

						break;

					case "status_nota":

						$qs .= "status_nota = " . $_GET[status_nota] . " and ";

						break;


					case "nota_d":

						$qs .= ($_GET[nota_d] == 'A' ? 'nota_d  = 1 ' : ($_GET[nota_d] == 'S' ? 'emitir_nota  = 1 ' : '')) . " and ";

						break;

					case "final_plano":

						$qs .= "a.valor_plano = '" . ($search) . "' and ";

						break;

					case "desconto_plano":

						$qs .= "(b.valor-a.valor_plano) = '" . ($search) . "' and ";

						break;

					case "valor_plano":

						$qs .= "b.valor = '" . ($search) . "' and ";

						break;

					case "detalhe":

						$qs .= "a.detalhe = '" . ($search) . "' and ";

						break;

					case "origem":

						$qs .= "a.origem = '" . ($search) . "' and ";

						break;






					default:
						$qs .= "lower(" . str_replace('|', '.', $key) . ") like '%" . trim(strtolower($search)) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';



		$query = $this->db->query('

		SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(a.data_off, "%d/%m/%Y") as data_off, date_format(a.data_transacao, "%d/%m/%Y %H:%iHs") as data_transacao,
		e.nome as fornecedor_simcard,
		datediff(NOW(), data_ativacao + INTERVAL dias_uso DAY) AS qty,
		f.nome as fornecedor_mdn,
		f.apelido as fornecedor_alias,
		g.nome as atendente,
		h.`local` as local_venda,
		i.ponto as ponto_venda,
		j.local as local_uso,
		k.forma_pagamento as forma_pagamento,
		l.moeda as moeda,
		n.status as status_mdn,
		o.status as status_simcard,
		c.lote as lote_simcard,
		if(g.area_atuacao=1, "AERO", if(g.area_atuacao=2, "HD", "") ) as area_atuacao,
		m.lote as lote_mdn,
		(b.valor-a.valor_plano) as desconto_plano,
		a.valor_plano as final_plano,
		b.valor as valor_plano,
		date_format(a.data_nota, "%d/%m/%Y %H:%iHs") as data_nota,
		date_format(a.data_cancelamento, "%d/%m/%Y") as cancelamento,
		if(documento, documento, cnpj) as documento






		FROM ' . $this->table . ' a

		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID
	    LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
		LEFT JOIN wd_status_mdn n ON m.status = n.ID
		LEFT JOIN wd_status_simcard o ON c.status = o.ID



		' . $qs . ' ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');




		$count = $this->db->query('

		        SELECT a.*  FROM ' . $this->table . ' a

				LEFT JOIN wd_planos b ON a.plano = b.ID
				LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
				LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
				LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
				LEFT JOIN wd_atendentes g ON a.atendente = g.ID
				LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
				LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
				LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
				LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
				LEFT JOIN wd_moedas l on a.moeda = l.ID
				LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
				LEFT JOIN wd_status_mdn n ON m.status = n.ID
				LEFT JOIN wd_status_simcard o ON c.status = o.ID


				' . $qs . '



				');


		if (!$query) {
			return array();
		}

		$fetch = $query->fetchAll();
		$count = $count->fetchAll();

		return array('data' => $fetch, 'total' => count($count), 'page' => $page);
	}

	public function getRegistry($id)
	{

		$query = $this->db->query("SELECT a.*  FROM `" . $this->table . "` a   where a.ID = '" . $id . "' ");
		if (!$query) {
			return array();
		}


		return $query->fetchAll();
	}

	public function getNFs()
	{

		$_GET = $_POST;

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		$st = ($_POST[status_nota] ? "and status_nota = '$_POST[status_nota]'" : "and (status_nota IS null OR status_nota = '0' )");


		unset($_GET[path], $_GET[p], $_GET[token], $_GET[customer], $_GET[debug]);

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):



					case "valor_pago":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";
						$qs2 .= "valor_total = '" . formatMoney($search) . "' and ";


						break;

					case "plano":

						$qs .= $key . " = '" . $search . "' and ";


						break;

					case "documento":

						$qs .= "lower(documento) like '%" . trim(strtolower($search)) . "%' and ";
						$qs2 .= "lower(cpf) like '%" . trim(strtolower($search)) . "%' and ";


						break;

					case "email":

						$qs .= "lower(email) like '%" . trim(strtolower($search)) . "%' and ";
						$qs2 .= "lower(email) like '%" . trim(strtolower($search)) . "%' and ";


						break;

					case "data_transacao":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
							$qs2 .= "date(data_compra) between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;



					case "a|nome":

						$qs .= "lower(a.nome) like '%" . trim(strtolower($search)) . "%' and ";
						$qs2 .= "lower(nome) like '%" . trim(strtolower($search)) . "%' and ";

						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . $search . "%' and ";
						break;



				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'and ' . substr($qs, 0, -4) : '';
		$qs2 = ($qs2) ? 'and ' . substr($qs2, 0, -4) : '';






		$query = $this->db->query("

		(SELECT concat('T', a.ID) as ID, cnpj, date_format(data_transacao, '%d/%m/%Y %H:%iHs') as data_transacao, a.nome, if(documento, documento, cnpj) as documento, email, valor_pago AS valor_pago, iccid, mdn, b.nome as plano, origem, date_format(a.data_nota, '%d/%m/%Y %H:%iHs') as data_nota, responsavel_nota FROM wd_transacoes a LEFT JOIN wd_planos b ON a.plano = b.ID  WHERE (nota_d = 1 or emitir_nota = 1) $st AND origem !=2 AND DATEDIFF(data_transacao, DATE('2019-12-09')) >= 0  $qs ORDER BY ID DESC " . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . " )
		UNION
		(SELECT concat('V', ID) as ID, date_format(data_compra, '%d/%m/%Y %H:%iHs') as data_transacao, nome, cpf as documento, email, valor_total AS valor_pago, '' , '', '', '', date_format(data_nota, '%d/%m/%Y %H:%iHs') as data_nota, responsavel_nota FROM wd_vouchers WHERE status_compra = '3' $st AND DATEDIFF(data_compra, DATE('2020-03-08')) >= 0 $qs2 ORDER BY ID DESC " . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . " )

		");

		$count = $this->db->query("

		(SELECT concat('T', a.ID) as ID, date_format(data_transacao, '%d/%m/%Y %H:%iHs') as data_transacao, a.nome, if(documento, documento, cnpj) as documento, email, valor_pago AS valor_pago, iccid, mdn, b.nome as plano, origem, date_format(a.data_nota, '%d/%m/%Y %H:%iHs') as data_nota, responsavel_nota FROM wd_transacoes a LEFT JOIN wd_planos b ON a.plano = b.ID  WHERE (nota_d = 1 or emitir_nota = 1) $st AND origem !=2 AND DATEDIFF(data_transacao, DATE('2019-12-09')) >= 0  $qs   )
		UNION
		(SELECT concat('V', ID) as ID, date_format(data_compra, '%d/%m/%Y %H:%iHs') as data_transacao, nome, cpf as documento, email, valor_total AS valor_pago, '' , '', '', '', date_format(data_nota, '%d/%m/%Y %H:%iHs') as data_nota, responsavel_nota FROM wd_vouchers WHERE status_compra = '3' $st AND DATEDIFF(data_compra, DATE('2020-03-08')) >= 0 $qs2  )

		");


		$fetch = $query->fetchAll();
		$count = $count->fetchAll();

		return array('data' => $fetch, 'total' => count($count), 'page' => $page);


	}


	public function getFaturas()
	{

		$_GET = $_POST;

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		unset($_GET[path], $_GET[p], $_GET[token], $_GET[customer], $_GET[debug]);

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):
					case "valor_pago":
						$qs .= $key . " = '" . formatMoney($search) . "' and ";
						$qs2 .= "valor_total = '" . formatMoney($search) . "' and ";

						break;

					case "plano":
						$qs .= $key . " = '" . $search . "' and ";
						break;

					case "documento":
						$qs .= "lower(documento) like '%" . trim(strtolower($search)) . "%' and ";
						$qs2 .= "lower(cpf) like '%" . trim(strtolower($search)) . "%' and ";
						break;

					case "email":
						$qs .= "lower(email) like '%" . trim(strtolower($search)) . "%' and ";
						$qs2 .= "lower(email) like '%" . trim(strtolower($search)) . "%' and ";
						break;

					case "data_transacao":
						$search = explode('-', $search);
						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
							$qs2 .= "date(data_compra) between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;



					case "a|nome":
						$qs .= "lower(a.nome) like '%" . trim(strtolower($search)) . "%' and ";
						$qs2 .= "lower(nome) like '%" . trim(strtolower($search)) . "%' and ";
						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . $search . "%' and ";
						break;
				endswitch;

			}
		endforeach;

		$qs = ($qs) ? 'and ' . substr($qs, 0, -4) : '';
		$qs2 = ($qs2) ? 'and ' . substr($qs2, 0, -4) : '';


		$query = $this->db->query("

		(SELECT detalhe, emitir_nota, concat('T', a.ID) as ID, date_format(data_transacao, '%d/%m/%Y %H:%iHs') as data_transacao, a.nome, if(documento, documento, cnpj) as documento, email, valor_pago AS valor_pago, iccid, mdn, b.nome as plano, origem, date_format(a.data_nota, '%d/%m/%Y %H:%iHs') as data_nota, responsavel_nota, LPAD(cod_fatura, 5, 0)  as cod_fatura FROM wd_transacoes a LEFT JOIN wd_planos b ON a.plano = b.ID  WHERE cod_fatura is not null  AND cod_fatura > 0 $st  $qs ORDER BY cod_fatura DESC " . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . " )

		");

		$count = $this->db->query("

		(SELECT detalhe, concat('T', a.ID) as ID, date_format(data_transacao, '%d/%m/%Y %H:%iHs') as data_transacao, a.nome, if(documento, documento, cnpj) as documento, email, valor_pago AS valor_pago, iccid, mdn, b.nome as plano, origem, date_format(a.data_nota, '%d/%m/%Y %H:%iHs') as data_nota, responsavel_nota, LPAD(cod_fatura, 5, 0)  as  cod_fatura FROM wd_transacoes a LEFT JOIN wd_planos b ON a.plano = b.ID  WHERE cod_fatura is not null   AND cod_fatura > 0 $st   $qs   )

		");


		$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
		$count = $count->fetchAll();

		return array('data' => $fetch, 'total' => count($count), 'page' => $page);


	}


	public function del($ids)
	{

		foreach (explode(',', $ids) as $id):


			$del = $this->db->delete($this->table, 'ID', $id);

			$this->setStatusOld($id);

		endforeach;

		return 'success';
	}


	public function setStatus($id, $status = NULL, $novo = NULL)
	{



		$query = $this->db->query("SELECT a.status status_sim, b.status  status_mdn, id_associacao FROM `" . $this->tableSIM . "` a left join wd_mdns b on a.id_associacao = b.ID  where simcard = '$id'");
		$data = $query->fetch();


		$Sstatus = ($status == 1 || $novo ? 14 : ($status == 2 ? 2 : ($status == '3' ? 12 : '')));

		if ($Sstatus):

			$query = $this->db->update(
				$this->tableSIM,
				'simcard',
				$id,
				array(

					'status' => $Sstatus,
					'status_old' => $data[status_sim],

				)
			);

		endif;

		$Mstatus = ($status == 1 || $novo ? 19 : ($status == 2 ? 6 : ($status == '3' ? 20 : '')));

		if ($Mstatus):
			$query = $this->db->update(
				$this->tableMdn,
				'ID',
				$data["id_associacao"],
				array(

					'status' => $Mstatus,
					'status_old' => $data[status_mdn],

				)
			);

		endif;

	}

	public function setStatusOld($id)
	{

		$query = $this->db->query("SELECT a.*  FROM `" . $this->table . "` a   where a.ID = '" . $id . "' ");
		$data = $query->fetch();



		$query = $this->db->query("SELECT id_associacao, a.ID IDs FROM `" . $this->tableSIM . "` a left join wd_mdns b on a.id_associacao = b.ID   where a.simcard = '" . $data[iccid] . "' ");

		$data = $query->fetch();


		$query = $this->db->update(
			$this->tableSIM,
			'ID',
			10,
			array(

				'id_associacao' => ($data[tipo_uso] == 3 ? $data[id_associacao] : '0'),
				'status' => 1,
				'status_old' => '',


			)
		);


		$query = $this->db->update(
			$this->tableMdn,
			'ID',
			$data["id_associacao"],
			array(

				'status' => 1,
				'status_old' => '',


			)
		);



	}


	public function associate($mdn, $simcard)
	{

		if ($mdn):


			$query = $this->db->query("SELECT *  FROM `" . $this->tableSIM . "` a left join wd_mdns b on a.id_associacao = b.ID  where mdn = '$mdn' and simcard = '$simcard' ");


			if (!$query->fetch()):


				$querySim = $this->db->query("SELECT * FROM `" . $this->tableSIM . "` a where id_associacao > 0 and simcard = '$simcard'  ");
				$dataSim = $querySim->fetch();

				if ($dataSim):

					$query = $this->db->update(
						$this->tableMdn,
						'ID',
						$dataSim["id_associacao"],
						array(

							'status' => 1,
							'status_old' => '',

						)
					);

				endif;


				$query = $this->db->query("SELECT * FROM `" . $this->tableMdn . "` a where mdn = '$mdn' ");
				$data = $query->fetch();

				$query = $this->db->update(
					$this->tableSIM,
					'simcard',
					$simcard,
					array(

						'id_associacao' => $data[ID],

					)
				);



			endif;
		endif;

	}


	public function cancel($id)
	{

		$id = ($id ? $id : $_POST[ID]);

		$query = $this->db->update(
			$this->table,
			'ID',
			$id,
			array(

				'tipo' => 3,
				'status' => 3,
				'responsavel_cancelamento' => $_POST[responsavel],
				'data_cancelamento' => date('Y-m-d H:i:s'),
				//'data_off' => date('Y-m-d').' 00:00:00',

			)
		);

	}

	public function adiar($id)
	{


		$query = $this->db->query("SELECT * FROM `" . $this->table . "` a where mdn = '$id' ");
		$data = $query->fetch();

		if (!$data[data_adiamento]):

			$query = $this->db->update(
				$this->table,
				'ID',
				$id,
				array(

					'data_adiamento' => date('Y-m-d H:i:s'),
					//'data_off' => date('Y-m-d').' 00:00:00',


				)
			);

		endif;

	}


	public function importer($data, $tipo)
	{


		$i = 1;
		foreach ($data as $item):


			$dat = array();

			if ($i > 1):


				if ($tipo == 2):

					//$this->associate($item[E], $item[B]);

				endif;

				$query = $this->db->insert(
					$this->table,
					array(

						'data_transacao' => dateDB($item[J]),
						'data_ativacao' => dateDB($item[K]),
						'tipo' => $item[W],
						'atendente' => $item[L],
						'local_venda' => $item[M],
						'ponto_venda' => $item[N],
						'nome' => $item[O],
						'documento' => $item[Y],
						'plano' => $item[H],
						'local_uso' => $this->getLocal($item['AA']),
						'dias_uso' => $item[P],
						'data_off' => dateDB($item[Q]),
						'valor_plano' => $this->getPP($item[H]),
						'forma_pagamento' => $item[S],
						'moeda' => $item[T],
						'desconto' => $item[U],
						'valor_pago' => $item[V],
						'iccid' => $item[B],
						'mdn' => $item[E],
						'fornecedor_simcard' => $item[C],
						'fornecedor_mdn' => $item[F],
						'observacao' => $item[Z],
						'emitir_nota' => $item[X]

					)
				);

				//$this->setStatus($item[B]);

			endif;


			$i++;
		endforeach;

	}

	public function getLocal($a)
	{

		$lu = str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ' '), '', $a);

		switch ($lu):

			case "MUNDO":

				return 3;

				break;

			case "EUA":

				return 5;

				break;

			case "AMI":

				return 8;

				break;

			case "CANMEX":

				return 6;

				break;

		endswitch;

	}


	public function getPP($a)
	{


		$query = $this->db->query("SELECT *  FROM wd_planos  where ID = '$a' ");
		$data = $query->fetch();

		return $data[valor];

	}

	public function importerOziel($data)
	{



		foreach ($data as $item):

			$query = $this->db->insert(
				'wd_importer',
				array(

					'SIMCARD' => $item[A],
					'MDN' => $item[B],
					'F_SIMCARD' => $item[C],
					'F_MDN' => $item[D],


				)
			);
		endforeach;

	}

	public function importTransaction($id, $yes)
	{

		if ($yes):

			$fields = "


			b.nome as Plano,
			a.dias_uso as 'Dias de Uso',
			date_format(a.data_transacao, '%d/%m/%Y %H:%iHs') as 'Data da Transação',
			date_format(a.data_ativacao, '%d/%m/%Y') as 'Data de Ativação',
		date_format(a.data_off, '%d/%m/%Y') as 'Data Off',
			a.iccid as SIMCARD,
			a.mdn as MDN,
			j.local as 'Local de Uso',
			a.aparelhos as 'Aparelho',
			a.paises as 'Paises',
			if(tipo=1,'Venda',if(tipo=2, 'Desativação', 'Cancelamento')) as Tipo,
		if(a.status=1, 'Aguardando Swap Ativação', if(a.status=2, 'Ativo', if(a.status=3, 'Aguardando Swap Desativação', 'Desativado'))) as Status



		";

		else:


			$fields = "

		a.iccid as SIMCARD,
		e.nome as 'Fornecedor SIMCARD',
		a.mdn as MDN,
		f.nome as 'Fornecedor MDN',
		c.lote as 'Lote SIMCARD',
		m.lote as 'Lote MDN',
		f.nome as 'Fornecedor MDN',
		f.nome as 'Fornecedor MDN',
	    b.nome as Plano,
	    if(tipo=1,'Venda',if(tipo=2, 'Desativação', 'Cancelamento')) as Tipo,
	    date_format(a.data_transacao, '%d/%m/%Y  %H:%iHs') as 'Data da Transação',
		date_format(a.data_ativacao, '%d/%m/%Y') as 'Data de Ativação',
		date_format(a.data_off, '%d/%m/%Y') as 'Data Off',
		if(adiar, date_format(date(data_off) + Interval  adiar day, '%d/%m/%Y'), 'Não adiada') as 'Data Off Prorrogada',
		b.valor as 'Valor do Plano',
		(b.valor-a.valor_plano) as 'Desconto do Plano',
		a.valor_plano as 'Valor Final do Plano'
		if(g.area_atuacao=1, \"AERO\", if(g.area_atuacao=2, \"HD\", \"\") ) as 'Local de Atuação',



		g.nome as Atendente,
		h.`local` as 'Local da Venda',
		i.ponto as 'Ponto de Venda',

		a.nome as 'Nome do Cliente',
		a.celular as 'Celular',
		a.email as 'E-mail',
		a.documento as 'Documento',
		j.local as 'Local de Uso',
		a.dias_uso as 'Dias de Uso',
		a.valor_plano as 'Valor do Plano',
		if(nota_d>0, 'A', if(emitir_nota>0, 'S', '')) as N,

		k.forma_pagamento as 'Forma de Pagamento',
		l.moeda as 'Moeda',
		a.desconto as Desconto,
		a.valor_pago as 'Valor Pago',
		a.valor_dolar as 'Valor Dolar',
		a.valor_euro as 'Valor Euro',
		a.valor_real as 'Valor Real',
		a.valor_debito as 'Valor Débito',
		a.valor_credito as 'Valor Crédito',
		a.observacao as 'Observações',
		a.aparelhos as 'Aparelho',
		a.paises as 'Paises',
		if(a.origem=1, 'Painel', if(a.origem=2, 'Site', if(a.origem=3, 'Aeroporto', 'Corporativo'))) as Origem,
		detalhe as Detalhe

		";



		endif;

		$query = $this->db->query("SELECT

      	$fields


		FROM wd_transacoes a

		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
	    LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
		LEFT JOIN wd_status_mdn n ON m.status = n.ID
		LEFT JOIN wd_status_simcard o ON c.status = o.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID where a.ID = '$id' ");





		if (!$query) {

			return array();
		}


		return $query->fetch(PDO::FETCH_ASSOC);


	}



	public function getStatus($id)
	{

		$query = $this->db->query("SELECT status from wd_transacoes where ID = '$id'");

		if (!$query) {

			return array();
		}

		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data[status];


	}

	public function report()
	{


		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;

		unset($_GET[path], $_GET[p]);

		/*$_GET[helpdesk] = ($helpdesk?$helpdesk:'');*/

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "email":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;



					case "valor":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "valor":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

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

					case "status":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "dias_uso":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					/*case"helpdesk":

																																																				 $qs .= "status = '3' and ";

																																																				 break;*/

					case "nota_d":

						$qs .= ($_GET[nota_d] == 'A' ? 'nota_d' : 'emitir_nota') . " = 1 and ";

						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . trim($search) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';






		$query = $this->db->query('

		SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(a.data_off, "%d/%m/%Y") as data_off, date_format(a.data_transacao, "%d/%m/%Y %H:%iHs") as data_transacao,
		e.nome as fornecedor_simcard,
		f.nome as fornecedor_mdn,
		g.nome as atendente,
		h.`local` as local_venda,
		i.ponto as ponto_venda,
		j.local as local_uso,
		k.forma_pagamento as forma_pagamento,
		l.moeda as moeda,
		if(a.origem=1, \'Painel\', if(a.origem=2, \'Site\', if(a.origem=3, \'Aeroporto\', \'Corporativo\'))) as Origem,
		detalhe as Detalhe,
		(b.valor-a.valor_plano) as desconto_plano,
		a.valor_plano as final_plano
		b.valor as valor_plano,
		date_format(a.data_cancelamento, "%d/%m/%Y %H:%iHs") as data_cancelamento





		FROM ' . $this->table . ' a

		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID
		LEFT JOIN wd_status_simcard m on a.moeda = l.ID
		LEFT JOIN wd_status_mdn n on a.moeda = l.ID
		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
	    LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
		LEFT JOIN wd_status_mdn n ON m.status = n.ID
		LEFT JOIN wd_status_simcard o ON c.status = o.ID



		' . $qs . ' group by a.iccid ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');

		$count = $this->db->query('SELECT

		*

		FROM ' . $this->table . ' a



		' . $qs . ' group by a.iccid ORDER BY ID DESC');


		if (!$query) {
			return array();
		}

		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);

	}


	public function exportReport($id, $yes, $controle)
	{


		if ($yes):

			$_fields = array(
				'plano' => "b.nome as Plano",
				'dias_uso' => "a.dias_uso as 'Dias de Uso'",
				'data_transacao' => "date_format(a.data_transacao, '%d/%m/%Y  %H:%iHs') as 'Data da Transação'",
				'data_ativacao' => "date_format(a.data_ativacao, '%d/%m/%Y') as 'Data de Ativação'",
				'data_off' => "date_format(a.data_off, '%d/%m/%Y') as 'Data Off'",
				'iccid' => "a.iccid as SIMCARD",
				'mdn' => "a.mdn as MDN",
				'local_uso' => "j.local as 'Local de Uso'",
				'aparelhos' => "a.aparelhos as 'Aparelho'",
				'paises' => "a.paises as 'Paises'",
				'tipo' => "if(tipo=1,'Venda',if(tipo=2, 'Desativação', 'Cancelamento')) as Tipo",
				'status' => "if(a.status=1, 'Aguardando Swap Ativação', if(a.status=2, 'Ativo', if(a.status=3, 'Aguardando Swap Desativação', 'Desativado'))) as Status"
			);

		elseif ($controle):

			$_fields = array(

				'nome' => "a.nome as 'Nome do Cliente'",
				'plano' => "b.nome as Plano",
				'dias_uso' => "a.dias_uso as 'Dias de Uso'",
				'data_transacao' => "date_format(a.data_transacao, '%d/%m/%Y  %H:%iHs') as 'Data da Transação'",
				'data_ativacao' => "date_format(a.data_ativacao, '%d/%m/%Y') as 'Data de Ativação'",
				'data_off' => "date_format(a.data_off, '%d/%m/%Y') as 'Data Off'",
				'iccid' => "a.iccid as SIMCARD",
				'mdn' => "a.mdn as MDN",
				'fornecedor' => "f.apelido as 'Fornecedor MDN'",
				'tipo' => "if(tipo=1,'Venda',if(tipo=2, 'Desativação', 'Cancelamento')) as Tipo",
				'origem' => "if(a.origem=1, 'Painel', if(a.origem=2, 'Site', if(a.origem=3, 'Aeroporto', 'Corporativo'))) as Origem",
				'detalhe' => "detalhe as Entrega",
				'status' => "if(a.status=1, 'Aguardando Swap Ativação', if(a.status=2, 'Ativo', if(a.status=3, 'Aguardando Swap Desativação', 'Desativado'))) as Status",
				"nota_d" => "if(nota_d>0, 'A', if(emitir_nota>0, 'S', '')) as N",

			);


		else:

			parse_str($_COOKIE[reportSell], $fields);
			$defaultFields = array('nome', 'plano', 'dias_uso', 'data_transacao', 'data_ativacao', 'data_off', 'iccid', 'mdn', 'status');
			$fields = ($fields ? $fields[filter] : $defaultFields);


			$_fields = array(
				'iccid' => "a.iccid as SIMCARD",
				'fornecedor_simcard' => "e.nome as 'Fornecedor SIMCARD'",
				'mdn' => "a.mdn as MDN",
				'lote_mdn' => "o.lote as 'Lote MDN'",
				'lote_simcard' => "c.lote as 'Lote SIMCARD'",
				'fornecedor_mdn' => "f.nome as 'Fornecedor MDN'",
				'plano' => "b.nome as Plano",
				'voucher' => "a.voucher as Voucher",
				'tipo' => "if(tipo=1,'Venda',if(tipo=2, 'Desativação', 'Cancelamento')) as Tipo",
				'emitir_nota' => "a.emitir_nota as n",
				'data_transacao' => "date_format(a.data_transacao, '%d/%m/%Y  %H:%iHs') as 'Data da Transação'",
				'data_ativacao' => "date_format(a.data_ativacao, '%d/%m/%Y') as 'Data de Ativação'",
				'data_off' => "date_format(a.data_off, '%d/%m/%Y') as 'Data Off'",
				'adiar' => "if(adiar, date_format(date(data_off) + Interval  adiar day, '%d/%m/%Y'), 'Não adiada') as 'Data Off Prorrogada'",
				'atendente' => "g.nome as Atendente",
				'local_venda' => "h.`local` as 'Local da Venda'",
				'ponto_venda' => "i.ponto as 'Ponto de Venda'",
				'nome' => "a.nome as 'Nome do Cliente'",
				'celular' => "a.celular as 'Celular'",
				'email' => "a.email as 'E-mail'",
				'documento' => "a.documento as 'Documento'",
				'local_uso' => "j.local as 'Local de Uso'",
				'dias_uso' => "a.dias_uso as 'Dias de Uso'",
				'valor_plano' => "a.valor_plano as 'Valor do Plano'",
				'valor_plano' => "b.valor as 'Valor do Plano'",
				'desconto_plano' => "(b.valor-a.valor_plano) as 'Desconto do Plano'",
				'final_plano' => "a.valor_plano as 'Valor Final do Plano'",
				'forma_pagamento' => "k.forma_pagamento as 'Forma de Pagamento'",
				'moeda' => "l.moeda as 'Moeda'",
				'desconto' => "a.desconto as Desconto",
				'valor_pago' => "a.valor_pago as 'Valor Pago'",
				'valor_dolar' => "a.valor_dolar as 'Valor Dolar'",
				'valor_euro' => "a.valor_euro as 'Valor Euro'",
				'valor_real' => "a.valor_real as 'Valor Real'",
				'valor_debito' => "a.valor_debito as 'Valor Débito'",
				'valor_credito' => "a.valor_credito as 'Valor Crédito'",
				'observacao' => "a.observacao as 'Observações'",
				'aparelhos' => "a.aparelhos as 'Aparelho'",
				'ocorrencia' => "a.ocorrencia as 'TIpo'",
				'paises' => "a.paises as 'Paises'",
				'origem' => "if(a.origem=1, 'Painel', if(a.origem=2, 'Site', if(a.origem=3, 'Aeroporto', 'Corporativo'))) as Origem",
				'detalhe' => "detalhe as Detalhe",
				'helpdesk' => "if(helpdesk=1, 'Não', 'Sim') as Helpdesk",
				'reembolso' => "if(reembolso=1, 'Não', 'Sim')  as Reembolso",
				'cancelamento' => "if(tipo=3, 'Sim', 'Não')  as Cancelado",
				"nota_d" => "if(nota_d>0, 'A', if(emitir_nota>0, 'S', '')) as N",
				'status' => "if(a.status=1, 'Aguardando Swap Ativação', if(a.status=2, 'Ativo', if(a.status=3, 'Aguardando Swap Desativação', 'Desativado'))) as Status",
				'area_atuacao' => "if(g.area_atuacao=1, \"AERO\", if(g.area_atuacao=2, \"HD\", \"\") ) as 'Local de Atuação'",

			);



			foreach ($_fields as $key => $f):




				if (!in_array($key, $fields)):

					unset($_fields[$key]);

				endif;

			endforeach;

		endif;

		$f = implode(',', $_fields);


		if ($yes):

			$qs .= "a.tipo_transacao = '1' and ";

			$_GET = $_GET[data];

		endif;

		if ($controle):


			$qs .= "nota_d = 1 or emitir_nota = 1 and ";


		endif;


		unset($_GET[path], $_GET[p], $_GET[token], $_GET[customer], $_GET[debug]);

		/*$_GET[helpdesk] = ($helpdesk?$helpdesk:'');*/

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "email":

						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";

						break;

					case "valor":

						$qs .= $key . " = '" . formatMoney($search) . "' and ";

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

					case "status":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "dias_uso":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "atendente":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "local_venda":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					case "ponto_venda":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					/*case"helpdesk":

																																																				 $qs .= "status = '3' and ";

																																																				 break;

																																																			 case"helpdesk":

																																																				 $qs .= "status = '3' and ";

																																																				 break;*/


					case "nota_d":

						$qs .= ($_GET[nota_d] == 'A' ? 'nota_d' : 'emitir_nota') . " = 1 and ";

						break;

					case "IDS":

						$qs .= "ID in ($_GET[IDS]) and ";

						break;

					case "final_plano":

						$qs .= "a.valor_plano = '" . ($search) . "' and ";

						break;

					case "desconto_plano":

						$qs .= "(b.valor-a.valor_plano) = '" . ($search) . "' and ";

						break;

					case "valor_plano":

						$qs .= "b.valor = '" . ($search) . "' and ";

						break;



					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . trim($search) . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';

		/*echo "SELECT

																					$f


																					FROM wd_transacoes a

																					LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
																					LEFT JOIN wd_mdns o ON  a.mdn = o.mdn
																					LEFT JOIN wd_planos b ON a.plano = b.ID
																					LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
																					LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
																					LEFT JOIN wd_atendentes g ON a.atendente = g.ID
																					LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
																					LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
																					LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
																					LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
																					LEFT JOIN wd_status_simcard m on c.status = m.ID
																					LEFT JOIN wd_status_mdn n on o.status = n.ID

																					LEFT JOIN wd_moedas l on a.moeda = l.ID  $qs group by a.iccid order by data_transacao asc ";*/

		$query = $this->db->query("SELECT

      	$f


		FROM wd_transacoes a

		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
		LEFT JOIN wd_mdns o ON  a.mdn = o.mdn
		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_status_simcard m on c.status = m.ID
		LEFT JOIN wd_status_mdn n on o.status = n.ID

		LEFT JOIN wd_moedas l on a.moeda = l.ID  $qs group by a.iccid order by data_transacao asc ");



		if (!$query) {

			return array();
		}


		return $query->fetchAll(PDO::FETCH_ASSOC);


	}

	public function getMdnByPlane($plano)
	{





		$query = $this->db->query("SELECT b.*, b.fornecedor fornecedor_mdn  from wd_planos a LEFT JOIN wd_mdns b on a.fornecedor = b.fornecedor  where a.ID = '$plano' and b.status = '1' and if(b.fornecedor=7, if(b.fornecedor=7, if((select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), (select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), 0) < 36, a.ID>0) and if(qtd_dias<45, (a.qtd_dias+ if((select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn), (select sum(dias_uso) from wd_transacoes where mdn = b.mdn and datediff(b.repatriado, data_ativacao) < 0   group by mdn) , 0)) <= 45, a.ID>0), a.ID > 0) ORDER by liberado ASC LIMIT 1");

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data) {

			return $data;


		}



		if (!$data):



			$query4 = $this->db->query("SELECT b.*, b.fornecedor fornecedor_mdn  from wd_planos a LEFT JOIN wd_mdns b on a.fornecedor = b.fornecedor  where a.ID = '$plano' and b.status = '1'  ORDER by liberado DESC LIMIT 1");

			$data = $query4->fetch(PDO::FETCH_ASSOC);



			if ($data) {

				return $data;


			}

		endif;

	}



	function getMdn()
	{


		$sells = $this->db->query("select * from wd_transacoes where datediff(data_ativacao, now()) <= 1 and  (mdn is null or mdn = '')  ");



		foreach ($sells->fetchAll() as $_data):

			unset($data, $repatriar);

			/*if($_data[plano]==43 || $_data[plano]==42):

																																	 $repatriar =  $this->repatriar($_data[dias]);

																															endif;

																															if($repatriar):

																																$data = $repatriar;

																															endif;*/


			//if($data):



			$data = $this->GetMdnByPlane($_data['plano']);



			if ($data):

				$query = $this->db->update(
					$this->table,
					'ID',
					$_data[ID],
					array(

						'mdn' => $data[mdn],
						'fornecedor_mdn' => $data[fornecedor],
						'sa' => 0


					)
				);

				$query = $this->db->update(
					$this->tableMdn,
					'mdn',
					$data[mdn],
					array(

						'status' => 19,


					)
				);

			endif;


		endforeach;

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



		$query = $this->db->query("select (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) as dias_uso, a.*, a.fornecedor fornecedor_mdn  from wd_mdns  a where fornecedor = 7 and a.status = 1 " . $w . " order by (select sum(dias_uso) from wd_transacoes where mdn = a.mdn and datediff(a.repatriado, data_ativacao) < 0   group by mdn) DESC limit 1");


		$data = $query->fetch();



		if ($data):


			if (($dias + $data[dias_uso]) > 41):

				$this->db->update('wd_mdns', 'id', $data[ID], array('repatriado' => date('Y-m-d') . ' 00:00:00'));

			endif;

			return $data;

		endif;





	}

	public function sendTo()
	{

		$query = $this->db->update('wd_transacoes', 'ID', $_POST[id], array(($_POST[to] == 'HD' ? 'helpdesk' : 'reembolso') => 2));

		if ($query):

			echo 'ok';

		endif;

	}


	public function getDetails()
	{


		$query = $this->db->query('

		SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(a.data_nota, "%d/%m/%Y %H:%iHs") as data_nota, date_format(a.data_off, "%d/%m/%Y") as data_off, date_format(a.data_transacao, "%d/%m/%Y %H:%iHs") as data_transacao,
		e.nome as fornecedor_simcard,
		f.nome as fornecedor_mdn,
		f.apelido as fornecedor_alias,
		g.nome as atendente,
		h.`local` as local_venda,
		i.ponto as ponto_venda,
		j.local as local_uso,
		k.forma_pagamento as forma_pagamento,
		l.moeda as moeda,
		n.status as status_mdn,
		o.status as status_simcard,
		c.lote as lote_simcard,
		m.lote as lote_mdn,
		(b.valor-a.valor_plano) as desconto_plano,
		a.valor_plano as final_plano,
		b.valor as valor_plano



		FROM ' . $this->table . ' a

		LEFT JOIN wd_planos b ON a.plano = b.ID
		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID
	    LEFT JOIN wd_mdns m ON  a.mdn = m.mdn
		LEFT JOIN wd_status_mdn n ON m.status = n.ID
		LEFT JOIN wd_status_simcard o ON c.status = o.ID

		 where ID  = ' . $_GET[ID] . ' ');

	}

	public function cancelSell($id, $res)
	{


		$update = $this->db->query("update wd_simcards a left join wd_mdns b ON a.id_associacao = b.ID LEFT JOIN wd_transacoes c ON a.simcard = c.iccid SET a.`status` = '1', b.`status` = '1', c.status = '5', c.tipo = '3', c.responsavel_cancelamento = '$res',  id_associacao = 0 WHERE c.id_skillsim = '$id'");



	}

	public function getNf()
	{




	}

	public function geraNota()
	{



		$query = $this->db->update('wd_transacoes', 'ID', $_POST[id], array(($_POST[to] == 'HD' ? 'helpdesk' : 'reembolso') => 2));

		if ($query):

			echo 'ok';

		endif;


	}

	public function getDetalheFilter()
	{


		$query = $this->db->query("select detalhe from wd_transacoes WHERE detalhe > '0' group by detalhe");
		$query2 = $this->db->query("select sigla as detalhe from wd_ponto_de_venda where sigla > '' ");
		return $data = array_merge($query->fetchAll(), $query2->fetchAll());





	}


	public function recharge()
	{

		if ($_POST['iccid']):

			$query = $this->db->query("select ID, iccid, data_off from wd_transacoes a where iccid = '" . $_POST['iccid'] . "' and status = 2 ");
			$data = $query->fetch();


			if ($data):

				$query2 = $this->db->query("select qtd_dias, codigocmovel from wd_planos a where ID = '" . $_POST['plano'] . "' ");
				$data2 = $query2->fetch();


				$this->db->update('wd_transacoes', "ID", $data['ID'], array('adiar' => $data2['qtd_dias']));

				$this->db->insert(
					'wd_recargas',
					array(

						"id_transacao" => $data['ID'],
						"plano" => $_POST['plano'],
						"iccid" => $data['iccid'],
						"codigo" => $data2['codigocmovel'],
						"data" => $data['data_off'],

					)
				);

			endif;

		endif;


	}

	public function geraFatura()
	{

		$query = $this->db->query("SELECT ID FROM wd_transacoes where cod_fatura > 0");
		$data = $query->fetchAll();

		foreach ($data as $item):
			$this->gerFatura($item['ID']);
		endforeach;

	}

	public function sendEmail()
	{

		$modelEmail = $this->load_model('email/email-model');


		$query = $this->db->query("SELECT emitir_nota, ID, cod_fatura, cnpj, detalhe, date_format(data_ativacao, '%d/%m/%Y') as data_ativacao, date_format(data_transacao, '%d/%m/%Y') as data, nome, documento, email, dias_uso as dias, detalhe, format(valor_pago,  2, 'pt_BR') as valor   FROM wd_transacoes WHERE id = $_GET[id] AND DATEDIFF(date(data_transacao), '2023-05-31')  > 0");
		$data = $query->fetch(PDO::FETCH_ASSOC);

		$data['real_email'] = 'diego.mmn@hotmail.com';

		if ($data['emitir_nota'] == 3):

			$data['nome'] = 'Ao Consumidor';
			$data['email'] = 'Ao Consumidor';
			$data['documento'] = 'Ao Consumidor';

		endif;

		$data['documento'] = ($data['documento'] ? $data['documento'] : $data['cnpj']);


		$data['codigo'] = $data['cod_fatura'] ? $data['cod_fatura'] : ($this->getID($data['detalhe']) ? $this->getID($data['detalhe']) : 1);
		$data['maskCode'] = str_pad($data['codigo'], 5, "0", STR_PAD_LEFT);

		$data['cnpj'] = ($data['detalhe'] == 'VPS' ? '46.743.531/0003-37' : '46.743.531/0001-75');

		$send = $modelEmail->_sendEmail($data, 'Nota Fiscal', $data['email']);

	}

	public function getID($prefix)
	{

		if ($prefix == 'VPS'):

			$where = "detalhe = '$prefix'";

		else:

			$where = "detalhe NOT in('VPS', '', '0')";

		endif;

		$query = $this->db->query("SELECT (cod_fatura+1) as cod FROM wd_transacoes WHERE $where  AND cod_fatura > 0 ORDER BY cod_fatura desc LIMIT 1");
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data['cod'];

	}

	public function gerFatura($id)
	{


		$modelEmail = $this->load_model('email/email-model');

		$id = ($_GET['id'] ? $_GET['id'] : $id);

		$this->pdf = new Mpdf();


		$query = $this->db->query("SELECT emitir_nota, ID, cod_fatura, cnpj, detalhe, date_format(data_ativacao, '%d/%m/%Y') as data_ativacao, date_format(data_transacao, '%d/%m/%Y') as data, nome, documento, email, dias_uso as dias, detalhe, format(valor_pago,  2, 'pt_BR') as valor   FROM wd_transacoes WHERE id = '$id' AND DATEDIFF(date(data_transacao), '2023-05-31')  > 0");
		$data = $query->fetch(PDO::FETCH_ASSOC);

		$data['real_email'] = $data['email'];

		if ($data['emitir_nota'] == 3):

			$data['nome'] = 'Ao Consumidor';
			$data['email'] = 'Ao Consumidor';
			$data['documento'] = 'Ao Consumidor';

		endif;

		$data['documento'] = ($data['documento'] ? $data['documento'] : $data['cnpj']);


		$data['codigo'] = $data['cod_fatura'] ? $data['cod_fatura'] : ($this->getID($data['detalhe']) ? $this->getID($data['detalhe']) : 1);
		$data['maskCode'] = str_pad($data['codigo'], 5, "0", STR_PAD_LEFT);

		$data['cnpj'] = ($data['detalhe'] == 'VPS' ? '46.743.531/0003-37' : '46.743.531/0001-75');

		$body = file_get_contents(ABSPATH . '/views/templates/fatura.html');

		foreach ($data as $k => $v) {
			$body = str_replace('{' . $k . '}', $v, $body);
		}

		$this->pdf->WriteHTML($body);
		$this->adjustFontDescLineheight = 1.14;

		$this->pdf->Output(ABSPATH . '/views/faturas/' . $data['detalhe'] . '/' . $data['maskCode'] . '.pdf', 'F');
		$this->db->update('wd_transacoes', 'ID', $data['ID'], array('cod_fatura' => $data['codigo']));

		if ($data['real_email']):
			$send = $modelEmail->_sendEmail($data, 'Nota Fiscal ' . $data['maskCode'], $data['real_email'], ABSPATH . '/views/faturas/' . $data['detalhe'] . '/' . $data['maskCode'] . '.pdf');
		endif;

	}

	public function getLinkPdf()
	{

		$msg['code'] = '001';
		$msg['return'] = true;
		$msg['info'] = 'Fatura gerada com sucesso!';
		$msg['url'] = HOME_URI . '/views/faturas/' . $data['codigo'] . '.pdf';
		;

		echo json_encode($msg, JSON_UNESCAPED_UNICODE);

	}

	public function exportInvoices()
	{

		$ids = ($_GET['ids'] ? "AND a.id IN(" . $_GET['ids'] . ")" : '');

		unset($_GET[path], $_GET[ids], $_GET[debug]);


		foreach ($_GET as $key => $search):


			if ($search) {

				switch ($key):
					case "valor_pago":
						$qs .= $key . " = '" . formatMoney($search) . "' and ";

						break;

					case "plano":
						$qs .= $key . " = '" . $search . "' and ";
						break;

					case "documento":
						$qs .= "lower(documento) like '%" . trim(strtolower($search)) . "%' and ";
						break;

					case "email":
						$qs .= "lower(email) like '%" . trim(strtolower($search)) . "%' and ";
						break;

					case "data_transacao":
						$search = explode('-', $search);
						if ($search[0] or $search[1]):
							$qs .= "date(" . $key . ") between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;



					case "a|nome":
						$qs .= "lower(a.nome) like '%" . trim(strtolower($search)) . "%' and ";
						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . $search . "%' and ";
						break;
				endswitch;

			}
		endforeach;

		$qs = ($qs) ? 'and ' . substr($qs, 0, -4) : '';


		$query = $this->db->query("SELECT
      LPAD(cod_fatura, 5, 0) as 'Código',
			date_format(data_transacao, '%d/%m/%Y %H:%iHs') AS 'Data da transação',
			if(emitir_nota=3, 'Ao Consumidor', a.nome) as Nome,
			if(emitir_nota=3, 'Ao Consumidor', if(documento, documento, cnpj))  AS 'CPF/CNPJ',
			if(emitir_nota=3, 'Ao Consumidor', email) as 'Email',
			valor_pago as 'Valor Pago',
			iccid as 'Simcard',
			b.nome as Plano,
			detalhe as 'Origem',
			if(emitir_nota=3,'C','S') as 'Tipo'

			FROM wd_transacoes a left join wd_planos b on a.plano = b.ID WHERE cod_fatura > 0 $qs $ids order by cod_fatura DESC ");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';

		//  exit;


		return $result;

	}

	public function setTransaction($data)
	{

		$sellData = [
			'nome' => $data->name,
			'iccid' => $data->simcard,
			'pais' => $data->country,
			'aparelhos' => $data->device,
			'data_ativacao' => $data->activation_date,
			'data_off' => dateAdd('day', $data->days, $data->activation_date),
			'dias_uso' => $data->days,
			'valor_pago' => $data->amount,
			'email' => $data->email,
			'celular' => $data->phone,
		];

		$this->db->insert($this->table, $sellData);
		$last_id = $this->db->last_id;

		return $last_id;


	}

}

