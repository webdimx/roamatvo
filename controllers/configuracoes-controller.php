<?php

class ConfiguracoesController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'configuracoes';
	public $controller = 'configuracoes';

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
	
	
	public function logs() {
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->title = 'Log de Açoes';
		$this->menu = 'configuracoes';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/configuracoes/log-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    }
	
	
	public function alertas() {
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->title = 'Alertas';
		$this->menu = 'configuracoes';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/configuracoes/alertas-view.php';
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
		$this->form = 'usuarios/_submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/usuarios/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('usuarios/usuarios-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar Usuário';		
		$this->menu = 'usuarios';
		$this->form = 'usuarios/_submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
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
	
	
	function delRegistry(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		echo $model->del($_POST[ids], $_POST[table]);
		
	}
	
	public function categorias(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->sidebar = (object) array(
		array('anchor' => 'colaboradores', 'icon' => 'fa-user-circle-o', 'title' => 'Colaboradores'),
		);
		
	
      	$this->view  = ABSPATH . '/views/colaboradores/categorias-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
	}
	
	public function pautas(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
	
      	$this->view  = ABSPATH . '/views/configuracoes/pautas-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
	}
	
	public function addCategory(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_addCategory();
		
	}
	
	public function addSubject(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_addSubject();
		
	}
	
	public function salas(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->sidebar = (object) array(
		array('anchor' => 'Informações', 'icon' => '', 'title' => 'Informaçoes'),
		);
		
	
      	$this->view  = ABSPATH . '/views/configuracoes/salas-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
	}
	
	public function addRoom(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_addRoom();
		
	}
	
	
	public function modalidades(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->sidebar = (object) array(
		array('anchor' => 'Informações', 'icon' => '', 'title' => 'Informaçoes'),
		);
		
	
      	$this->view  = ABSPATH . '/views/configuracoes/modalidades-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
	}
	
	public function addModalidade(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_addModalidade();
		
	}
	
	public function niveis(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->sidebar = (object) array(
		array('anchor' => 'Informações', 'icon' => '', 'title' => 'Informaçoes'),
		);
		
	
      	$this->view  = ABSPATH . '/views/configuracoes/niveis-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
	}
	
	public function addNivel(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_addNivel();
		
	}
	
	
	public function camposPersonalizados(){
		
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Campos Personalizados';		
		$this->menu = 'configuracoes';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'alunos', 'icon' => 'fa-graduation-cap', 'title' => 'Alunos'),
		array('anchor' => 'colaboradores', 'icon' => 'fa-users', 'title' => 'Colaboradores'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/alunos/custom-fields-view.php';
		$this->view[]  = ABSPATH . '/views/colaboradores/custom-fields-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
		
		
	}
	
	public function addCampo(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_addCustomFields();
		
	}
	
	public function fastEdit(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_fastEdit();
		
	}
	
	
	public function fastDelete(){
		
		$model = $this->load_model('configuracoes/configuracoes-model');
		$model->_fastDelete();
		
	}
} 