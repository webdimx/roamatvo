<?php

//equire 'PHPMailerAutoload.php';


/**
 * MainController - Todos os controllers deverão estender essa classe
 *
 * @package TutsupMVC
 * @since 0.1
 */
class Mail 
{

	
	public $email;
	public $server;
	public $password;
	public $port;
	
	
	
	
	public function __construct ( $parametros = array() ) {
	
		$this->email = 'contato@webdim.com.br';
		$this->server = 'mail.webdim.com.br';
		$this->password = 'wdsil2';
		$this->port = '587';
		
		

		
	} 
	

	/*public function sendEmail($subject, $email, $template){
		
		
		
	}*/
	
	
	
} // class MainController