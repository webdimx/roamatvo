
<div class="widget-box  ui-sortable-handle page-box" id="usuarios" style="opacity: 1;">
    <div class="widget-header widget-header-small">
        <h6 class="widget-title">Pautas</h6>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
            <div class="content">
            <div class="row">
              <div class="col-xs-12">
              	 <div class="well fake-form">
                 	<div class="row">
                    	<div class="col-xs-12">
                    		<h4 class="blue smaller ">Adicione uma pauta</h4>
                    	</div>
                    </div>
                    
                    <div class="row">
                    	<div class="col-xs-12">
                    		<input type="text" name="nome"  class="col-xs-6 col-sm-6 col-lg-6  required" placeholder="Nome">
                            <input type="hidden" name="modulo" value="agendamentos">
                            <button type="button" class="btn btn-sm btn-success action-add" data-action="add-subject">Adicionar</button>
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
              <th rowspan="1" colspan="1" width="80" align="center">Ações</th>
              </tr>
            </thead>
            
            <tbody>
             <?
			 $pautas = $model->_getSubjects();
             if($pautas):
			 	foreach($pautas as $pauta):
				?>
                <tr>
                  <td rowspan="1" colspan="1">
				  <span><?=$pauta[nome]?></span>
                  <input type="text" name="nome" class="input-hide" data-type='salas' value="<?=$pauta[nome]?>">
                  </td>
                  <td rowspan="1" colspan="1">
                  	<a class="btn btn-xs btn-info edit-action" data-id="<?=$pauta[ID]?>" data-status="edit" data-action="agendamento_pauta" >
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </a>
                    <a class="btn btn-xs btn-danger delete-action"  data-id="<?=$pauta[ID]?>"  data-action="agendamento_pauta">
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
        