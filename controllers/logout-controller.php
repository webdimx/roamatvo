<?php
/**
 * UserRegisterController - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class LogoutController extends MainController
{

	
	
    public function index() {
		
			$this->logout();
			$this->goto_login();

	} 
	
} 