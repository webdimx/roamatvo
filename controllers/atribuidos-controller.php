<?php

class AtribuidosController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'atribuidos';
	public $controller = 'atribuidos';

    public function index() {
		
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$model = $this->load_model('atribuidos/atribuidos-model');
		
		$this->title = 'Gerenciar Atribuidos';
		$this->menu = 'atribuidos';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/atribuidos/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function historico() {
		
		$this->subController = 'historico';
		
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$model = $this->load_model('atribuidos/atribuidos-model');
		
		$this->title = 'Histórico de Atribuidos';
		$this->menu = 'atribuidos';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/atribuidos/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function export(){
		
		
		$dataXLS = array();
		array_push($dataXLS, array('SIMCARD', 'MDN', 'Status MDN', 'Status SIMCARD', 'Local de Estoque', 'Ativado em', 'Plano', 'Dias', 'Data Off', 'Valor', 'Local Venda', 'Atendente', 'Observação'));
		
		
		$model = $this->load_model('atribuidos/atribuidos-model');
		$data = $model->getListImport();
		
		foreach($data as $r):
		
			array_push($dataXLS, $r);
		
		endforeach;
		
		
		
		
		include(FRAMEWORKS.'/xls/xlsxwriter.class.php');
		
		
		
		$writer = new XLSXWriter();
		$writer->writeSheet($dataXLS);
		$writer->writeToFile(FILES.'/output.xlsx');
		
		//exit(0);
		
		echo HOME_URI.'/views/_files/output.xlsx';
		
		
	}
	
	
	public function adicionar() {
		
		$model = $this->load_model('atribuidos/atribuidos-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Fatura';		
		$this->menu = 'atribuidos';
		$this->form = 'atribuidos/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/atribuidos/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('atribuidos/atribuidos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar fatura';		
		$this->menu = 'atribuidos';
		$this->form = 'atribuidos/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/atribuidos/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('atribuidos/atribuidos-model');
		$model->_submit();
		
		
    } 
	
	function delRegistry(){
		
		$model = $this->load_model('atribuidos/atribuidos-model');
		echo $model->del($_POST[ids]);
		
	}
	
	
	
	
	
} 