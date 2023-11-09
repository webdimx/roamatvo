<?php

class ReembolsoController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'helpdesk';
	public $controller = 'helpdesk';

    public function index() {
		
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		
		$this->title = 'Reembolso';
		$this->menu = 'faturas';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/reembolso/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	
	
	
	
	
} 