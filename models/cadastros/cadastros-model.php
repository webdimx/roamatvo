<?php
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class CadastrosModel extends MainController
{


	public $form_data;
	public $form_msg;
	public $db;



	public function __construct($db = false)
	{

		$this->db = $db;
		$this->tablePlanos = 'wd_planos';
		$this->tableTransacoes = 'wd_transacoes';
		$this->tableFornecedores = 'wd_fornecedores';
		$this->tableAtendentes = 'wd_atendentes';
		$this->tableLocalVenda = 'wd_local_de_venda';
		$this->tableLocalEstoque = 'wd_local_de_estoque';
		$this->tablePontoVenda = 'wd_ponto_de_venda';
		$this->tableLocalUso = 'wd_local_de_uso';
		$this->tableFormasPagamento = 'wd_formas_pagamento';
		$this->tableMoedas = 'wd_moedas';
		$this->tableUsuarios = 'wd_colaboradores';
		$this->tableStatusMDN = 'wd_status_mdn';
		$this->tableStatusSimcard = 'wd_status_simcard';
		$this->tableTipoUso = 'wd_tipo_de_uso';
		$this->tableMdn = 'wd_mdns';
		$this->tableSimcard = 'wd_simcards';
		$this->tableEnvios = 'wd_envios';
		$this->tableEnviosSim = 'wd_envios_simcards';
		$this->tablePaises = 'wd_paises';
		$this->tableContinentes = 'wd_continentes';

		$notify = $this->load_model('relatorios/relatorios-model');
		$this->notify = $notify->checkNotify();

	}



	public function _submit($table, $lote)
	{



		$this->form_data = array();

		if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST)) {

			foreach ($_POST[cadastros] as $key => $value) {

				$this->form_data[$key] = $value;
			}

		} else {

			return;

		}


		// Planos

		if ($table == 'planos'):



			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tablePlanos,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'nome' => chk_array($this->form_data, 'nome'),
						'valor' => formatMoney(chk_array($this->form_data, 'valor')),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'qtd_dias' => chk_array($this->form_data, 'qtd_dias'),
						'codigo_plano' => chk_array($this->form_data, 'codigo_plano'),
						'pais' => chk_array($this->form_data, 'pais'),
						'continente' => chk_array($this->form_data, 'continente'),
						'fornecedor' => chk_array($this->form_data, 'fornecedor'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);


				$this->db->query("delete from wd_planos_opcoes where id_plano = '" . chk_array($this->form_data, 'ID') . "'  ");

				$opcoes = $this->generateOptions(chk_array($this->form_data, 'ID'));

				foreach ($opcoes as $opcao) {
					$this->db->insert("wd_planos_opcoes", $opcao);
				}



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:




				$query = $this->db->insert(
					$this->tablePlanos,
					array(

						'nome' => chk_array($this->form_data, 'nome'),
						'valor' => formatMoney(chk_array($this->form_data, 'valor')),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'qtd_dias' => chk_array($this->form_data, 'qtd_dias'),
						'codigo_plano' => chk_array($this->form_data, 'codigo_plano'),
						'local_uso' => chk_array($this->form_data, 'local_uso'),
						'pais' => chk_array($this->form_data, 'pais'),
						'continente' => chk_array($this->form_data, 'continente'),
						'observacao' => chk_array($this->form_data, 'observacao'),
						'fornecedor' => chk_array($this->form_data, 'fornecedor'),

					)
				);

				$opcoes = $this->generateOptions($this->db->last_id);

				foreach ($opcoes as $opcao) {
					$this->db->insert("wd_planos_opcoes", $opcao);
				}


				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		// FOrnecedores

		if ($table == 'fornecedores'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableFornecedores,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'nome' => chk_array($this->form_data, 'nome'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'email' => chk_array($this->form_data, 'email'),
						'celular' => chk_array($this->form_data, 'celular'),
						'exibir_transacao' => chk_array($this->form_data, 'exibir_transacao'),
						'apelido' => chk_array($this->form_data, 'apelido'),
						'tipo_transacao' => chk_array($this->form_data, 'tipo_transacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:


				if ($this->exists($this->tableFornecedores, 'nome', chk_array($this->form_data, 'nome'))):

					echo $this->form_msg = 'exists';
					return;

				endif;


				$query = $this->db->insert(
					$this->tableFornecedores,
					array(

						'nome' => chk_array($this->form_data, 'nome'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'email' => chk_array($this->form_data, 'email'),
						'celular' => chk_array($this->form_data, 'celular'),
						'exibir_transacao' => chk_array($this->form_data, 'exibir_transacao'),
						'apelido' => chk_array($this->form_data, 'apelido'),
						'tipo_transacao' => chk_array($this->form_data, 'tipo_transacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),


					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// Atendentes

		if ($table == 'atendentes'):

			if (chk_array($this->form_data, 'action') == 'edit'):




				$query = $this->db->update(
					$this->tableAtendentes,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'nome' => chk_array($this->form_data, 'nome'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'area_atuacao' => chk_array($this->form_data, 'area_atuacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),



					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:


				if ($this->exists($this->tableAtendentes, 'nome', chk_array($this->form_data, 'nome'))):

					echo $this->form_msg = 'exists';
					return;

				endif;

				$query = $this->db->insert(
					$this->tableAtendentes,
					array(

						'nome' => chk_array($this->form_data, 'nome'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'area_atuacao' => chk_array($this->form_data, 'area_atuacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),

					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// Locais de Venda

		if ($table == 'localdevenda'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableLocalVenda,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'local' => chk_array($this->form_data, 'local'),
						'sigla' => chk_array($this->form_data, 'sigla'),
						'ponto' => chk_array($this->form_data, 'ponto'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:


				if ($this->exists($this->tableLocalVenda, 'local', chk_array($this->form_data, 'local'))):

					echo $this->form_msg = 'exists';
					return;

				endif;

				$query = $this->db->insert(
					$this->tableLocalVenda,
					array(

						'local' => chk_array($this->form_data, 'local'),
						'ponto' => chk_array($this->form_data, 'ponto'),
						'sigla' => chk_array($this->form_data, 'sigla'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),

					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		// Paises

		if ($table == 'paises'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tablePaises,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(
						'nome' => chk_array($this->form_data, 'nome'),
						'codigo' => chk_array($this->form_data, 'codigo'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);

				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}

			else:


				if ($this->exists($this->tablePaises, 'nome', chk_array($this->form_data, 'nome'))):

					echo $this->form_msg = 'exists';
					return;

				endif;

				$query = $this->db->insert(
					$this->tablePaises,
					array(
						'nome' => chk_array($this->form_data, 'nome'),
						'codigo' => chk_array($this->form_data, 'codigo'),
						'continente' => chk_array($this->form_data, 'continente'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		// Continentes

		if ($table == 'continentes'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableContinentes,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'nome' => chk_array($this->form_data, 'local'),
						'codigo' => chk_array($this->form_data, 'codigo'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);

				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:

				if ($this->exists($this->tableContinentes, 'nome', chk_array($this->form_data, 'nome'))):

					echo $this->form_msg = 'exists';
					return;

				endif;

				$query = $this->db->insert(
					$this->tableContinentes,
					array(

						'nome' => chk_array($this->form_data, 'local'),
						'codigo' => chk_array($this->form_data, 'codigo'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),

					)
				);
				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// Ponto de Vendas



		if ($table == 'pontodevenda'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tablePontoVenda,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'local' => chk_array($this->form_data, 'local'),
						'ponto' => chk_array($this->form_data, 'ponto'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
						'aeroporto' => chk_array($this->form_data, 'aeroporto'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:

				if ($this->exists($this->tablePontoVenda, 'ponto', chk_array($this->form_data, 'ponto'))):

					echo $this->form_msg = 'exists';
					return;

				endif;


				$query = $this->db->insert(
					$this->tablePontoVenda,
					array(

						'local' => chk_array($this->form_data, 'local'),
						'ponto' => chk_array($this->form_data, 'ponto'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
						'aeroporto' => chk_array($this->form_data, 'aeroporto'),

					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// Locais de Uso

		if ($table == 'localdeuso'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableLocalUso,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'local' => chk_array($this->form_data, 'local'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:




				$query = $this->db->insert(
					$this->tableLocalUso,
					array(

						'local' => chk_array($this->form_data, 'local'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);


				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		if ($table == 'localdeestoque'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableLocalEstoque,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'local' => chk_array($this->form_data, 'local'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:




				$query = $this->db->insert(
					$this->tableLocalEstoque,
					array(

						'local' => chk_array($this->form_data, 'local'),
						'situacao' => chk_array($this->form_data, 'situacao'),
						'observacao' => chk_array($this->form_data, 'observacao'),
					)
				);


				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// FOrmas de Pagamento

		if ($table == 'formasdepagamento'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableFormasPagamento,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'forma_pagamento' => chk_array($this->form_data, 'forma_pagamento'),
						'sigla' => chk_array($this->form_data, 'sigla'),
						'situacao' => chk_array($this->form_data, 'situacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:




				$query = $this->db->insert(
					$this->tableFormasPagamento,
					array(

						'forma_pagamento' => chk_array($this->form_data, 'forma_pagamento'),
						'sigla' => chk_array($this->form_data, 'sigla'),
						'situacao' => chk_array($this->form_data, 'situacao'),

					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// Moedas

		if ($table == 'moedas'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableMoedas,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'moeda' => chk_array($this->form_data, 'moeda'),
						'situacao' => chk_array($this->form_data, 'situacao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:




				$query = $this->db->insert(
					$this->tableMoedas,
					array(

						'moeda' => chk_array($this->form_data, 'moeda'),
						'situacao' => chk_array($this->form_data, 'situacao'),
					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// Usuarios

		if ($table == 'statusmdn'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableStatusMDN,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'status' => chk_array($this->form_data, 'status'),
						'observacao' => chk_array($this->form_data, 'observacao'),


					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:

				if ($this->exists($this->tableStatusMDN, 'status', chk_array($this->form_data, 'status'))):

					echo $this->form_msg = 'exists';
					return;

				endif;


				$query = $this->db->insert(
					$this->tableStatusMDN,
					array(

						'status' => chk_array($this->form_data, 'status'),
						'observacao' => chk_array($this->form_data, 'observacao'),


					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		// Usuarios

		if ($table == 'statussimcard'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableStatusSimcard,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'status' => chk_array($this->form_data, 'status'),
						'observacao' => chk_array($this->form_data, 'observacao'),


					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:


				if ($this->exists($this->tableStatusSimcard, 'status', chk_array($this->form_data, 'status'))):

					echo $this->form_msg = 'exists';
					return;

				endif;

				$query = $this->db->insert(
					$this->tableStatusSimcard,
					array(

						'status' => chk_array($this->form_data, 'status'),
						'observacao' => chk_array($this->form_data, 'observacao'),


					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		if ($table == 'tipodeuso'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableTipoUso,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'codigo' => chk_array($this->form_data, 'codigo'),
						'tipo' => chk_array($this->form_data, 'tipo'),
						'apelido' => chk_array($this->form_data, 'apelido'),
						'destino_mdn' => chk_array($this->form_data, 'destino_mdn'),
						'destino_simcard' => chk_array($this->form_data, 'destino_simcard'),
						'associacao' => chk_array($this->form_data, 'associacao'),
						'descricao' => chk_array($this->form_data, 'descricao'),
					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:

				if ($this->exists($this->tableTipoUso, 'codigo', chk_array($this->form_data, 'codigo'))):

					echo $this->form_msg = 'exists';
					return;

				endif;


				$query = $this->db->insert(
					$this->tableTipoUso,
					array(

						'codigo' => chk_array($this->form_data, 'codigo'),
						'tipo' => chk_array($this->form_data, 'tipo'),
						'apelido' => chk_array($this->form_data, 'apelido'),
						'destino_mdn' => chk_array($this->form_data, 'destino_mdn'),
						'destino_simcard' => chk_array($this->form_data, 'destino_simcard'),
						'associacao' => chk_array($this->form_data, 'associacao'),
						'descricao' => chk_array($this->form_data, 'descricao'),

					)
				);






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;

		// MDN

		if ($table == 'mdn'):

			if (chk_array($this->form_data, 'action') == 'edit'):


				$query = $this->db->update(
					$this->tableMdn,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(


						'mdn' => chk_array($this->form_data, 'mdn'),
						'fornecedor' => chk_array($this->form_data, 'fornecedor_mdn'),
						'status' => chk_array($this->form_data, 'status_mdn'),
						'tipo_uso' => chk_array($this->form_data, 'tipo_uso'),
						'lote' => chk_array($this->form_data, 'lote'),
						'observacoes' => chk_array($this->form_data, 'observacoes')

					)
				);



				if (!$query) {
					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:




				if ($lote):

					return;

					$check = $this->importExists(chk_array($this->form_data, 'mdn'), 1);

					echo $c = json_decode($check);

					if ($c->return):

						echo $check;

						return;

					endif;

					$x = 0;

					echo $term = $this->form_data[mdn];

					foreach ($term as $mdn):


						$query = $this->db->insert(
							$this->tableMdn,
							array(

								'mdn' => $this->form_data[mdn][$x],
								'fornecedor' => $this->form_data[fornecedor_mdn][$x],
								'status' => $this->form_data[status_mdn][$x],
								'tipo_uso' => $this->form_data[tipo_uso][$x],
								'lote' => $this->form_data[lote][$x],

							)
						);
						$x++;

					endforeach;



				else:



					$check = $this->importExists(chk_array($this->form_data, 'mdn'), 1);

					$c = json_decode($check);

					if ($c->return):

						echo $check;

						return;

					endif;


					$query = $this->db->insert(
						$this->tableMdn,
						array(


							'mdn' => chk_array($this->form_data, 'mdn'),
							'fornecedor' => chk_array($this->form_data, 'fornecedor_mdn'),
							'status' => chk_array($this->form_data, 'status_mdn'),
							'tipo_uso' => chk_array($this->form_data, 'tipo_uso'),
							'lote' => chk_array($this->form_data, 'lote'),
							'observacoes' => chk_array($this->form_data, 'observacoes')

						)
					);


				endif;







				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		// SIMCARD


		if ($table == 'simcard'):

			if (chk_array($this->form_data, 'action') == 'edit'):



				$query = $this->db->update(
					$this->tableSimcard,
					'ID',
					chk_array($this->form_data, 'ID'),
					array(

						'simcard' => chk_array($this->form_data, 'simcard'),
						'codigo' => chk_array($this->form_data, 'codigo'),
						'fornecedor' => chk_array($this->form_data, 'fornecedor_simcard'),
						'status' => chk_array($this->form_data, 'status_simcard'),
						'local_estoque' => chk_array($this->form_data, 'local_estoque'),
						'lote' => chk_array($this->form_data, 'lote'),
						'observacoes' => chk_array($this->form_data, 'observacoes')

					)
				);

				if (chk_array($this->form_data, 'status_simcard') == 1):

					$q = $this->db->query("select * from $this->tableSimcard where ID = '" . chk_array($this->form_data, 'ID') . "' ");
					$d = $q->fetch();

					if ($d[id_associacao]):
						$query = $this->db->update(
							$this->tableMdn,
							'ID',
							$d[id_associacao],
							array(


								'status' => 1,


							)
						);
					endif;


				endif;



				if (!$query) {



					echo $this->form_msg = 'error_update';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success_update';
					// Termina
					return;
				}


			else:


				if ($lote):



					if ($this->importExists($this->form_data[simcard], 2)):
						echo $this->form_msg = 'exists';
						return;

					endif;

					$x = 0;

					foreach ($this->form_data[simcard] as $simcard):


						$query = $this->db->insert(
							$this->tableSimcard,
							array(

								'simcard' => $simcard,
								'codigo' => $this->form_data[codigo][$x],
								'fornecedor' => $this->form_data[fornecedor_simcard][$x],
								'status' => $this->form_data[status_simcard][$x],
								'local_estoque' => $this->form_data[local_estoque][$x],
								'lote' => $this->form_data[lote][$x],

							)
						);
						$x++;

					endforeach;



				else:


					$check = $this->importExists(chk_array($this->form_data, 'mdn'), chk_array($this->form_data, 'simcard'));
					$c = json_decode($check);

					if ($c->return):

						echo $check;

						return;

					endif;

					$query = $this->db->insert(
						$this->tableSimcard,
						array(

							'simcard' => chk_array($this->form_data, 'simcard'),
							'codigo' => chk_array($this->form_data, 'codigo'),
							'fornecedor' => chk_array($this->form_data, 'fornecedor_simcard'),
							'status' => chk_array($this->form_data, 'status_simcard'),
							'local_estoque' => chk_array($this->form_data, 'local_estoque'),
							'lote' => chk_array($this->form_data, 'lote'),
							'observacoes' => chk_array($this->form_data, 'observacoes')
						)
					);


				endif;






				if (!$query) {
					echo $this->form_msg = 'error';
					// Termina
					return;
				} else {
					echo $this->form_msg = 'success';
					// Termina
					return;
				}

			endif;

		endif;


		return $this->form_msg;

	}






	public function getList($table)
	{

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		unset($_GET[path], $_GET[p]);

		unset($_GET[path], $_GET[p]);

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "local":
						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " like '%" . strtolower($search) . "%' and ";
						break;

					case "situacao":
						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " = '" . strtolower($search) . "' and ";
						break;

					case "email":

						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " = '" . strtolower($search) . "' and ";

						break;

					case "valor":

						$qs .= "$key" . " = '" . $search . "' and ";

						break;




					case "continente":

						$qs .= "c.ID = '" . $search . "' and ";

						break;


					case "fornecedor_simcard":

						$qs .= "a.fornecedor = '" . $search . "' and ";

						break;

					case "status_simcard":

						$qs .= "a.status = '" . $search . "' and ";

						break;

					case "fornecedor_mdn":

						$qs .= "a.fornecedor = '" . $search . "' and ";

						break;

					case "status_mdn":

						$qs .= "a.status = '" . $search . "' and ";

						break;

					case "lote":

						$qs .= "a.lote = '" . $search . "' and ";

						break;



					case "qtd_dias":

						$qs .= "$key" . " = '" . formatMoney($search) . "' and ";

						break;

					case "data_vencimento":

						$qs .= "date(" . $key . ") = '" . dateDB($search) . "' and ";

						break;

					case "data":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(a.data) between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;





					default:

						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " like '%" . strtolower($search) . "%' and ";

						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';


		if ($table == 'planos'):


			$query = $this->db->query('SELECT
				a.*, b.nome as pais,
				c.nome as continente,
				(select nome from wd_planos_opcoes where id_plano = a.ID and preferencial = "1" )  as preferencial,
				(SELECT ob.nome from wd_planos_opcoes oa LEFT JOIN wd_fornecedores ob ON oa.fornecedor = ob.ID where id_plano = a.ID and preferencial = "1" ) as fornecedor
				FROM `' . $this->tablePlanos . '` a
				LEFT Join `' . $this->tablePaises . '` b ON a.pais = b.ID
				LEFT Join `' . $this->tableContinentes . '` c ON a.continente = c.ID  ' . $qs . '
				ORDER BY a.nome ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');


			$count = $this->db->query('SELECT a.*  FROM `' . $this->tablePlanos . '` a ' . $qs . ' ORDER BY nome ASC');


		elseif ($table == 'atendentes'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableAtendentes . '` a ' . $qs . '   ORDER BY nome ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableAtendentes . '` a ' . $qs . ' ORDER BY  nome ASC ');

		elseif ($table == 'localdevenda'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableLocalVenda . '` a ' . $qs . '   ORDER BY local ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableLocalVenda . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'paises'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tablePaises . '` a ' . $qs . '   ORDER BY nome ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tablePaises . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'continentes'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableContinentes . '` a ' . $qs . '   ORDER BY nome ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableContinentes . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'pontodevenda'):

			$query = $this->db->query('SELECT a.*, b.local as local FROM `' . $this->tablePontoVenda . '` a  LEFT JOIN  `' . $this->tableLocalVenda . '` b ON a.local = b.ID ' . $qs . ' ORDER BY ponto ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');

			$count = $this->db->query('SELECT a.*  FROM `' . $this->tablePontoVenda . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'fornecedores'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableFornecedores . '` a ' . $qs . '   ORDER BY nome ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableFornecedores . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'moedas'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableMoedas . '` a ' . $qs . '   ORDER BY moeda ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableMoedas . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'formasdepagamento'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableFormasPagamento . '` a ' . $qs . '   ORDER BY forma_pagamento ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableFormasPagamento . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'localdeuso'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableLocalUso . '` a ' . $qs . '   ORDER BY local ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableLocalUso . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'localdeestoque'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableLocalEstoque . '` a ' . $qs . '   ORDER BY local ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableLocalEstoque . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'statusmdn'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableStatusMDN . '` a ' . $qs . '   ORDER BY status ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableStatusMDN . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'statussimcard'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableStatusSimcard . '` a ' . $qs . '   ORDER BY status ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableStatusSimcard . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'tipodeuso'):

			$query = $this->db->query('SELECT a.*  FROM `' . $this->tableTipoUso . '` a ' . $qs . '   ORDER BY ID ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableTipoUso . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'envios'):

			$query = $this->db->query('SELECT a.*, b.local as local_estoque, date_format(data, "%d/%m/%Y") as data  FROM `' . $this->tableEnvios . '` a LEFT JOIN `' . $this->tableLocalEstoque . '` b ON a.local_estoque = b.ID ' . $qs . '   ORDER BY ID ASC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableEnvios . '` a ' . $qs . ' ORDER BY ID DESC');

		elseif ($table == 'mdn'):


			$query = $this->db->query('SELECT a.*, b.status as status, Concat(c.codigo," - ", c.apelido) as tipo_uso, date_format(a.data, "%d/%m/%Y") as data, d.nome as fornecedor, a.tipo_uso as tu, simcard  FROM `' . $this->tableMdn . '` a  left join `' . $this->tableStatusMDN . '` b on a.status = b.ID left join `' . $this->tableTipoUso . '` c ON a.tipo_uso = c.ID LEFT JOIN `' . $this->tableFornecedores . '` d on a.fornecedor = d.ID LEFT JOIN wd_simcards f on f.id_associacao = a.ID  ' . ($qs ? $qs . ' and mdn >0' : 'where mdn >0 ') . '  ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');

			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableMdn . '` a ' . ($qs ? $qs . ' and mdn >0' : 'where mdn >0 ') . ' ORDER BY ID DESC');

		elseif ($table == 'simcard'):


			$query = $this->db->query('SELECT a.*,  b.status as status, date_format(a.data, "%d/%m/%Y") as data, d.local as local_estoque,  e.nome as fornecedor, mdn    FROM `' . $this->tableSimcard . '` a  left join `' . $this->tableStatusSimcard . '` b on a.status = b.ID  LEFT JOIN `' . $this->tableLocalEstoque . '` d on a.local_estoque = d.ID  LEFT JOIN `' . $this->tableFornecedores . '` e on a.fornecedor = e.ID LEFT JOIN wd_mdns f on a.id_associacao = f.ID  ' . ($qs ? $qs . ' and simcard >0' : 'where simcard >0 ') . '   ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');

			$count = $this->db->query('SELECT a.*  FROM `' . $this->tableSimcard . '` a ' . ($qs ? $qs . ' and simcard >0' : 'where simcard >0 ') . ' ORDER BY ID DESC');

		endif;








		if (!$query) {
			return array();

		}

		$fetch = $query->fetchAll();


		return array('data' => $fetch, 'total' => ($_GET[fornecedor_mdn] == 6 && $table == 'mdn' ? count($count->fetchAll()) : count($count->fetchAll())), 'page' => $page);


	}


	public function getRegistry($id, $table)
	{

		if ($table == 'planos'):

			$query = $this->db->query("SELECT a.*, format(a.valor,2, 'pt_BR') as valor   FROM `" . $this->tablePlanos . "` a where ID = '" . $id . "'");
			$query2 = $this->db->query("Select * from wd_planos_opcoes where id_plano = " . $id . "");

		endif;

		if ($table == 'atendentes'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableAtendentes . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'paises'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tablePaises . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'continentes'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableContinentes . "` where ID = '" . $id . "'");
		endif;


		if ($table == 'localdevenda'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableLocalVenda . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'pontodevenda'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tablePontoVenda . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'fornecedores'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableFornecedores . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'moedas'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableMoedas . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'formasdepagamento'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableFormasPagamento . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'localdeuso'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableLocalUso . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'localdeestoque'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableLocalEstoque . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'statusmdn'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableStatusMDN . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'statussimcard'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableStatusSimcard . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'tipodeuso'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableTipoUso . "` where ID = '" . $id . "'");
		endif;

		if ($table == 'mdn'):

			$query = $this->db->query("SELECT *  FROM `" . $this->tableMdn . "` where ID = '" . $id . "'");

		endif;

		if ($table == 'simcard'):
			$query = $this->db->query("SELECT *  FROM `" . $this->tableSimcard . "` where ID = '" . $id . "'");
		endif;




		if (!$query) {
			return array();
		}

		if ($table == 'planos') {
			return ['plano' => $query->fetch(), 'opcoes' => $query2->fetchAll()];
		} else {
			return $query->fetchAll();
		}


	}


	public function getStatus($status)
	{

		if ($status == '0'):

			return array('Desligado', 'danger');

		elseif ($status == '1'):

			return array('Ativo', 'success');

		endif;

	}

	public function getInfo($type, $value)
	{


		if ($type == cpf):

			$query = "where $type = '$value'";

		elseif ($type == telefone):

			$query = "where $type = '$value'";

		endif;

		$query = $this->db->query("SELECT *  FROM `" . $this->table . "` $query ");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();


	}



	public function del($ids, $table)
	{

		//ini_set('display_errors', 1);

		$i = 0;
		foreach (explode(',', $ids) as $id):

			if ($this->checkRelation($table, $id)):

				$i = $i + 1;

			else:

				$del = $this->db->delete($table, 'ID', $id);

			endif;

		endforeach;


		if ($i):

			if ($i == 1):
				return 'alert1';
			else:
				return 'alert2';
			endif;


		else:
			return 'success';
		endif;

	}

	public function checkPer($array, $val, $edit)
	{

		if ($edit):

			return $check = (in_array($val, $array) ? 'checked' : '');

		else:

			return $check = 'checked';

		endif;

	}


	public function _getCategories($id)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableCategory . "` where modulo = '" . $id . "' ORDER BY ID DESC");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();

	}

	public function _getSubjects($id)
	{

		$query = $this->db->query("SELECT *  FROM `wd_agendamento_pauta` ORDER BY ID DESC");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();

	}

	public function _addCategory()
	{

		$query = $this->db->insert(
			$this->tableCategory,
			array(

				'nome' => $_POST['nome'],
				'modulo' => $_POST['modulo'],

			)
		);

		$last_id = $this->db->last_id;


		if (!$query) {
			echo $this->form_msg = 'error';
			return;
		} else {

			$line = '<tr>';
			$line .= '<td rowspan="1" colspan="1"><span>' . $_POST['nome'] . '</span><input type="text" name="nome" class="input-hide" data-type="categorias" value="' . $_POST['nome'] . '"></td>';
			$line .= '<td rowspan="1" colspan="1">
					 <a class="btn btn-xs btn-info edit-action" data-id="' . $last_id . '"  data-status="edit" data-action="categorias">
                     <i class="ace-icon fa fa-pencil bigger-120"></i>
                     </a>
                     <a class="btn btn-xs btn-danger delete-action"  data-id="' . $last_id . '"   data-action="categorias">
                     <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </a>
					 </td>';
			$line .= '</tr>';

			echo $line;
		}


	}

	public function _addSubject()
	{

		$query = $this->db->insert(
			'wd_agendamento_pauta',
			array(

				'nome' => $_POST['nome'],


			)
		);

		$last_id = $this->db->last_id;


		if (!$query) {
			echo $this->form_msg = 'error';
			return;
		} else {

			$line = '<tr>';
			$line .= '<td rowspan="1" colspan="1"><span>' . $_POST['nome'] . '</span><input type="text" name="nome" class="input-hide" data-type="pautas" value="' . $_POST['nome'] . '"></td>';
			$line .= '<td rowspan="1" colspan="1">
					 <a class="btn btn-xs btn-info edit-action" data-id="' . $last_id . '"  data-status="edit" data-action="agendamento_pauta">
                     <i class="ace-icon fa fa-pencil bigger-120"></i>
                     </a>
                     <a class="btn btn-xs btn-danger delete-action"  data-id="' . $last_id . '"   data-action="agendamento_pauta">
                     <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </a>
					 </td>';
			$line .= '</tr>';

			echo $line;
		}


	}


	public function _getRooms($id)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableRoom . "` ORDER BY ID DESC");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();

	}


	public function _getRoom($id)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableRoom . "` where ID = '$id'");
		if (!$query) {
			return array();
		}

		$result = $query->fetch();
		return ($field ? $result[$field] : $result['nome']);

	}

	public function _addRoom()
	{

		$query = $this->db->insert(
			$this->tableRoom,
			array(

				'nome' => $_POST['nome'],

			)
		);

		$last_id = $this->db->last_id;


		if (!$query) {
			echo $this->form_msg = 'error';
			return;
		} else {

			$line = '<tr>';
			$line .= '<td rowspan="1" colspan="1"><span>' . $_POST['nome'] . '</span><input type="text" name="nome" class="input-hide" data-type="salas" value="' . $_POST['nome'] . '"></td>';
			$line .= '<td rowspan="1" colspan="1">
					 <a class="btn btn-xs btn-info edit-action" data-id="' . $last_id . '"  data-status="edit" data-action="salas">
                     <i class="ace-icon fa fa-pencil bigger-120"></i>
                     </a>
                     <a class="btn btn-xs btn-danger delete-action"  data-id="' . $last_id . '"   data-action="salas">
                     <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </a>
					 </td>';
			$line .= '</tr>';

			echo $line;
		}


	}

	public function _getModalidades($id)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableModalidades . "` ORDER BY ID DESC");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();

	}

	public function _getModalidade($id, $field)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableModalidades . "` where ID = '$id'");
		if (!$query) {
			return array();
		}

		$result = $query->fetch();
		return ($field ? $result[$field] : $result['nome']);
	}

	public function _addModalidade()
	{

		$query = $this->db->insert(
			$this->tableModalidades,
			array(

				'nome' => $_POST['nome'],
				'cor' => $_POST['cor'],

			)
		);

		$last_id = $this->db->last_id;


		if (!$query) {
			echo $this->form_msg = 'error';
			return;
		} else {

			$line = '<tr>';
			$line .= '<td rowspan="1" colspan="1"><span>' . $_POST['nome'] . '</span><input type="text" name="nome" class="input-hide" data-type="modalidades" value="' . $_POST['nome'] . '"></td>';
			$line .= '<td rowspan="1" colspan="1"><div class="color-content" style="background:' . $_POST['cor'] . '">


                  </div>
                  <div class="color-container-edit">
                            <select class="simple-colorpicker hide">
                                <option value="#ac725e">#ac725e</option>
                                <option value="#d06b64">#d06b64</option>
                                <option value="#f83a22">#f83a22</option>
                                <option value="#fa573c">#fa573c</option>
                                <option value="#ff7537">#ff7537</option>
                                <option value="#ffad46" selected="">#ffad46</option>
                                <option value="#42d692">#42d692</option>
                                <option value="#16a765">#16a765</option>
                                <option value="#7bd148">#7bd148</option>
                                <option value="#b3dc6c">#b3dc6c</option>
                                <option value="#fbe983">#fbe983</option>
                                <option value="#fad165">#fad165</option>
                                <option value="#92e1c0">#92e1c0</option>
                                <option value="#9fe1e7">#9fe1e7</option>
                                <option value="#9fc6e7">#9fc6e7</option>
                                <option value="#4986e7">#4986e7</option>
                                <option value="#9a9cff">#9a9cff</option>
                                <option value="#b99aff">#b99aff</option>
                                <option value="#c2c2c2">#c2c2c2</option>
                                <option value="#cabdbf">#cabdbf</option>
                                <option value="#cca6ac">#cca6ac</option>
                                <option value="#f691b2">#f691b2</option>
                                <option value="#cd74e6">#cd74e6</option>
                                <option value="#a47ae2">#a47ae2</option>
                                <option value="#555">#555</option>
                            </select>
                            </div></td>';
			$line .= '<td rowspan="1" colspan="1">
					 <a class="btn btn-xs btn-info edit-action" data-id="' . $last_id . '"  data-status="edit" data-action="modalidades">
                     <i class="ace-icon fa fa-pencil bigger-120"></i>
                     </a>
                     <a class="btn btn-xs btn-danger delete-action"  data-id="' . $last_id . '"   data-action="modalidades">
                     <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </a>
					 </td>';
			$line .= '</tr>';

			echo $line;
		}


	}

	public function _getNiveis($id)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableNivel . "` ORDER BY ID DESC");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();

	}


	public function _getNivel($id, $field)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableNivel . "` where ID = '$id'");
		if (!$query) {
			return array();
		}

		$result = $query->fetch();
		return ($field ? $result[$field] : $result['nome']);
	}

	public function _addNivel()
	{

		$query = $this->db->insert(
			$this->tableNivel,
			array(

				'nome' => $_POST['nome'],

			)
		);

		$last_id = $this->db->last_id;


		if (!$query) {
			echo $this->form_msg = 'error';
			return;
		} else {

			$line = '<tr>';
			$line .= '<td rowspan="1" colspan="1"><span>' . $_POST['nome'] . '</span><input type="text" name="nome" class="input-hide" data-type="niveis" value="' . $_POST['nome'] . '"></td>';
			$line .= '<td rowspan="1" colspan="1">
					 <a class="btn btn-xs btn-info edit-action" data-id="' . $last_id . '"  data-status="edit" data-action="niveis">
                     <i class="ace-icon fa fa-pencil bigger-120"></i>
                     </a>
                     <a class="btn btn-xs btn-danger delete-action"  data-id="' . $last_id . '"   data-action="niveis">
                     <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </a>
					 </td>';
			$line .= '</tr>';

			echo $line;
		}


	}


	public function _getCustomFields($id)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableFields . "` where modulo = '" . $id . "' ORDER BY ID DESC");
		if (!$query) {
			return array();
		}

		return $query->fetchAll();

	}


	public function _getCustomField($id, $field)
	{

		$query = $this->db->query("SELECT *  FROM `" . $this->tableFields . "` where ID = '$id'");
		if (!$query) {
			return array();
		}

		$result = $query->fetch();
		return ($field ? $result[$field] : $result['nome']);
	}

	public function _addCustomFields()
	{

		$query = $this->db->insert(
			$this->tableFields,
			array(

				'nome' => $_POST['nome'],
				'modulo' => $_POST['modulo'],
				'codigo' => buildSlug($_POST['nome']),

			)
		);

		$last_id = $this->db->last_id;


		if (!$query) {
			echo $this->form_msg = 'error';
			return;
		} else {

			$line = '<tr>';
			$line .= '<td rowspan="1" colspan="1"><span>' . $_POST['nome'] . '</span><input type="text" name="nome" class="input-hide" data-type="modalidades" value="' . $_POST['nome'] . '"></td>';
			$line .= '<td rowspan="1" colspan="1">
					 <a class="btn btn-xs btn-info edit-action" data-id="' . $last_id . '">
                     <i class="ace-icon fa fa-pencil bigger-120"></i>
                     </a>
                     <a class="btn btn-xs btn-danger delete-action"  data-id="' . $last_id . '"   data-action="modalidades">
                     <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </a>
					 </td>';
			$line .= '</tr>';

			echo $line;
		}


	}

	public function _fastEdit()
	{


		if ($_POST[action] == 'alunos_notas'):

			$id = MainController::geTlogInfo('wd_alunos_notas', $_POST[id], 'aluno_id');
			MainController::log($_SESSION[userdata][user_id], 'O colaborador ' . $_SESSION[userdata][name] . ' editou a nota do aluno com matricula nº ' . MainController::geTlogInfo('wd_alunos', $id, 'matricula') . '');
		elseif ($_POST[action] == 'alunos_atividades'):

			$id = MainController::geTlogInfo('wd_alunos_atividades', $_POST[id], 'aluno_id');

			MainController::log($_SESSION[userdata][user_id], 'O colaborador ' . $_SESSION[userdata][name] . ' editou a nota da atividade online do aluno com matricula nº ' . MainController::geTlogInfo('wd_alunos', $id, 'matricula') . '');
		endif;

		$cor = ($_POST['cor'] ? array('cor' => $_POST['cor']) : array());
		$atividade = ($_POST['atividade'] ? array('atividade' => $_POST['atividade']) : array());
		$comentario = ($_POST['comentario'] ? array('comentarios' => $_POST['comentario']) : array());
		$nota = ($_POST['nota'] ? array('nota' => $_POST['nota']) : array());
		$qtd = ($_POST['qtd'] ? array('qtd' => $_POST['qtd']) : array());



		$nome = ($_POST[action] !== 'alunos_notas' ? array('nome' => $_POST['nome']) : array());



		$data = array_merge($nome, $cor, $atividade, $comentario, $nota, $qtd);

		$query = $this->db->update('wd_' . $_POST[action], 'ID', $_POST[id], $data);


	}

	public function _fastDelete()
	{

		if ($_POST[action] == 'alunos_notas'):

			$id = MainController::geTlogInfo('wd_alunos_notas', $_POST[id], 'aluno_id');

			MainController::log($_SESSION[userdata][user_id], 'O colaborador ' . $_SESSION[userdata][name] . ' deletou a nota do aluno com matricula nº ' . MainController::geTlogInfo('wd_alunos', $id, 'matricula') . '');

		elseif ($_POST[action] == 'alunos_atividades'):

			$id = MainController::geTlogInfo('wd_alunos_atividades', $_POST[id], 'aluno_id');

			MainController::log($_SESSION[userdata][user_id], 'O colaborador ' . $_SESSION[userdata][name] . ' deletou a nota da atividade online do aluno com matricula nº ' . MainController::geTlogInfo('wd_alunos', $id, 'matricula') . '');

		endif;

		if ($this->db->delete('wd_' . $_POST[action], 'ID', $_POST[id])):
			echo 'success';
		endif;



	}

	public function getLogs()
	{

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		unset($_GET[path], $_GET[p]);

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

					case "data_vencimento":

						$qs .= "date(" . $key . ") = '" . dateDB($search) . "' and ";

						break;

					case "status":

						$qs .= $key . " = '" . $search . "' and ";

						break;

					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . $search . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';


		$query = $this->db->query('SELECT * from wd_logs ' . $qs . ' ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
		$count = $this->db->query('SELECT * from wd_logs ' . $qs . ' ORDER BY ID DESC');


		if (!$query) {
			return array();
		}

		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);


	}


	public function getAlerts()
	{

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		unset($_GET[path], $_GET[p]);

		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):



					case "data":

						$qs .= "date(" . $key . ") = '" . dateDB($search) . "' and ";

						break;

					case "busca":

						$qs .= " (b.nome like '%$search%' or a.nome like '%$search%' or codigo = '$search') and ";

						break;



					default:
						$qs .= str_replace('|', '.', $key) . " like '%" . $search . "%' and ";
						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';



		$query = $this->db->query('SELECT a.*, b.nome as aluno from wd_alertas a LEFT JOIN wd_alunos b ON a.aluno_id = b.ID ' . $qs . ' ORDER BY ID DESC ' . ($page ? "LIMIT " . ($page - 1) * 20 . ",20" : "") . '');
		$count = $this->db->query('SELECT a.*, b.nome as aluno from wd_alertas a LEFT JOIN wd_alunos b ON a.aluno_id = b.ID ' . $qs . ' ORDER BY ID DESC');


		if (!$query) {
			return array();
		}

		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);


	}

	public function getSim()
	{


		$query = $this->db->query("SELECT a.*  FROM `" . $this->tableSimcard . "` a where a.simcard Like '%" . $_GET[term] . "%' and status = '1' and local_estoque != 16 ");
		if (!$query) {
			return array();
		}

		$l = $query->fetchAll();

		if ($l):
			return $_GET[callback] . '(' . json_encode($l) . ')';
		else:
			return $_GET[callback] . '(' . json_encode(array(array('simcard' => 'Simcard não disponível'))) . ')';
		endif;
	}

	public function exists($table, $cell, $value)
	{


		$count = $this->db->query("select * from $table where lower($cell) = '" . strtolower($value) . "' ");

		//echo "select * from $table where $cell = '$value'";

		if (!$count) {

			return array();
		}

		$fetch = $count->fetchAll();


		return count($fetch);

	}

	public function getPonto()
	{

		$query = $this->db->query("SELECT * from wd_ponto_de_venda where local = '$_POST[ID]'");


		if (!$query) {
			return array();
		}

		$fetch = $query->fetchAll();

		return ($fetch);

	}

	public function getMDN()
	{

		switch ($_POST[query]):

			case "sim":

				if ($_POST['for'] == 42):

					$query = $this->db->query("SELECT a.*, b.*, a.fornecedor as fornecedor_simcard, b.fornecedor as fornecedor_mdn, if((SELECT mdn FROM wd_mdns WHERE fornecedor = a.fornecedor AND (tipo_uso IS NULL OR tipo_uso = '') AND STATUS = 1 LIMIT 1 ), (SELECT mdn FROM wd_mdns WHERE fornecedor = a.fornecedor AND (tipo_uso IS NULL OR tipo_uso = '') AND STATUS = 1 LIMIT 1 ), '') AS mdn  FROM wd_simcards a left join wd_mdns b on a.id_associacao = b.ID where a.ID = '$_POST[sim]' ");

				elseif ($_POST['for'] == 46):



					$query = $this->db->query("SELECT a.*, b.*, a.fornecedor as fornecedor_simcard, a.fornecedor as fornecedor_mdn, if((SELECT mdn FROM wd_mdns WHERE fornecedor = a.fornecedor AND (tipo_uso IS NULL OR tipo_uso = '') AND STATUS = 1 LIMIT 1 ), (SELECT mdn FROM wd_mdns WHERE fornecedor = a.fornecedor AND (tipo_uso IS NULL OR tipo_uso = '') AND STATUS = 1 LIMIT 1 ), '') AS mdn  FROM wd_simcards a left join wd_mdns b on a.id_associacao = b.ID where a.ID = '$_POST[sim]' ");

				else:

					$query = $this->db->query("SELECT a.*, b.*, a.fornecedor as fornecedor_simcard, b.fornecedor as fornecedor_mdn from wd_simcards a left join wd_mdns b on a.id_associacao = b.ID where a.ID = '$_POST[sim]' ");

				endif;

				break;

			case "fornecedor":

				$query = $this->db->query("SELECT * from wd_mdns where fornecedor = '$_POST[sim]' and status = '1' ORDER by ID ASC ");

				break;

			case "plano":


				$query = $this->db->query("SELECT b.*, b.fornecedor as fornecedor_mdn from wd_planos a LEFT JOIN wd_mdns b on a.fornecedor = b.fornecedor  where a.ID = '$_POST[sim]' and status = '1' ORDER by liberado ASC Limit 1");

				break;

		endswitch;


		//$query = $this->db->query("SELECT * from wd_mdn where ID = '$sim' ");


		if (!$query) {

			return array();
		}

		$fetch = $query->fetchAll();


		return json_encode($fetch);

	}

	public function checkMdn($mdn)
	{

		$query = $this->db->query("SELECT *  from $this->tableMdn where mdn = '$mdn' ");
		$r = $query->fetchAll();

	}

	public function checkSimcard($simcard)
	{


		$query = $this->db->query("SELECT *  from $this->tableMdn where mdn = '$mdn' ");
		$r = $query->fetchAll();



	}

	public function importExists($item, $tipo)
	{

		$qs = 'where ' . ($tipo == 1 ? 'mdn' : 'simcard') . " = '" . $item . "'";

		//echo "SELECT COUNT(*) 	as total from ".($tipo==1?$this->tableMdn:$this->tableSimcard)."  $qs ";

		$query = $this->db->query("SELECT COUNT(*) 	as total from " . ($tipo == 1 ? $this->tableMdn : $this->tableSimcard) . "  $qs ");
		$r = $query->fetch();


		return $r[total];


	}


	public function checkRelation($table, $id)
	{


		switch ($table):

			case "wd_planos":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where plano = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_fornecedores":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableMdn where fornecedor = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_status_mdn":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableMdn where status = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_status_simcard":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableMdn where status = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_tipo_de_uso":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableMdn where tipo_uso = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_atendentes":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where atendente = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_local_de_venda":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where local_venda = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_ponto_de_venda":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where ponto_venda = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_local_de_uso":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where local_uso = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;



			case "wd_formas_pagamento":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where forma_pagamento = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

			case "wd_moedas":

				$query = $this->db->query("SELECT Count(*) as total  from $this->tableTransacoes where moeda = '$id' ");
				$count = $query->fetch();
				return $count[total];

				break;

		endswitch;


	}

	function sendToLocal($data)
	{


		$file = array_reverse(explode('/', $_POST[file]));

		$query = $this->db->insert(
			$this->tableEnvios,
			array(

				'lote' => $_POST[lote],
				'local_estoque' => $_POST[local_estoque],
				'anexo' => $file[0]


			)
		);



		foreach ($data as $item) {

			$query = $this->db->update(
				$this->tableSimcard,
				'simcard',
				$item[A],
				array(

					'local_estoque' => $_POST[local_estoque]

				)
			);

		}

	}


	function getSearch()
	{


		$query1 = $this->db->query("SELECT *, concat('ID: ', ID, ' - ', '(MDN)') as result, 'mdn' as tipo from wd_mdns where mdn like '$_GET[term]%' ");
		$query2 = $this->db->query("SELECT *, concat('ID: ', ID, ' - ', '(TRANSAÇÕES)') as result, 'venda' as tipo  from wd_transacoes where iccid like '$_GET[term]%' or mdn like '$_GET[term]%'  or nome like lower('%$_GET[term]%')");
		$query3 = $this->db->query("SELECT *, concat('ID: ', ID, ' - ', '(SIMCARD)') as result, 'simcard' as tipo from wd_simcards  where simcard like '$_GET[term]%'  ");


		if (!$query1) {

			$data1 = array();
		}

		if (!$query2) {

			$data2 = array();
		}

		if (!$query3) {

			$data3 = array();

		}

		$data1 = $query1->fetchAll();
		$data2 = $query2->fetchAll();
		$data3 = $query3->fetchAll();


		echo json_encode(array_merge($data1, $data2, $data3));


	}




	public function customImporter($a, $b, $d, $c, $e, $f, $g, $h, $i)
	{


		if ($_POST[tipo] == 1):

			$query = $this->db->insert(
				$this->tableMdn,
				array(

					'mdn' => ($_POST[tipo] == 1 || $_POST[tipo] == 3 ? $b : ''),
					'fornecedor' => ($_POST[tipo] == 1 || $_POST[tipo] == 3 ? $c : ''),
					'tipo_uso' => ($_POST[tipo] == 3 ? $e : ''),
					'status' => ($_POST[tipo] == 1 || $_POST[tipo] == 3 ? $f : ''),
					'lote' => $i

				)
			);


		elseif ($_POST[tipo] == 2):


			$query = $this->db->insert(
				$this->tableSimcard,
				array(

					'simcard' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $a : ''),
					'fornecedor' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $d : ''),
					'status' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $g : ''),
					'local_estoque' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $h : ''),
					'lote' => $i

				)
			);

		elseif ($_POST[tipo] == 3):


			$query = $this->db->insert(
				$this->tableMdn,
				array(

					'mdn' => ($_POST[tipo] == 1 || $_POST[tipo] == 3 ? $b : ''),
					'fornecedor' => ($_POST[tipo] == 1 || $_POST[tipo] == 3 ? $c : ''),
					'tipo_uso' => ($_POST[tipo] == 3 ? $e : ''),
					'status' => ($_POST[tipo] == 1 || $_POST[tipo] == 3 ? $f : ''),
					'lote' => $i

				)
			);

			$last_id = $this->db->last_id;


			$query = $this->db->insert(
				$this->tableSimcard,
				array(

					'id_associacao' => $last_id,
					'simcard' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $a : ''),
					'fornecedor' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $d : ''),
					'status' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $g : ''),
					'local_estoque' => ($_POST[tipo] == 2 || $_POST[tipo] == 3 ? $h : ''),
					'lote' => $i

				)
			);

		endif;



	}

	public function export()
	{

		$type = $_GET[type];

		unset($_GET[path], $_GET[p], $_GET[type]);

		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		unset($_GET[path], $_GET[p]);


		foreach ($_GET as $key => $search):

			if ($search) {

				switch ($key):

					case "ID":
						$qs .= str_replace('|', '.', $key) . " = '" . $search . "' and ";
						break;

					case "local":
						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " like '%" . strtolower($search) . "%' and ";
						break;

					case "situacao":
						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " = '" . strtolower($search) . "' and ";
						break;

					case "email":

						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " = '" . strtolower($search) . "' and ";

						break;

					case "valor":

						$qs .= "$key" . " = '" . $search . "' and ";

						break;





					case "fornecedor_simcard":

						$qs .= "a.fornecedor = '" . $search . "' and ";

						break;

					case "status_simcard":

						$qs .= "a.status = '" . $search . "' and ";

						break;

					case "fornecedor_mdn":

						$qs .= "a.fornecedor = '" . $search . "' and ";

						break;

					case "status_mdn":

						$qs .= "a.status = '" . $search . "' and ";

						break;

					case "lote":

						$qs .= "a.lote = '" . $search . "' and ";

						break;



					case "qtd_dias":

						$qs .= "$key" . " = '" . formatMoney($search) . "' and ";

						break;

					case "data_vencimento":

						$qs .= "date(" . $key . ") = '" . dateDB($search) . "' and ";

						break;

					case "data":

						$search = explode('-', $search);

						if ($search[0] or $search[1]):
							$qs .= "date(a.data) between date('" . dateDBS(trim($search[0])) . "') and  date('" . dateDBS(trim($search[1])) . "')  and ";
						endif;

						break;





					default:

						$qs .= "lower(" . str_replace('|', '.', $key) . ")" . " like '%" . strtolower($search) . "%' and ";

						break;

				endswitch;

			}

		endforeach;

		$qs = ($qs) ? 'where ' . substr($qs, 0, -4) : '';


		if ($type == 'simcard'):

			$query = $this->db->query('SELECT a.simcard as Simcard, b.status as Status, date_format(a.data, "%d/%m/%Y") as "Data Cadastro" , d.local as "Local de Estoque", e.nome as Fornecedor, a.lote as Lote, a.observacoes as Observações FROM `' . $this->tableSimcard . '` a  left join `' . $this->tableStatusSimcard . '` b on a.status = b.ID  LEFT JOIN `' . $this->tableLocalEstoque . '` d on a.local_estoque = d.ID  LEFT JOIN `' . $this->tableFornecedores . '` e on a.fornecedor = e.ID LEFT JOIN wd_mdns f on a.id_associacao = f.ID  ' . ($_GET[data] ? ' where a.ID in (' . implode(',', json_decode($_GET[data])) . ')' : $qs) . '   ORDER BY a.ID DESC ');

		else:



			$query = $this->db->query('SELECT a.mdn as MDN, b.status as Status, Concat(c.codigo," - ", c.apelido) as "Tipo de Uso", date_format(a.data, "%d/%m/%Y") as "Data de Cadastro", d.nome as Fornecedor, a.lote as Lote, a.observacoes as Observações FROM `' . $this->tableMdn . '` a  left join `' . $this->tableStatusMDN . '` b on a.status = b.ID left join `' . $this->tableTipoUso . '` c ON a.tipo_uso = c.ID LEFT JOIN `' . $this->tableFornecedores . '` d on a.fornecedor = d.ID  ' . ($_GET[data] ? ' where a.ID in (' . implode(',', json_decode($_GET[data])) . ')' : $qs) . '  ');

		endif;


		if (!$query) {
			return array();

		}

		$fetch = $query->fetchAll(PDO::FETCH_ASSOC);

		return $fetch;

	}

	public function delSim()
	{

		$query = $this->db->query("select * from wd_transacoes where iccid = '$_POST[ID]' ");

		if (!$query) {

			return array();

		}

		$fetch = $query->fetch();

		if (!$fetch):

			$this->db->delete('wd_simcards', 'simcard', $_POST[ID]);

		endif;

		echo ($fetch ? 1 : 0);


	}

	public function changeStatus($item, $status)
	{



		$query = $this->db->update(
			$this->tableMdn,
			'mdn',
			$item,
			array(

				'status' => $status

			)
		);

	}

	public function getCountries()
	{

		$query = $this->db->query("
			select a.ID, a.nome as name, b.nome as continent
			from wd_paises a
			left join wd_continentes b
			on a.continente = b.ID"
		);

		return $query->fetchAll(PDO::FETCH_ASSOC);

	}

	public function generateOptions($id)
	{

		$opcoes = [];
		$i = 0;
		foreach ($this->form_data['quantidade'] as $fields) {

			array_push($opcoes, [
				'nome' => $this->form_data['opcao_nome'][$i],
				'preferencial' => $this->form_data['preferencial'][$i],
				'quantidade' => $this->form_data['quantidade'][$i],
				'codigo' => $this->form_data['codigocmovel'][$i],
				'descricao' => $this->form_data['descricao'][$i],
				'fornecedor' => $this->form_data['fornecedor'][$i],
				'id_plano' => $id
			]);

			$i++;

		}

		return $opcoes;

	}

}
