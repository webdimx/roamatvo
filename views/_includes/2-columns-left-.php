<!DOCTYPE html>
<html lang="en">
	<? require_once('head.php')?>

	<body class="no-skin">
    
    	<div class="loading-page">
        	<img src="<?=HOME_URI?>views/assets/images/wait.gif">
        </div>
		
        <? require_once('header.php')?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
            
            <? require_once('menu.php')?>
			<div class="main-content">
				<div class="main-content-inner">
                
					<div class="page-content">
                    
                    
                    <div class="page-header">
                    
                    <?
					$banners = $this->getBanners();
	
					if(($this->controller == 'video-aula') && $banners[banner]):	
					?>
                    <div class="banner">
                    
                    <?=($banners[link]?'<a href="'.$banners[link].'" target="_new">':'')?>
                    <img src="<?=HOME_URI?>views/_files/banner/<?=$banners[banner]?>">
                    <?=($banners[link]?'</a>':'')?>
                    </div>
                    <?
					endif;	
					?>
                    
					<h1><?=$this->title?></h1>
                    
                    
                    <div class="button-set">
					<? if($this->form):?>
                    	<button class="btn btn-success bl submit-form" type="submit">
                            <?=($this->action)?'<i class="ace-icon fa fa-pencil bigger-110"></i>  Salvar':'<i class="ace-icon fa fa-check bigger-110"></i> Cadastrar'?>
                        </button>
                    <? endif; ?>
                    <? if($this->action=='view' && (!$this->hideButton)):?>
                    	<a href="<?=HOME_URI.$this->controller.'/editar/'.$this->parametros[0]?>" class="btn btn-sm btn-info bl " type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i> Editar
                        </a>
                        <?
                       
						?>
                        <? if($this->controller=="alunos"):?>
                        <a href="#modal-email" class="btn btn-sm btn-success bl  sendMail" type="submit" data-id="<?=$this->parametros[0]?>" data-toggle="modal">
                            <i class="ace-icon fa fa-paper-plane bigger-110"></i> Enviar E-mail
                        </a>
                        
                        <a href="<?=HOME_URI.'financeiro/boletos/'.$this->Crypta($this->parametros[0])?>" target="_blank" class="btn btn-sm  bl  sendMail" type="submit" data-id="<?=$this->parametros[0]?>" data-toggle="modal">
                            <i class="ace-icon fa fa-clone bigger-110"></i> Gerar Faturas
                        </a>
                        <? endif;?>
                        
                    <? endif; ?>
                    <?
					if($this->actions):
					foreach($this->actions as $actions):
					?>
                    	<button class="btn btn-info action-button bl " data-action="<?=$actions[action]?>" data-refresh="<?=$actions[refresh]?>" data-url="<?=$actions[action_url]?>" data-id="<?=$actions[action_id]?>" title="<?=$actions[title]?>">
                            <i class="ace-icon fa <?=$actions[icon]?> bigger-110"></i>
                            <?=$actions[title]?>
                        </button>
                    <? 
					endforeach;
					endif; 
					?>
                    </div>
					</div>
                    
                    
                    <!-- /.page-header -->
                    
                    <div class="row">
						<div class="col-xs-12">
                        
                        <!-- sidebar -->
                        
                        <div class="invisible">
                         
                         <div id="sidebar2" class="sidebar                          responsive-min     ace-save-state" >
                              <ul class="nav nav-list">
                              	
                                <?
                                foreach($this->sidebar as $sidebar):
								?>
                                  <li class="item_<?=$sidebar[id]?> <?=(($parametros[0]) && $sidebar[id]==$parametros[0]?'active':'')?>">
                                      <a href="<?=($sidebar[link]?'':'#')?><?=$sidebar[anchor]?>" data-link="<?=$sidebar[link]?>">
                                          <i class="menu-icon fa <?=($sidebar[icon])?$sidebar[icon]:'fa-info-circle'?>"></i>
                                          <span class="menu-text"><?=$sidebar[title]?></span>
                                      </a>
                                   </li>
                                <?
                                endforeach;
								?>
                              </ul>
                              
                              

				<div class="sidebar-toggle sidebar-expand" id="sidebar-expand">
					<i class="ace-icon fa fa-angle-double-right" data-icon1="ace-icon fa fa-angle-double-right" data-icon2="ace-icon fa fa-angle-double-left"></i>
				</div>

                              
                          </div>
                          </div>
                        <!-- .sidebar -->
                        
                        <!-- alert -->
                        
                        <div class="alert"></div>
                        
                        <!-- .alert -->
                        
						<?
						echo ($this->form)?'<form id="form" class="form-horizontal" role="form" action="'.HOME_URI.$this->form.'">':'';
				
						foreach($this->view as $render):
                        require($render);
						endforeach;
						
						echo ($this->form)?'</form>':''
                        ?>
                    	</div>
                    </div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
            
            
            <script>
			$(document).ready(function(){
				
            $('.page-box').hide()
			$('.page-box').eq(0).show()
			
			$('#sidebar2 .nav-list a').click(function(a){
				
				if(!$(this).data('link')){
				a.preventDefault()
				$('.page-box').hide()
				$($(this).attr('href')).fadeIn(200)
				}
				
				
			})	
			})
            </script>
            

	<? require_once('footer.php')?>
    
    <div id="modal-form" class="modal" tabindex="-1">
									<div class="modal-dialog">
                                    
                                    	<form id="new-attribute" action="#">
                                        
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">×</button>
												<h4 class="blue ">Selecione os produtos</h4>
											</div>

											<div class="modal-body">
												<div class="row">
                                                	
                                                  <div class="col-lg-12">
                                                  	
													<?
													$data = $modelProduct->getList();
                                                    foreach($data[data] as $_product):
													?>
                                                    <div class="col-lg-6">
													<label>
														<input name="product_id[]" value="<?=$_product[ID]?>" type="checkbox" class="ace">
														<span class="lbl"> <?=$_product[nome]?> </span>
													</label>
													</div>
                                                    
													<?
													endforeach;
													?>
                                                    </div>
												</div>
											</div>

											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</button>

												<button class="btn btn-sm btn-primary"  >
													<i class="ace-icon fa fa-check"></i>
													Adicionar Produto
												</button>
											</div>
										</div>
                                        
                                        </form>
									</div>
								</div>
                                
                                
                                <div id="modal-condominios" class="modal" tabindex="-1" style="">
									<div class="modal-dialog">
                                    
                                    	<form id="getProductsCondominium" action="#">
                                        
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">×</button>
												<h4 class="blue ">Resultado da pesquisa</h4>
											</div>

											<div class="modal-body">
												
											</div>

											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</button>

												<button class="btn btn-sm btn-primary"  >
													<i class="ace-icon fa fa-check"></i>
													Adicionar Produto
												</button>
											</div>
										</div>
                                        
                                        </form>
									</div>
								</div>
	</body>
</html>
