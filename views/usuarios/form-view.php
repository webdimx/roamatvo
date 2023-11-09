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
              <?
              if($_SESSION[userdata][type]==1):
			  ?>
              
               <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Nome:</label><br>
                  <input type="text" id="nome" name="<?=$this->controller?>[nome]"  class="col-xs-12 col-sm-12 col-lg-8  required" value="<?=$data[name]?>">
                </p>
              </div>
              
             
              <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Grupo de acesso:</label><br>
                  <select name="<?=$this->controller?>[grupo]" class=" col-xs-8 required" readonly>
                    <option value="">Selecione</option>
                    <option selected value="1">Administrador</option>
                    
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
                  <label class="control-label no-padding-right" for="form-field-1"> Email:</label><br>
                  <input type="text" id="nome" name="<?=$this->controller?>[email]"  class="col-xs-12 col-sm-12 col-lg-8  required" value="<?=$data[email]?>">
                </p>
              </div>
              <?
              endif;
			  ?>
              
              
              <div class="col-xs-12 ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Senha:</label><br>
                  <input type="password" id="nome" name="<?=$this->controller?>[senha]"  class="col-xs-12 col-sm-12 col-lg-8 " value="">
                </p>
              </div>
               
              <p>&nbsp;</p>
              <div class="col-xs-12">
                <?
                if($this->action):
                ?>
                <input type="hidden" name="<?=$this->controller?>[action]" value="<?=$this->action?>">
                <input type="hidden" name="<?=$this->controller?>[ID]" value="<?=$data[user_id]?>">
                <input type="hidden" name="<?=$this->controller?>[add]" value="">
                <?
                endif;
                ?>
              </div>

            </div>
        </div>
    </div>

</div>
        