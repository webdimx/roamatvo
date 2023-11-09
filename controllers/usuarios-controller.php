<?php

class UsuariosController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'usuarios';
	public $controller = 'usuarios';

    public function index() {
		
		$model = $this->load_model('usuarios/usuarios-model');
		
		$this->title = 'Gerenciar usuários';
		$this->menu = 'usuarios';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/usuarios/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function detalhes() {
		
		$model = $this->load_model('usuarios/usuarios-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		
		$this->data = $model->getRegistry($parametros[0]);
		
		
		$this->title = 'Home';		
		$this->menu = 'usuarios';
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
	
      	$this->view[]  = ABSPATH . '/views/usuarios/view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
		
		
    } 
	
	public function adicionar() {
		
		$model = $this->load_model('usuarios/usuarios-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Usuário';		
		$this->menu = 'usuarios';
		$this->form = 'usuarios/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/usuarios/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('usuarios/usuarios-model');
		$modelGrupo = $this->load_model('grupos/grupos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar Perfil';		
		$this->menu = 'usuarios';
		$this->form = 'usuarios/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($_SESSION[userdata][user_id]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/usuarios/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('usuarios/usuarios-model');
		$model->_submit();
		
		
    } 
	
} 