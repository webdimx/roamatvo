<?php

class ColaboradoresController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'colaboradores';
	public $controller = 'colaboradores';

    public function index() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		
		$this->title = 'Gerenciar Colaboradores';
		$this->menu = 'colaboradores';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/colaboradores/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function detalhes() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		
		$this->data = $model->getRegistry($parametros[0]);
		
		
		$this->title = 'Home';	
		$this->menu = 'colaboradores';	
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
	
      	$this->view[]  = ABSPATH . '/views/colaboradores/view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
		
		
    } 
	
	public function adicionar() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		$modelGrupo = $this->load_model('grupos/grupos-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Colaborador';		
		$this->menu = 'colaboradores';
		$this->form = 'colaboradores/_submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/colaboradores/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		$modelGrupo = $this->load_model('grupos/grupos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar Colaborador';		
		$this->menu = 'colaboradores';
		$this->form = 'colaboradores/_submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/colaboradores/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		$model->_submit();
		
		
    } 
	
	
	
	
} 