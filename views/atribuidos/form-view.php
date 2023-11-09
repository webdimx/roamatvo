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
             
             
             <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Tipo de Fatura:</label><br>
                  
                      <select name="<?=$this->controller?>[tipo]" class="required col-xs-8 required tipo">
                       <option value="1" <?=($data[tipo]==1)?'selected':''?>>Mensalidade</option>
                       <option value="2" <?=($data[tipo]==2)?'selected':''?>>Multa hora aula</option>
                       <option value="3" <?=($data[tipo]==3)?'selected':''?>>Boleto único</option>
                       <option value="4" <?=($data[tipo]==4)?'selected':''?>>Material</option>
                       <option value="5" <?=($data[tipo]==5)?'selected':''?>>Matrícula</option>
                       
                     </select>
                  
                </p>
              </div>
              
              <div class="col-xs-12 ">
               <div class="col-xs-8 fix ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Aluno:</label><br>

					<select  name="<?=$this->controller?>[aluno_id]" class="chosen-select col-xs-8 required form-control" id="form-field-select-3" data-placeholder="Selecione um aluno">
					<option value="">  </option>
				   <?
				   $alunos = $modelAlunos->getList(true);
				   foreach($alunos[data] as $aluno):
				   ?>
				   <option value="<?=$aluno[ID]?>" <?=($data[aluno_id]==$aluno[ID])?'selected':''?>><?=$aluno[nome]?></option>	
				   <?
				   endforeach;
				   ?>
					</select>

                </p>
				  </div>
              </div>
              <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Valor:</label><br>
                  <input type="text"  name="<?=$this->controller?>[valor]"  class="col-xs-12 col-sm-12 col-lg-8  money required" value="<?=($data[valor]?money($data[valor]):'260,00')?>">
                </p>
              </div>
              
              <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Forma de pagamento:</label><br>
                  
                      <select name="<?=$this->controller?>[forma_pagamento]" class="required col-xs-8 required fp">
                       <option value="3" <?=($data[forma_pagamento]==3)?'selected':''?>>Boleto</option>
                       <option value="2" <?=($data[forma_pagamento]==2)?'selected':''?>>Pagamento na escola</option>
                     </select>
                  
                </p>
              </div>
              
              <?
			  if($this->action=='edit'):
			  ?>
              <div class="col-xs-12 ">
                  <label class="control-label no-padding-right" for="form-field-1"> Data Vencimento:</label><br>
                   <input class=" col-xs-12 col-sm-12 col-lg-8 date-picker required" data-date-format="dd/mm/yyyy" name="<?=$this->controller?>[data_vencimento]" type="text" value="<?=($data[data_vencimento]?formatDate($data[data_vencimento]):'')?>">
              </div>
              <?
			  else:
			  ?>
              <div class="col-xs-12 ">
                  <label class="control-label no-padding-right venc" for="form-field-1"> Data do Primeiro Vencimento:</label><br>
                   <input class=" col-xs-12 col-sm-12 col-lg-8 date-picker required" data-date-format="dd/mm/yyyy" name="<?=$this->controller?>[data_vencimento]" type="text" value="<?=($data[data_vencimento]?formatDate($data[data_vencimento]):'')?>">
              </div>
              <?
			  endif;	
			  ?>
            
            <div class="col-xs-12 " <?=($data[tipo]==2 || $data[forma_pagamento]==2 ?'style="display:none"':'')?>>
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Juros por mês:</label><br>
                  <input type="text"  name="<?=$this->controller?>[juros_dia]"  class="col-xs-12 col-sm-12 col-lg-8  money" value="<?=($data[juros_dia]?money($data[juros_dia]):'0,09')?>">
                </p>
              </div>
              
              <div class="col-xs-12 ha  "  <?=($data[tipo]==2 || $data[forma_pagamento]==2 ?'style="display:none"':'')?>>
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Data Limite para Desconto:</label><br>
                  <input type="text"  name="<?=$this->controller?>[data_desconto]"  class="col-xs-12 col-sm-12 col-lg-8  date-picker <?=($data[tipo]==2 || $data[forma_pagamento]==2 ?'':'')?>" data-date-format="dd/mm/yyyy" value="<?=($data[data_desconto]?formatDate($data[data_desconto]):'')?>">
                </p>
              </div>
              
              <div class="col-xs-12 ha "  <?=($data[tipo]==2 || $data[forma_pagamento]==2 ?'style="display:none"':'')?>>
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Valor do Desconto:</label><br>
                  <input type="text"  name="<?=$this->controller?>[valor_desconto]"  class="col-xs-12 col-sm-12 col-lg-8  money " value="<?=($data[valor_desconto]?money($data[valor_desconto]):'')?>">
                </p>
              </div>
              
              <div class="col-xs-12 pd" <?=($data[forma_pagamento]==2 ?'style="display:none"':'')?>>
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Prazo para pagamento após vencimento:</label><br>
                  <input type="text"  name="<?=$this->controller?>[prazo]"  class="col-xs-12 col-sm-12 col-lg-8   <?=($data[forma_pagamento]==2 ?'style=""':'required')?>"  value="<?=($data[prazo]?$data[prazo]:'60')?>">
                </p>
              </div>
              
              <div class="col-xs-12 pd" <?=($data[forma_pagamento]==2 ?'style="display:none"':'')?>>
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Data da Multa:</label><br>
                  <input type="text"  name="<?=$this->controller?>[data_multa]"  class="col-xs-12 col-sm-12 col-lg-8 date-picker " data-date-format="dd/mm/yyyy" value="<?=($data[data_multa]?formatDate($data[data_multa]):'')?>">
                </p>
              </div>
              
              <div class="col-xs-12  " <?=($data[forma_pagamento]==2 ?'style="display:none"':'')?>>
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Valor da Multa:</label><br>
                  <input type="text"  name="<?=$this->controller?>[valor_multa]"  class="col-xs-12 col-sm-12 col-lg-8  money " value="<?=($data[valor_multa]?money($data[valor_multa]):'5,20')?>">
                </p>
              </div>
              
              <div class="col-xs-12 ha <?=($data[forma_pagamento]==2 ?'style="display:none"':'')?> pd">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Negativar e Protestar:</label><br>
                  
                  
                  
                  <select name="<?=$this->controller?>[negativar_protestar]" class="<?=($data[forma_pagamento]==2 ?'':'required')?> col-xs-8">
                      
                       <option value="0" <?=($data[negativar_protestar]=='')?'selected':''?>>Não</option>
                       <option value="1" <?=($data[negativar_protestar]==1)?'selected':''?>>Sim</option>
                       
                  </select>
                  
                </p>
              </div>
             
             
              
              
              <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Observações:</label><br>
                  <textarea  name="<?=$this->controller?>[observacoes]"  class="col-xs-12 col-sm-12 col-lg-8  required"><?=($data[observacoes]?$data[observacoes]:'Atente-se para o desconto de pontualidade')?></textarea>
                </p>
              </div>
             
              <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Status:</label><br>
                  
                      <select name="<?=$this->controller?>[status]" class=" col-xs-8 required">
                       <option value="1" <?=($data[status]==1)?'selected':''?>>Pendente</option>
                       <option value="2" <?=($data[status]==2)?'selected':''?>>Pago</option>
                       <option value="4" <?=($data[status]==4)?'selected':''?>>Vencido</option>
                       <option value="3" <?=($data[status]==3)?'selected':''?>>Acordo</option>
                       
                     </select>
                  
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
        