<?php
/**
 * UserRegisterController - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class EmailsController extends MainController
{

	
	public $login_required = true;
	public $permission_required = 'configuracoes';
	public $controller = 'emails';
	
	
	public function index() {
		
		
		$this->title = 'E-mails';
		$this->menu = 'sistema';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		
		$model = $this->load_model('emails/emails-model');
		
			
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		
		$this->view  = ABSPATH . '/views/emails/emails-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
		
		
	}
	
	
	public function novoEmail(){
		
		
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}
		
		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
			echo 'Você não tem permissões para acessar essa página.';
			return;
		}
		
		$model = $this->load_model('emails/emails-model');
		echo $model->insert();
		
	}
	
	public function novo(){
		
		
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}
		
		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
			echo 'Você não tem permissões para acessar essa página.';
			return;
		}
		
		$this->title = 'Adicionar Template';
		$this->menu = 'configuracoes';
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
		$this->form = 'emails/novo_email/';
		
	
		
		$this->view[]  = ABSPATH . '/views/emails/emails-form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
		
		
	}


	public function editar(){
		
		
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}
		
		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
			echo 'Você não tem permissões para acessar essa página.';
			return;
		}
		
		$parameters = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		
		$model = $this->load_model('emails/emails-model');
		
		$this->title = 'Editar Template';
		$this->menu = 'configuracoes';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parameters[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
		$this->form = 'emails/novo_email/';
		
	
		
		$this->view[]  = ABSPATH . '/views/emails/emails-form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
		
		
	}
	
	
	function delRegistry(){
		
		$model = $this->load_model('emails/emails-model');
		echo $model->del($_POST[ids], $_POST[table]);
		
	}

	
	
	
	
	
	
	
} // class home