<?php

class FinanceiroController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'financeiro';
	public $controller = 'financeiro';

    public function index() {
		
		$model = $this->load_model('financeiro/financeiro-model');
		
		$this->title = 'Gerenciar faturas';
		$this->menu = 'faturas';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/financeiro/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function detalhes() {
		
		$model = $this->load_model('financeiro/financeiro-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Resumo da Fatura';		
		$this->menu = 'usuarios';
		$this->action = 'view';
		$this->data = $model->getRegistry($parametros[0]);
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
	
      	$this->view[]  = ABSPATH . '/views/financeiro/view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
		
		
    } 
	
	public function adicionar() {
		
		$model = $this->load_model('financeiro/financeiro-model');
		$modelAlunos = $this->load_model('alunos/alunos-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Fatura';		
		$this->menu = 'financeiro';
		$this->form = 'financeiro/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/financeiro/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('financeiro/financeiro-model');
		$modelAlunos = $this->load_model('alunos/alunos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar fatura';		
		$this->menu = 'financeiro';
		$this->form = 'financeiro/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/financeiro/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('financeiro/financeiro-model');
		$model->_submit();
		
		
    } 
	
	function delRegistry(){
		
		$model = $this->load_model('financeiro/financeiro-model');
		echo $model->del($_POST[ids]);
		
	}
	
	public function boleto() {
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$model = $this->load_model('financeiro/financeiro-model');
		$data = $model->boletoInfo($this->Decrypta($parametros[0]));
		
		
		
		
		$dias_de_prazo_para_pagamento = 0;
		$taxa_boleto = 0.00;
		$dadosboleto["parcela"] = $data[parcela];
		$data_venc = formatDate($data[data_vencimento]);  
		$valor_cobrado = money($data[valor]); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
		$valor_cobrado = str_replace(",", ".",$valor_cobrado);
		$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
		$multa = 'R$'.money(($data[valor]/100)*2);
		
		
		$dadosboleto["parcela"] = $data[parcela];
		$dadosboleto["matricula"] = $data[matricula];
		$dadosboleto["nosso_numero"] = str_pad($data[boleto_id], 8, "0", STR_PAD_LEFT);;  // Nosso numero - REGRA: Máximo de 8 caracteres!
		$dadosboleto["numero_documento"] = str_pad($data[boleto_id], 4, "0", STR_PAD_LEFT);;	// Num do pedido ou nosso numero
		$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
		$dadosboleto["data_documento"] = formatDate($data[data_lancamento]); // Data de emissão do Boleto
		$dadosboleto["data_processamento"] = formatDate($data[data_lancamento]); // Data de processamento do boleto (opcional)
		$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
		
		// DADOS DO SEU CLIENTE
		$dadosboleto["sacado"] = $data[nome].' - '.$data[cpf];
		$dadosboleto["endereco1"] = $data[endereco].', '.$data[numero].', '.$data[complemento];
		$dadosboleto["endereco2"] = $data[cidade]." - ".$data[estado]." - ".$data[cep];
		
		
		
		// INFORMACOES PARA O CLIENTE
		$dadosboleto["demonstrativo1"] = "Fatura da escola Door Centro de Idiomas";
		$dadosboleto["demonstrativo2"] = "Fatura referente a mensalidade";
		$dadosboleto["demonstrativo3"] = "";
		
		
		$dadosboleto["instrucoes1"] = 'APOS O VENCIMENTO COBRAR JUROS DE..........R$ 0,09 AO DIA<br>
		APOS O VENCIMENTO COBRAR MULTA DE..........'.money($data[valor_multa]).'<br>
		ATE '.formatDate($data[data_desconto]).' CONCEDER DESCONTO DE..........R$ '.money($data[valor_desconto]).'<br>
		QUALQUER DUVIDA, FAVOR LIGAR: (43) 3361-6177
		';
		
		/*$dadosboleto["instrucoes1"] = '- '.str_replace(PHP_EOL, '<br>', $data[observacoes]);
		$dadosboleto["instrucoes2"] = "- Receber até $data[prazo] dias após o vencimento<br> - Sr. Caixa, cobrar multa de R$".money($data[valor_multa])." após o vencimento";*/
		$dadosboleto["instrucoes2"] = "<br>Door Centro de Idiomas - Rua Belo Horizonte, 809 - Centro - Londrina / PR<br>CNPJ: 26.480.075/0001-00";
		
		// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
		$dadosboleto["quantidade"] = "";
		$dadosboleto["valor_unitario"] = "";
		$dadosboleto["aceite"] = "";		
		$dadosboleto["especie"] = "R$";
		$dadosboleto["especie_doc"] = "";
		
		
		// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
		
		
		// DADOS DA SUA CONTA - ITAÚ
		$dadosboleto["agencia"] = "0109"; // Num da agencia, sem digito
		$dadosboleto["conta"] = "85640";	// Num da conta, sem digito
		$dadosboleto["conta_dv"] = "1"; 	// Digito do Num da conta
		
		// DADOS PERSONALIZADOS - ITAÚ
		$dadosboleto["carteira"] = "109";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157
		
		// SEUS DADOS
		$dadosboleto["identificacao"] = "Doors Centro de Idiomas Ltda - EPP";
		$dadosboleto["cpf_cnpj"] = "26.480.075/0001-00";
		$dadosboleto["endereco"] = "Rua Belo Horizonte, 809 - Centro";
		$dadosboleto["cidade_uf"] = "Londrina / PR";
		$dadosboleto["cedente"] = "Doors Centro de Idiomas Ltda - EPP";
		
		
		require ABSPATH.'/frameworks/boleto/include/funcoes_itau.php'; 
		require ABSPATH.'/frameworks/boleto/include/layout_itau.php';
					
		
		
		
		
		
    } 
	
	
	public function boletos() {
		
		
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$model = $this->load_model('financeiro/financeiro-model');
		$datas = $model->boletosInfo($this->Decrypta($parametros[0]));
		
		//var_dump($datas);
		
		$z = 0;
		foreach($datas as $data):
		
		$dias_de_prazo_para_pagamento = $data[prazo];
		$taxa_boleto = 0.00;
		$data_venc = formatDate($data[data_vencimento]);
		
		$valor_cobrado = money($data[valor]); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
		$valor_cobrado = str_replace(",", ".",$valor_cobrado);
		$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
		
		$dadosboleto[$z]["matricula"] = $data[matricula];
		$dadosboleto[$z]["parcela"] = $data[parcela];
		$dadosboleto[$z]["nosso_numero"] = str_pad($data[boleto_id], 8, "0", STR_PAD_LEFT);;  // Nosso numero - REGRA: Máximo de 8 caracteres!
		$dadosboleto[$z]["numero_documento"] = str_pad($data[boleto_id], 4, "0", STR_PAD_LEFT);;	// Num do pedido ou nosso numero
		$dadosboleto[$z]["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
		$dadosboleto[$z]["data_documento"] = formatDate($data[data_lancamento]); // Data de emissão do Boleto
		$dadosboleto[$z]["data_processamento"] = formatDate($data[data_lancamento]); // Data de processamento do boleto (opcional)
		$dadosboleto[$z]["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
		$multa = 'R$'.money(($data[valor]/100)*2).'';
		
		// DADOS DO SEU CLIENTE
		$dadosboleto[$z]["sacado"] = $data[nome].' - '.$data[cpf];
		$dadosboleto[$z]["endereco1"] = $data[endereco].', '.$data[numero].', '.$data[complemento];
		$dadosboleto[$z]["endereco2"] = $data[cidade]." - ".$data[estado]." - ".$data[cep];
		
		// INFORMACOES PARA O CLIENTE
		$dadosboleto[$z]["demonstrativo1"] = "Fatura da escola Door Centro de Idiomas";
		$dadosboleto[$z]["demonstrativo2"] = "Fatura referente a mensalidade";
		$dadosboleto[$z]["demonstrativo3"] = "";
		
		
		$dadosboleto[$z]["instrucoes1"] = 'APOS O VENCIMENTO COBRAR JUROS DE..........R$ 0,09 AO DIA<br>
		APOS O VENCIMENTO COBRAR MULTA DE..........'.money($data[valor_multa]).'<br>
		ATE '.formatDate($data[data_desconto]).' CONCEDER DESCONTO DE..........R$ '.money($data[valor_desconto]).'<br>
		QUALQUER DUVIDA, FAVOR LIGAR: (43) 3361-6177
		';
		
		/*$dadosboleto["instrucoes1"] = '- '.str_replace(PHP_EOL, '<br>', $data[observacoes]);
		$dadosboleto["instrucoes2"] = "- Receber até $data[prazo] dias após o vencimento<br> - Sr. Caixa, cobrar multa de R$".money($data[valor_multa])." após o vencimento";*/
		$dadosboleto[$z]["instrucoes2"] = "<br>Door Centro de Idiomas - Rua Belo Horizonte, 809 - Centro - Londrina / PR<br>CNPJ: 26.480.075/0001-00";
		
		// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
		$dadosboleto[$z]["quantidade"] = "";
		$dadosboleto[$z]["valor_unitario"] = "";
		$dadosboleto[$z]["aceite"] = "";		
		$dadosboleto[$z]["especie"] = "R$";
		$dadosboleto[$z]["especie_doc"] = "";
		
		
		// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
		
		
		// DADOS DA SUA CONTA - ITAÚ
		$dadosboleto[$z]["agencia"] = "0109"; // Num da agencia, sem digito
		$dadosboleto[$z]["conta"] = "85640";	// Num da conta, sem digito
		$dadosboleto[$z]["conta_dv"] = "1"; 	// Digito do Num da conta
		
		// DADOS PERSONALIZADOS - ITAÚ
		$dadosboleto[$z]["carteira"] = "109";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157
		
		// SEUS DADOS
		$dadosboleto[$z]["identificacao"] = "Doors Centro de Idiomas Ltda - EPP";
		$dadosboleto[$z]["cpf_cnpj"] = "26.480.075/0001-00";
		$dadosboleto[$z]["endereco"] = "Rua Belo Horizonte, 809 - Centro";
		$dadosboleto[$z]["cidade_uf"] = "Londrina / PR";
		$dadosboleto[$z]["cedente"] = "Doors Centro de Idiomas Ltda - EPP";
		
		
		$z++;
					
		endforeach;
		
		
		
		require ABSPATH.'/frameworks/boleto/include/funcoes_itau_2.php'; 
		require ABSPATH.'/frameworks/boleto/include/layout_itau_2.php';
		
		
    } 
	
	public function remessa(){
		
		
		
		$model = $this->load_model('financeiro/financeiro-model');
		$list = $model->getBoletoRemessa();
		
		if($_POST[consult]):
		
		echo count($list);
		
		die();
		
		endif;
		
		
		require ABSPATH.'/frameworks/cnab/autoload.php';
		
		$codigo_banco = Cnab\Banco::ITAU;
		$arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);
		$arquivo->configure(array(
			'data_geracao'  => new DateTime(),
			'data_gravacao' => new DateTime(), 
			'nome_fantasia' => '', // seu nome de empresa
			'razao_social'  => 'Doors Centro de Idiomas Ltda - Epp',  // sua razão social
			'cnpj'          => '26.480.075/0001-00', // seu cnpj completo
			'banco'         => $codigo_banco, //código do banco
			'logradouro'    => 'Rua Belo Horizonte',
			'numero'        => '809',
			'bairro'        => 'Centro', 
			'cidade'        => 'Londrina',
			'uf'            => 'PR',
			'cep'           => '86020-060',
			'agencia'       => '0109', 
			'conta'         => '85640', // número da conta
			'conta_dac'     => '1', // digito da conta
		));
		
		
		$data = array();
		
		foreach($list as $boleto):
		
			$arquivo->insertDetalhe(array(
				
			'codigo_ocorrencia' => 1, // 1 = Entrada de título, futuramente poderemos ter uma constante
			'nosso_numero'      => str_pad($boleto[boleto_id], 8, "0", STR_PAD_LEFT),
			'numero_documento'  => str_pad($boleto[boleto_id], 4, "0", STR_PAD_LEFT),
			'carteira'          => '109',
			'especie'           => Cnab\Especie::ITAU_DUPLICATA_DE_SERVICO, // Você pode consultar as especies Cnab\Especie
			'valor'             => $boleto[valor], // Valor do boleto
			'instrucao1'        => 2, // 1 = Protestar com (Prazo) dias, 2 = Devolver após (Prazo) dias, futuramente poderemos ter uma constante
			'instrucao2'        => 0, // preenchido com zeros
			'sacado_nome'       => $boleto[nome], // O Sacado é o cliente, preste atenção nos campos abaixo
			'sacado_tipo'       => 'cpf', //campo fixo, escreva 'cpf' (sim as letras cpf) se for pessoa fisica, cnpj se for pessoa juridica
			'sacado_cpf'        => $boleto[cpf],
			'sacado_logradouro' => $boleto[endereco],
			'sacado_bairro'     => $boleto[bairro],
			'sacado_cep'        => $boleto[cep], // sem hífem
			'sacado_cidade'     => $boleto[cidade],
			'sacado_uf'         => $boleto[estado],
			'data_vencimento'   => new DateTime($boleto[data_vencimento]),
			'data_cadastro'     => new DateTime($boleto[data_lancamento]),
			'juros_de_um_dia'     => $boleto[juros_dia], // Valor do juros de 1 dia'
    		'data_desconto'       => new DateTime($boleto[data_desconto]),
    		'valor_desconto'      => $boleto[valor_desconto], // Valor do desconto
    		'prazo'               => $boleto[prazo], // prazo de dias para o cliente pagar após o vencimento
    		'taxa_de_permanencia' => '0', //00 = Acata Comissão por Dia (recomendável), 51 Acata Condições de Cadastramento na CAIXA
    		'mensagem'            => str_replace(PHP_OEL, $boleto[observacoes]),
    		'data_multa'          => new DateTime($boleto[data_multa]), // data da multa
    		'valor_multa'         => $boleto[valor_multa], // valor da multa
				
			));
		
		$model->mark($boleto[boleto_id]);
		
		
		endforeach;
		

		$arquivo->save(FILES.'/remessa/remessa.txt');
		
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream;");
		header("Content-Length:".filesize(FILES.'/remessa/remessa.txt'));
		header("Content-disposition: attachment; filename=".'remessa.txt');
		header("Pragma: no-cache");
      	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
		header("Expires: 0");
		readfile(FILES.'/remessa/remessa.txt');
		flush();
		
		unlink(FILES.'/remessa/remessa.txt');
	
		
	}
	
	
	
} 