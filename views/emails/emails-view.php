


<?php 
if ( ! defined('ABSPATH')) exit; 
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">

<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a href="#" class="btn btn-danger  btn-sm  delete "><i class="fa fa-trash-o "></i> Excluir selecionados</a>
</div>
</div>

<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          
          
          <th rowspan="1" colspan="1" width="20%">Nome<br><input type="text" class="filter" name="nome" value="<?=$_GET[nome]?>"></th>
          
          
          
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList($this->type);
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td><a href="<?=HOME_URI?>emails/editar/<?=$_item[ID]?>"><?=$_item[nome]?></a></td>
              
              
              
                              
              
          				  </tr>
                          
                       
                          
                        
          <?
          endforeach;
          ?>
     </tbody>
</table>
  
<div class="row">
<div class="col-xs-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
</div>
</div>


<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">

</div>
</div>


</div>
</div>

