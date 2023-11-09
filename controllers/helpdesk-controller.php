<?php

class HelpDeskController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'helpdesk';
	public $controller = 'helpdesk';

    public function index() {
		
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		
		$this->title = 'Help Desk';
		$this->menu = 'faturas';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/helpdesk/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function adicionar() {
		
		$model = $this->load_model('helpdesk/helpdesk-model');
		$modelAlunos = $this->load_model('alunos/alunos-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Fatura';		
		$this->menu = 'helpdesk';
		$this->form = 'helpdesk/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/helpdesk/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('helpdesk/helpdesk-model');
		$modelAlunos = $this->load_model('alunos/alunos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar fatura';		
		$this->menu = 'helpdesk';
		$this->form = 'helpdesk/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/helpdesk/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('helpdesk/helpdesk-model');
		$model->_submit();
		
		
    } 
	
	function delRegistry(){
		
		$model = $this->load_model('helpdesk/helpdesk-model');
		echo $model->del($_POST[ids]);
		
	}
	
	
	
	
	
} 