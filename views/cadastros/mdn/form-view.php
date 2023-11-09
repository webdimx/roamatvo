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
             
              <div class="col-lg-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">MDN:</label><br>
                  <input type="text"  name="<?=$this->controller?>[mdn]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[mdn]?>">
                </p>
              </div>
				  
			 
				  
				  
			<div class="col-lg-12 ">
               <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Fornecedor:</label><br>
                  <select  name="<?=$this->controller?>[fornecedor_mdn]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('fornecedores', true) as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$data[fornecedor]?'selected':'')?>> <?=$option[nome]?></option>
					<?
					 endforeach;  
					?>
				  </select>                 
               </p>
              </div>
				  
			  <div class="col-lg-12">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Status MDN:</label><br>
                  <select  name="<?=$this->controller?>[status_mdn]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('status_mdn') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$data[status]?'selected':'')?>><?=$option[status]?></option>
					<?
					 endforeach;  
					?>
				  </select>                 
               </p>
              </div>
				  
			
				  
			  <div class="col-lg-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Código de Uso MDN:</label><br>
                  <select  name="<?=$this->controller?>[tipo_uso]"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('tipo_de_uso') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$data[tipo_uso]?'selected':'')?>> <?=$option[codigo]?> - <?=$option[apelido]?></option>
					<?
					 endforeach;  
					?>
				  </select>                 
               </p>
              </div>
				  
			  <div class="col-lg-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Lote:</label><br>
                  <input type="text"  name="<?=$this->controller?>[lote]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[lote]?>">
                </p>
              </div>
			
			  
				  
				 <div class="col-lg-12 col-xs-12">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Observações:</label><br>
                  <textarea  name="<?=$this->controller?>[observacoes]"  class="col-xs-12 col-sm-12 col-lg-12 "  style="height:60px"><?=$data[observacoes]?></textarea>
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
      