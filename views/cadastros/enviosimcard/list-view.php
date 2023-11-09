<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
	<a href="#modal-export-lote" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa  fa-cloud-upload bigger-110 "></i> Gerar Envio</a>
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller.$this->subController?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>    
    <a href="#modal-confirm" data-toggle="modal"  data-table="wd_mdn" class="btn btn-danger  btn-sm  delete "><i class="fa fa-trash-o "></i> Excluir selecionados</a>
</div>
</div>

<style>
			
</style>

<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th rowspan="1" colspan="1">Lote<br><input type="text" class="filter" name="lote" value="<?=$_GET['lote']?>"></th>
          <th rowspan="1" colspan="1">Local de Estoque<br><input type="text" class="filter" name="local_estoque" value="<?=$_GET[local_estoque]?>"></th>
          <th rowspan="1" colspan="1" width="100">Data<br><input type="text" class="filter date-pickers" data-date-format="dd/mm/yyyy" name="data" value="<?=$_GET[data]?>"></th>
		  <th rowspan="1" colspan="1" width="20">Anexo</th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList('envios');
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td><?=$_item[lote]?></td>
			  <td><?=$_item[local_estoque]?></td>
			  <td><?=$_item[data]?></td>
			  <td><a data-rel="tooltip" title="" href="<?=HOME_URI.'/views/_files/reports/'.$_item[anexo]?>" data-original-title="Exportar"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-file-excel-o bigger-120"></i></button></a></td>
		  </tr>              
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


