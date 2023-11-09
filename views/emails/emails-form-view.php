<?
if($this->action=='edit'):
$data = $this->data[0];
endif;


?>

            
                 
                    				<div class="col-xs-12">
                                      <p>
										<label class="control-label no-padding-right" for="form-field-1"> Nome:</label><br>
										<input type="text" id="nome" name="emails[nome]"  class="col-xs-8  required" value="<?=$data[nome]?>">
									  </p>
                                    </div>
                                    <div class="col-xs-12">
                                      <p>
										<label class="control-label no-padding-right" for="form-field-1"> Assunto:</label><br>
										<input type="text" id="nome" name="emails[assunto]"  class="col-xs-8  required" value="<?=$data[assunto]?>">
									  </p>
                                    </div>
                                    
                                    
                                   
                                   <div class="col-xs-8">	
                                               		
                                               		<label class="control-label no-padding-right" for="form-field-1"> Mensagem:</label><br>
                                                	<div id="summernote" class="mensagem" data-real="mensagem" data-controller="emails"><?=$data[mensagem]?></div>
													<!--<textarea name="emails[orcamento]" data-provide="markdown" data-iconlibrary="fa" rows="10"><?=$data[orcamento]?></textarea>-->
                                        </div>
                                    
									<div class="col-xs-12">
                                      	<label class="pos-rel"><input  name="emails[onlyImage]" type="checkbox" <?=($data[onlyImage]?'checked':'')?> class="ace item_id" value="1"><span class="lbl"> Somente imagem</span></label>
                                    </div>

                                   
                                   
                                   
                                    
                                    
                                    <div class="col-xs-12">
                                    		<?
											if($this->action):
											?>
											<input type="hidden" name="emails[action]" value="<?=$this->action?>">
											<input type="hidden" name="emails[ID]" value="<?=$data[ID]?>">
											<?
											endif;
											?>
                                            
                                      
                                    </div>
                                    
                              
                        
                    
                
            
            <script>
           

	
	
            
            </script>
            
            
        