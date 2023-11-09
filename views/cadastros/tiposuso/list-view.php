<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="<?=HOME_URI.$this->controller?>/adicionar-tipo-de-uso" class="btn btn-success btn-sm filterRegistry filterRegistry"><i class="fa fa-plus bigger-110 "></i> Novo</a>
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller.$this->subController?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>    
    <a href="#modal-confirm" data-toggle="modal"  data-table="wd_tipo_de_uso" class="btn btn-danger  btn-sm  delete "><i class="fa fa-trash-o "></i> Excluir selecionados</a>
</div>
</div>

<style>
			
</style>











<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
          </th>
          <th rowspan="1" colspan="1" width="50">Código<br><input type="text" class="filter id" name="codigo" value="<?=$_GET['codigo']?>"></th>
          <th rowspan="1" colspan="1">Tipo<br><input type="text" class="filter" name="tipo" value="<?=$_GET[tipo]?>"></th>
	      <th rowspan="1" colspan="1" width="150">Apelido<br><input type="text" class="filter" name="apelido" value="<?=$_GET['apelido']?>"></th>
          
		  <th rowspan="1" colspan="1">Destino MDN<br>
			<select name="destino_mdn" class="filter">
				<option value=""></option>
				<option value="1" <?=($_GET[destino_mdn]==1?'selected':'')?>>Volta para estoque</option> 
				<option value="2" <?=($_GET[destino_mdn]==2?'selected':'')?>>Vai para Excluído</option>
			</select>		  
		  </th>
		  <th rowspan="1" colspan="1">Destino SIMCARD<br>
			<select name="destino_simcard" class="filter">
				<option value=""></option>
				<option value="1" <?=($_GET[destino_simcard]==1?'selected':'')?>>Volta para estoque</option> 
				<option value="2" <?=($_GET[destino_simcard]==2?'selected':'')?>>Vai para Excluído</option>
			</select>		  
		  </th>
          <th rowspan="1" colspan="1">Associação<br>
			<select name="associacao" class="filter">
				<option value=""></option>
				<option value="1" <?=($_GET[associacao]==1?'selected':'')?>>Mesmo Fornecedor</option> 
				<option value="2" <?=($_GET[associacao]==2?'selected':'')?>>Fornecedor diferente</option>
			</select>	  
		  </th>
		  <th rowspan="1" colspan="1" width="20">Desc.<br>&nbsp;</th>
		  <th width="20" rowspan="1" colspan="1" align="center">Ações<br>&nbsp;</th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList('tipodeuso');
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <td><?=$_item[codigo]?></td>
			  <td><?=$_item[tipo]?></td>
			  <td><?=$_item[apelido]?></td>
			  <td><?=($_item[destino_mdn]==1?'Volta para estoque':'Vai para Excluído')?></td>
			  <td><?=($_item[destino_simcard]==1?'Volta para estoque':'Vai para Excluído')?></td>
			  <td><?=($_item[associacao]==1?'Mesmo Fornecedor':'Fornecedor diferente')?></td>
			  <td><?=($_item[descricao]?'<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="'.$_item[descricao].'"><i class="ace-icon fa fa-flag bigger-120"></i></button>':'')?></td>
			  <td align="center"><a href="<?=HOME_URI.$this->controller."/editar-tipo-de-uso/".$_item[ID]?>"><button class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a></td>
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


