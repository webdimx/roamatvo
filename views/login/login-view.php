<?php if ( ! defined('ABSPATH')) exit; ?>
<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="<?php echo HOME_URI;?>views/assets/css/reset.css">
	<link rel="stylesheet" href="<?php echo HOME_URI;?>views/assets/css/animate.css">
	<link rel="stylesheet" href="<?php echo HOME_URI;?>views/assets/css/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
    
	<div id="container">
		
		
        <?=($_GET[expired]==true?'<div class="advice">Sua sessão expirou, faça login novamente!</div>':'')?>
        
		
		<div class="logo-area">
        <img src="<?php echo HOME_URI;?>views/assets/images/login_logo.png" alt="Sistema de Gerenciamento" class="logo">
        </div>
		<form method="post">
		
		
		<input type="name" name="userdata[email]" placeholder="Login">
		
		
		
		
		<input type="password" name="userdata[user_password]" placeholder="Senha">
		
		<div id="lower">
		
		
		<?php
			if ( $this->login_error ) {
				echo '<div class="result error">' . $this->login_error . '</div>';
			}
			?>
		<input type="submit" value="Login">
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>
	
	
	
	
	
		
	