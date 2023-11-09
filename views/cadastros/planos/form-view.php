<?
if($this->action=='edit'):
$data = $this->data[0];
endif;
?>



<div class="widget-box  ui-sortable-handle page-box" id="cliente" style="opacity: 1;">
    <div class="widget-header widget-header-small">
        <h6 class="widget-title">Informações</h6>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
            <div class="content">
             
             
            
              <div class="row">
             
              <div class="col-lg-6 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Nome:</label><br>
                  <input type="text"  name="<?=$this->controller?>[nome]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[nome]?>">
                </p>
              </div>
				
			  <div class="col-lg-6 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Valor:</label><br>
                  <input type="text"  name="<?=$this->controller?>[valor]"  class="col-xs-12 col-sm-12 col-lg-12  money "  value="<?=money($data[valor])?>">
                </p>
              </div>
				
			  <div class="col-xs-12 ">
                <p>
					
					
                  <label class="control-label no-padding-right" for="form-field-1">Situação:</label><br>
					
				  
                  <label>
						<input name="<?=$this->controller?>[situacao]" type="radio" class="ace" value="1" <?=($data[situacao]==1||!$data[situacao]?'checked':'')?>  >
						<span class="lbl"> Ativo</span>
				  </label> 
				  <label>
						<input name="<?=$this->controller?>[situacao]" type="radio" class="ace" value="2" <?=($data[situacao]==2?'checked':'')?> >
						<span class="lbl"> Inativo</span>
				  </label> 
				 
                </p>
              </div>
              
			  <div class="col-xs-4 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Qtd de Dias:</label><br>
                  <input type="text"  name="<?=$this->controller?>[qtd_dias]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[qtd_dias]?>">
                </p>
              </div>
              
              <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Local de Uso:</label><br>
                  <select  name="<?=$this->controller?>[local_uso]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
				    <?
					 foreach($modelConfig->getOptions('local_de_uso', true) as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$data[local_uso]?'selected':'') ?> > <?=$option[local]?></option>
					<?
					 endforeach;  
					?>
				  </select>
                </p>
              </div>
              
               <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Fornecedor Indicado:</label><br>
                  <select  name="<?=$this->controller?>[fornecedor]"  class="col-xs-12 col-sm-12 col-lg-12">
					<option value="">Selecione</option>
				    <?
					 foreach($modelConfig->getOptions('fornecedores', true) as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$data[fornecedor]?'selected':'') ?> > <?=$option[nome]?></option>
					<?
					 endforeach;  
					?>
				  </select>
                </p>
              </div>
				  
				  
			  <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">CODIGOCMOVEL:</label><br>
                  <input type="text"  name="<?=$this->controller?>[codigocmovel]"  class="col-xs-12 col-sm-12 col-lg-12 "  value="<?=$data[codigocmovel]?>">
                </p>
              </div>	
              
              <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Descrição CodigoCMovel:</label><br>
                  <input type="text"  name="<?=$this->controller?>[descricao]"  class="col-xs-12 col-sm-12 col-lg-12 "  value="<?=$data[descricao]?>">
                </p>
              </div>
              <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">CODIGONMUNDO:</label><br>
                  <input type="text"  name="<?=$this->controller?>[codigonmundo]"  class="col-xs-12 col-sm-12 col-lg-12 " maxlength="3"  value="<?=$data[codigonmundo]?>">
                </p>
              </div>
              <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">CODIGONMUNDO01:</label><br>
                  <input type="text"  name="<?=$this->controller?>[codigonmundo01]"  class="col-xs-12 col-sm-12 col-lg-12 "  maxlength="2"   value="<?=$data[codigonmundo01]?>">
                </p>
              </div>
              <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Descrição NMUNDO:</label><br>
                  <input type="text"  name="<?=$this->controller?>[descricaonmundo]"  class="col-xs-12 col-sm-12 col-lg-12"  value="<?=$data[descricaonmundo]?>">
                </p>
              </div>
             
			  <div class="col-lg-12">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Observação:</label><br>
                  <input type="text"  name="<?=$this->controller?>[observacao]"  class="col-xs-12 col-sm-12 col-lg-12" maxlength="50" value="<?=$data[observacao]?>">
                </p>
              </div>
				  
				  
              
			
				
               
              <p>&nbsp;</p>
              <div class="col-xs-12">
                <?
                if($this->action):
                ?>
                <input type="hidden" name="<?=$this->controller?>[action]" value="<?=$this->action?>">
                <input type="hidden" name="<?=$this->controller?>[ID]" value="<?=$data[ID]?>">
                <input type="hidden" name="<?=$this->controller?>[add]" value="">
                <?
                endif;
                ?>
              </div>

            </div>
        </div>
		</div>
    </div>

</div>
       
<script>
	$(document).ready(function(){
		
		
		/////
		
		
		
		$('.tipo').change(function(){
			
			
			
			if($(this).val()!=1){
				
				$('.venc').html('Vencimento:')
				
			}
			
			else{
				
				$('.venc').html('Data do Primeiro Vencimento:')
				
				
			}
			
			
			if($(this).val()==2){
				
				$('.venc').html('Vencimento:')
				$('.ha').hide()
				$('.ha').find('select, input').val()
				$('.ha').find('select, input').removeClass('required')
				
			}
			else{
				
				$('.ha').show()
				$('.ha').find('select, input').val()
				//$('.ha').find('select, input').addClass('required')
				
			}
			
			
			
			
			
		})
		
		$('.fp').change(function(){
			
			
			if($(this).val()==2){
				
				$('.venc').html('Vencimento:')
				$('.pd').hide()
				$('.pd').find('select, input').val()
				$('.pd').find('select, input').removeClass('required')
			}
			else{
				
				$('.venc').html('Data do Primeiro Vencimento:')
				$('.pd').show()
				$('.pd').find('select, input').val()
				$('.pd').find('select, input').addClass('required')
				
			}
			
		})
		
		
		
	})
</script>
        