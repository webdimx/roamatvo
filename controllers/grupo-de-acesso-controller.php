<?php

class GrupoDeAcessoController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'configuracoes';
	public $controller = 'grupo-de-acesso';

    public function index() {
		
		$model = $this->load_model('grupos/grupos-model');
		
		$this->title = 'Gerenciar Grupos de acesso';
		$this->menu = 'configuracoes';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/grupo/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	public function adicionar() {
		
		$model = $this->load_model('grupos/grupos-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Grupo de acesso';		
		$this->menu = 'configuracoes';
		$this->form = 'grupo-de-acesso/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		array('anchor' => 'permissoes', 'icon' => 'fa-window-close-o', 'title' => 'Permissões'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/grupo/form-view.php';
		$this->view[]  = ABSPATH . '/views/grupo/role-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('grupos/grupos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar Colaborador';		
		$this->menu = 'configuracoes';
		$this->form = 'grupo-de-acesso/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		array('anchor' => 'permissoes', 'icon' => 'fa-window-close-o', 'title' => 'Permissões'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/grupo/form-view.php';
		$this->view[]  = ABSPATH . '/views/grupo/role-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('grupos/grupos-model');
		$model->_submit();
		
		
    } 
	
	
	function delRegistry(){
		
		$model = $this->load_model('grupos/grupos-model');
		echo $model->del($_POST[ids]);
		
	}
	
	
	
	
} 