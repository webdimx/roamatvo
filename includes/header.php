<?php if ( ! defined('ABSPATH')) exit; ?>
<? $user = $this->getUserInfo(); var_dump($user);?>
<script>
ajaxUrl = '<?=HOME_URI?>'
controllerUrl = '<?=HOME_URI.$this->controller?>/'
ignoreRequired=<?=($this->ignoreRequired)?"true":"''"?>;
</script>

<?
?>
<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="<?php echo HOME_URI;?>" class="navbar-brand">
						<small>
							<img src="<?php echo HOME_URI;?>views/assets/images/small_logo.png" alt="Sistema de Gerenciamento">
						</small>
					</a>
</div>

<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
<ul class="nav ace-nav">

<li class="light-blue dropdown-modal ">
  <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
      <span class="user-info">
          <small>Bem vindo</small>
          <?=($user[nome]?$user[nome]:'Administrador')?>
      </span>

      <i class="ace-icon fa fa-caret-down"></i>
  </a>

  <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
      

      <?
    if($_SESSION[userdata][type]):
    ?>
    <li>
        <a href="<?php echo HOME_URI;?>usuarios/editar/">
            <i class="ace-icon fa fa-user"></i>
            Editar Perfil
        </a>
    </li>
    <?
    endif;
    ?>
    <li>
        <a href="<?php echo HOME_URI;?>logout">
            <i class="ace-icon fa fa-power-off"></i>
            Sair
        </a>
    </li>
  </ul>
</li>
</ul>
</div>

<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
  <ul class="nav navbar-nav">
      <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?=($_SESSION['userdata']['type']==2?'Área do aluno':'Sistema de Gerenciamento')?>
&nbsp;
              
          </a>

          
      </li>

      
  </ul>
 
</nav>
</div>
</div>
