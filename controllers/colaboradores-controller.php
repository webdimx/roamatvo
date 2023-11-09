<?php

class ColaboradoresController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'colaboradores';
	public $controller = 'colaboradores';

    public function index() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		
		$this->title = 'Gerenciar Usuários';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/colaboradores/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	
	public function adicionar() {
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		$modelGrupo = $this->load_model('grupos/grupos-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Usuário';		
		$this->menu = 'cadastros';
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
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar Usuário';		
		$this->menu = 'cadastros';
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
	
	function delRegistry(){
		
		$model = $this->load_model('colaboradores/colaboradores-model');
		echo $model->del($_POST[ids]);
		
	}
	
	
	
	
} 