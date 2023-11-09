<?php
/**
 * LoginController - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class LoginController extends MainController
{

	/**
	 * Carrega a página "/views/login/index.php"
	 */
    public function index() {
		
		if ($this->logged_in ){
		
		echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '">';
		echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '";</script>';
		
		return;
	
        }
		
		// Título da página
		$this->title = 'Login';
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		// Login não tem Model
		
		/** Carrega os arquivos do view **/
		
		// /views/_includes/header.php
        //require ABSPATH . '/views/_includes/header.php';
		
		// /views/_includes/menu.php
        //require ABSPATH . '/views/_includes/menu.php';
		
		// /views/home/login-view.php
        require ABSPATH . '/views/login/login-view.php';
		
		// /views/_includes/footer.php
        //require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
} // class LoginController