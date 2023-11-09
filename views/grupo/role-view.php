<?
$roles = unserialize($data[permissoes]);
?>


        
        <div class="widget-box  ui-sortable-handle page-box" id="permissoes" style="opacity: 1;">
            <div class="widget-header widget-header-small">
                <h6 class="widget-title">Permissões</h6>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;"><div class="scroll-track scroll-active" ><div class="scroll-bar" ></div></div><div class="scroll-content" >
                    <div class="content">
                    
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'transacoes', true)?> class="ace item_id" value="transacoes"><span class="lbl"></span></label>
                      Transações
                      </p>
                    </div>
                    
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'swap', true)?> class="ace item_id" value="swap"><span class="lbl"></span></label>
                      Swap
                      </p>
                    </div>
                    
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'atribuidos', true)?> class="ace item_id" value="atribuidos"><span class="lbl"></span></label>
                     Atribuidos
                      </p>
                    </div>
                    
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'helpdesk', true)?> class="ace item_id" value="helpdesk"><span class="lbl"></span></label>
                      HelpDesk
                      </p>
                    </div>
                    
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'usuarios', true)?> class="ace item_id" value="usuarios"><span class="lbl"></span></label>
                      Usuários
                      </p>
                    </div>
                    
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'relatorios', true)?> class="ace item_id" value="relatorios"><span class="lbl"></span></label>
                      Relatórios
                      </p>
                    </div>
                    
					<div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'cadastros', true)?> class="ace item_id" value="cadastros"><span class="lbl"></span></label>
                      Cadastros
                      </p>
                    </div>
						
                    <div class="col-xs-12">
                      <p>
                      <label class="pos-rel"><input name="<?=$this->controller?>[permissao][]" type="checkbox" <?=$model->checkPer($roles, 'configuracoes', true)?> class="ace item_id" value="configuracoes"><span class="lbl"></span></label>
                      Configurações
                      </p>
                    </div>
                    
                    </div>
                </div></div>
            </div>
        </div>
        
        
        

<!-- /.row -->