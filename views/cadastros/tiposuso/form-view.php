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
             
              <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Codigo:</label><br>
                  <input type="text"  name="<?=$this->controller?>[codigo]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[codigo]?>">
                </p>
              </div>
				  
			  <div class="col-lg-4">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Tipo:</label><br>
                  <input type="text"  name="<?=$this->controller?>[tipo]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[tipo]?>" maxlength="30">
                </p>
              </div>
				  
			  <div class="col-lg-4 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Apelido:</label><br>
                  <input type="text"  name="<?=$this->controller?>[apelido]"  class="col-xs-12 col-sm-12 col-lg-12 required"  value="<?=$data[apelido]?>" maxlength="20">
                </p>
              </div>
				  
			  <div class="col-lg-12">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Destino MDN na Data Off:</label><br>
                 
					<label>
						<input name="<?=$this->controller?>[destino_mdn]" type="radio" class="ace" value="1" <?=($data[destino_mdn]==1 || !$data[destino_mdn]?'checked':'')?>  >
						<span class="lbl"> Volta para estoque</span>
				  </label> 
				  <label>
						<input name="<?=$this->controller?>[destino_mdn]" type="radio" class="ace" value="2" <?=($data[destino_mdn]==2?'checked':'')?> >
						<span class="lbl"> Vai para Excluído</span>
				  </label> 
					
                </p>
              </div>
				  
			 <div class="col-lg-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Destino SIMCARD na Data Off:</label><br>
                  
					<label>
						<input name="<?=$this->controller?>[destino_simcard]" type="radio" class="ace" value="1" <?=($data[destino_simcard]==1 || !$data[destino_simcard]?'checked':'')?>  >
						<span class="lbl"> Volta para estoque</span>
				  </label> 
				  <label>
						<input name="<?=$this->controller?>[destino_simcard]" type="radio" class="ace" value="2" <?=($data[destino_simcard]==2?'checked':'')?> >
						<span class="lbl"> Vai para Excluído</span>
				  </label> 
                </p>
              </div>
				  
			  <div class="col-lg-12">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1">Associação:</label><br>
                  
					<label>
						<input name="<?=$this->controller?>[associacao]" type="radio" class="ace" value="1" <?=($data[associacao]==1 || !$data[associacao]?'checked':'')?>  >
						<span class="lbl"> Mesmo Fornecedor</span>
				  </label> 
				  <label>
						<input name="<?=$this->controller?>[associacao]" type="radio" class="ace" value="2" <?=($data[associacao]==2?'checked':'')?> >
						<span class="lbl"> Fornecedor diferente</span>
				  </label> 
					
                </p>
              </div>
				  
			  <div class="col-lg-12">
                <p>
				  <label class="control-label no-padding-right" for="form-field-1">Descrição:</label><br>
                  <textarea  name="<?=$this->controller?>[descricao]"  class="col-xs-12 col-sm-12 col-lg-12 required" maxlength="50" style="height:60px"><?=$data[descricao]?></textarea>
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
      