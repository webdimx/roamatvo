<!DOCTYPE html>
<html lang="en">
	<? require_once('head.php')?>

	<body class="no-skin col1">
    
    	<?
		if(LOADER):
		?>
    	<div class="loading-page">
        	<img src="<?=HOME_URI?>views/assets/images/wait.gif">
        </div>
		<?
		endif;
		?>
		<? require_once('header.php')?>
		<? require_once('menu.php')?>
        

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
            
            
			<div class="main-content">
				<div class="main-content-inner">
                
                     
					<div class="page-content">
                    <div class="page-header">
							<h1><?=$this->title?> </h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							  <?
                              require($this->view);
                              ?>
                    		</div>
                         </div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

	<? require_once('footer.php')?>
	</body>
</html>
