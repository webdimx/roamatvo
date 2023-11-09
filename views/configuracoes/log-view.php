<?php 
if ( ! defined('ABSPATH')) exit; 
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>/logs/" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a href="#modal-confirm" data-toggle="modal" class="btn btn-danger  btn-sm  delete " data-table="wd_logs"><i class="fa fa-trash-o "></i> Excluir selecionados</a>
</div>
</div>


<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
         <th rowspan="1" colspan="1">Ação<br><input type="text" class="filter" name="action" value="<?=$_GET[action]?>"></th>
          <th width="120" rowspan="1" colspan="1">Data<br><input type="text" class="filter date  date-picker " name="data" value="<?=$_GET[data]?>"></th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getLogs();
          
          foreach($_attributes[data] as $_item):
		  
          ?>
          
          <tr role="row" class="odd">
             <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <td><?=$_item[action]?></td>
              <td><?=formatDate($_item[data])?></td>
                        
          <?
          endforeach;
          ?>
     </tbody>
</table>
  
<div class="row">
<div class="col-xs-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
Total de registros: <strong><?=$_attributes[total]?></strong></div>
</div>


<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
<?=$this->pagi($_attributes[total], $_attributes[page])?>
</div>
</div>


</div>
</div>
