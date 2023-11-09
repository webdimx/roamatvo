<?
if($this->action=='edit'):
$data = $this->data[0];
endif;


?>

<div class="widget-box  ui-sortable-handle page-box" id="cliente" style="opacity: 1;">
    <div class="widget-header widget-header-small">
        <h6 class="widget-title">Informações Gerais</h6>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
            <div class="content">
              
              
              <div class="col-lg-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Nome:</label><br>
                  <input type="text"  name="<?=$this->controller?>[nome]"  class="col-xs-12 col-sm-12 col-lg-12  required" value="<?=$data[nome]?>">
                </p>
              </div>
              
              
              <div class="col-lg-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Senha:</label><br>
                  <input type="password" name="<?=$this->controller?>[senha]"  class="col-xs-12 col-sm-12 col-lg-12  <?=($this->action=='edit'?'':'required')?>" value="" id="cidade">
                </p>
              </div>
				
			 <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Grupo de acesso:</label><br>
                  <select name="<?=$this->controller?>[grupo]" class=" col-xs-12 required">
                       <option value="">Selecione</option>
                       <?
					   $groups = $modelGrupo->getList();
                       foreach($groups[data] as $group):
					   ?>
                       <option value="<?=$group[ID]?>" <?=($data[grupo]==$group[ID])?'selected':''?>><?=$group[nome]?></option>	
                       <?
                       endforeach;
					   ?>
                     </select>
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
				  <label>
						<input name="<?=$this->controller?>[situacao]" type="radio" class="ace" value="3" <?=($data[situacao]==3?'checked':'')?> >
						<span class="lbl"> Excluido</span>
				  </label>
				 
                </p>
              </div>
				
				<div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> E-mail:</label><br>
                  <input type="text" name="<?=$this->controller?>[email]"  class="col-xs-12 col-sm-12 col-lg-12  required" value="<?=$data[email]?>" id="cidade">
                </p>
              </div>
              
				
				<div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Celular:</label><br>
                  <input type="text"  name="<?=$this->controller?>[celular]"  class="col-xs-12 col-sm-12 col-lg-12 celular  " value="<?=$data[celular]?>" id="cidade">
                </p>
              </div>
				
				<div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Observação:</label><br>
                  <input type="text"  name="<?=$this->controller?>[observacao]"  class="col-xs-12 col-sm-12 col-lg-12" value="<?=$data[observacao]?>" id="cidade">
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
        