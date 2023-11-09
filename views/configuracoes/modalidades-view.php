
<div class="widget-box  ui-sortable-handle page-box" id="usuarios" style="opacity: 1;">
    <div class="widget-header widget-header-small">
        <h6 class="widget-title">Modalidades</h6>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
            <div class="content">
            <div class="row">
              <div class="col-xs-12">
              	 <div class="well fake-form">
                 	<div class="row">
                    	<div class="col-xs-12">
                    		<h4 class="blue smaller ">Adicione uma modalidade</h4>
                    	</div>
                    </div>
                    
                    <div class="row">
                    	<div class="col-xs-12">
                    		<input type="text" name="nome"  class="col-xs-6 col-sm-6 col-lg-6  required" placeholder="Nome">
                            <input type="hidden" name="modulo" value="usuarios">
                            <div class="color-container">
                            <select id="simple-colorpicker-1" class="hide">
                                <option value="#ac725e">#ac725e</option>
                                <option value="#d06b64">#d06b64</option>
                                <option value="#f83a22">#f83a22</option>
                                <option value="#fa573c">#fa573c</option>
                                <option value="#ff7537">#ff7537</option>
                                <option value="#ffad46" selected="">#ffad46</option>
                                <option value="#42d692">#42d692</option>
                                <option value="#16a765">#16a765</option>
                                <option value="#7bd148">#7bd148</option>
                                <option value="#b3dc6c">#b3dc6c</option>
                                <option value="#fbe983">#fbe983</option>
                                <option value="#fad165">#fad165</option>
                                <option value="#92e1c0">#92e1c0</option>
                                <option value="#9fe1e7">#9fe1e7</option>
                                <option value="#9fc6e7">#9fc6e7</option>
                                <option value="#4986e7">#4986e7</option>
                                <option value="#9a9cff">#9a9cff</option>
                                <option value="#b99aff">#b99aff</option>
                                <option value="#c2c2c2">#c2c2c2</option>
                                <option value="#cabdbf">#cabdbf</option>
                                <option value="#cca6ac">#cca6ac</option>
                                <option value="#f691b2">#f691b2</option>
                                <option value="#cd74e6">#cd74e6</option>
                                <option value="#a47ae2">#a47ae2</option>
                                <option value="#555">#555</option>
                            </select>
                            </div>
                            <button type="button" class="btn btn-sm btn-success action-add" data-action="add-modalidade">Adicionar</button>
                            
                            
                            
                           
                        </div>
                    </div>
                    
                 </div>
              </div>
            </div>
            
            <div class="row">
            <div class="col-xs-12">
            <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer feed-grid" role="grid" aria-describedby="dynamic-table_info">
            <thead>
              <tr role="row">
              <th rowspan="1" colspan="1">Nome</th>
              <th width="20px">Limite</th>
              <th rowspan="1" colspan="1" width="35" align="center">Cor</th>
              <th rowspan="1" colspan="1" width="80" align="center">Ações</th>
              </tr>
            </thead>
            
            <tbody>
             <?
			 $salas = $model->_getModalidades();
             if($salas):
			 	foreach($salas as $sala):
				?>
                <tr>
                  <td rowspan="1" colspan="1">
				  <span class="name"><?=$sala[nome]?></span>
                  <input type="text" name="nome" class="input-hide" data-type='salas' value="<?=$sala[nome]?>">
                  </td>
                  <td>
                  	<span class="qtd"><?=($sala[qtd]?$sala[qtd]:'')?></span>
                  	<input align="center" type="text"  class="input-hide" name="qtd" style="width: 30px" value="<?=$sala[qtd]?>">
                  </td>
                  <td rowspan="1" colspan="1">
				  <div class="color-content" style="background:<?=$sala[cor]?>">
                  
                  
                  </div>
                  <div class="color-container-edit">
                            <select class="simple-colorpicker hide">
                                <option value="#ac725e">#ac725e</option>
                                <option value="#d06b64">#d06b64</option>
                                <option value="#f83a22">#f83a22</option>
                                <option value="#fa573c">#fa573c</option>
                                <option value="#ff7537">#ff7537</option>
                                <option value="#ffad46" selected="">#ffad46</option>
                                <option value="#42d692">#42d692</option>
                                <option value="#16a765">#16a765</option>
                                <option value="#7bd148">#7bd148</option>
                                <option value="#b3dc6c">#b3dc6c</option>
                                <option value="#fbe983">#fbe983</option>
                                <option value="#fad165">#fad165</option>
                                <option value="#92e1c0">#92e1c0</option>
                                <option value="#9fe1e7">#9fe1e7</option>
                                <option value="#9fc6e7">#9fc6e7</option>
                                <option value="#4986e7">#4986e7</option>
                                <option value="#9a9cff">#9a9cff</option>
                                <option value="#b99aff">#b99aff</option>
                                <option value="#c2c2c2">#c2c2c2</option>
                                <option value="#cabdbf">#cabdbf</option>
                                <option value="#cca6ac">#cca6ac</option>
                                <option value="#f691b2">#f691b2</option>
                                <option value="#cd74e6">#cd74e6</option>
                                <option value="#a47ae2">#a47ae2</option>
                                <option value="#555">#555</option>
                            </select>
                            </div>
                  </td>
                  <td rowspan="1" colspan="1">
                  	<a class="btn btn-xs btn-info edit-action" data-id="<?=$sala[ID]?>" data-status="edit" data-action="modalidades">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </a>
                    <a class="btn btn-xs btn-danger delete-action"  data-id="<?=$sala[ID]?>"  data-action="modalidades">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </a>
                  </td>
                </tr>
				<?
				endforeach;
			 endif;
			 ?>
            </tbody>
            </table>
  
            <div class="row">
            
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>

</div>

</div>
        