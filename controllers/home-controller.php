<?php
/**
 * home - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class HomeController extends MainController
{
	
	
	public $login_required = true;
	public $permission_required = '';
	public $controller = 'home';
	

	
    public function index() {
		
		$this->isLogged();
		$this->title = 'Dashboard';
		
		$model = $this->load_model('home/home-model');

		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/home/home-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } // index
	
	
	public function getCard(){
		
		$model = $this->load_model('home/home-model');
		require ABSPATH . '/views/home/cards/'.$_POST[card].'.php';
		
	}
	
} // class HomeController