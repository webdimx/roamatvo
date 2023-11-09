<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


/**
 * MainController - Todos os controllers deverão estender essa classe
 *
 * @package TutsupMVC
 * @since 0.1
 */
class EmailModel
{



	public function __construct () {



		$this->email = 'fatura@swapskillsim.com.br';
		$this->server = 'mail.swapskillsim.com.br';
		$this->password = 'Zgzr19yh@';
		$this->port = '587';


		require ABSPATH.'/classes/PHPMailer.php';
		require ABSPATH.'/classes/POP3.php';
		require ABSPATH.'/classes/SMTP.php';
		require ABSPATH.'/classes/Exception.php';

	}



	public function _sendEmail($email_vars, $subject, $email, $attachment, $add){


		$mail = new PHPMailer();

		$template = $email_vars['template'] ? $email_vars['template'] : ABSPATH.'/views/email/default.html';
		$body = file_get_contents($template);

		if(isset($email_vars)){

    	foreach(array_merge($email_vars) as $k=>$v){

        $body = str_replace('{'.$k.'}', $v, $body);

    	}
		}

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $this->server;  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;
		$mail->CharSet = 'UTF-8';
		$mail->Username = $email_vars['login'] ? $email_vars['login'] : $this->email;                 // SMTP username
		$mail->Password = $email_vars['password'] ? $email_vars['password'] :  $this->password;                           // SMTP password
		$mail->Port = $email_vars['port'] ? $email_vars['port'] : $this->port;                                    // TCP port to connect to
		$mail->setFrom($email_vars['login'] ? $email_vars['login'] : $this->email);
		$mail->addAddress($email);     // Add a recipient
		$mail->addAddress($this->email);
		$mail->addAddress($add ? $add :'fatura@skillsim.com');
		$mail->isHTML(true);

		if($attachment):                               // Set email format to HTML
		$mail->AddAttachment($attachment);
		endif;
		$mail->Subject = $subject;
		$mail->Body  = stripslashes($body);
		$mail->protocol = "mail";

		if($mail->send()) {

			return 'success';

		} else {

			return 'error '.$mail->ErrorInfo;

	    }

	}



} // class MainController
