<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="<?=HOME_URI.$this->controller?>/adicionar-mdn" class="btn btn-success btn-sm"><i class="fa fa-plus bigger-110 "></i> Novo</a>
	<a href="#modal-import-lote" class="btn btn-success btn-sm ic" data-toggle="modal" data-type="1"><i class="fa  fa-cloud-upload bigger-110 "></i> Importar Lote MDN</a>
	<a href="#" class="btn btn-warning btn-sm exportCad" data-type="mdn"  data-method="all"><i class="fa fa-file-excel-o bigger-110 "></i> Exportar</a>
	<a href="#" class="btn btn-warning btn-sm exportCad" data-type="mdn"><i class="fa fa-file-excel-o bigger-110 "></i> Exportar Selecionados</a>
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller.$this->subController?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
  
</div>
</div>

<style>
			
</style>

<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
		  <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <th rowspan="1" colspan="1">MDN<br><input type="text" class="filter" name="mdn" value="<?=$_GET['mdn']?>"></th>
          <th rowspan="1" colspan="1">Status<br>
		  <select  name="status_mdn"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('status_mdn') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[status_mdn]?'selected':'')?>><?=$option[status]?></option>
					<?
					 endforeach;  
					?>
			</select>   	  
		  </th>
	      <th rowspan="1" colspan="1">Código de Uso<br>
			<select  name="tipo_uso"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('tipo_de_uso') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[tipo_uso]?'selected':'')?>> <?=$option[codigo]?> - <?=$option[apelido]?></option>
					<?
					 endforeach;  
					?>
				  </select> 	  
		  </th>
			  
			<th rowspan="1" colspan="1">Fornecedor<br>
			<select  name="fornecedor_mdn"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('fornecedores') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[fornecedor_mdn]?'selected':'')?>><?=$option[nome]?></option>
					<?
					 endforeach;  
					?>
				  </select> 	  
		  </th>
          <th rowspan="1" colspan="1">Lote<br><input type="text" class="filter" name="lote" value="<?=$_GET[lote]?>"></th>
		  <th rowspan="1" colspan="1">Data<br><input type="text" class="filter date-range date " data-date-format="dd/mm/yyyy" name="data" value="<?=$_GET['data']?>"></th>
		  <th width="40" rowspan="1" colspan="1" align="center">Associação<br>
			<select  name="uso_externo"  class="filter">
					<option value="">Todos</option>	
					<option value="1" <?=$_GET[uso_externo]?'selected':''?>>Uso Externo</option>
				  </select> 			  
		  </th>
		  <th width="20" rowspan="1" colspan="1" align="center">OBS.<br></th>
		  <th width="20" rowspan="1" colspan="1" align="center">Ações<br></th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList('mdn');
													 
													 
          
          foreach($_attributes[data] as $_item):
													 
											
          ?>
          <tr role="row" class="odd">
			  <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
			  <td><a href="<?=HOME_URI?>transacoes/?a|mdn=<?=$_item[mdn]?>"><?=$_item[mdn]?></a> 
			   
			  </td>
			  
			  <td><?=$_item[status]?></td>
			  <td><?=$_item[tipo_uso]?></td>
			  <td><?=$_item[fornecedor]?></td>
			  <td><?=$_item[lote]?></td>
			  <td><?=$_item[data]?></td>
			  <td align="center">
				<?=(isset($_item[simcard]) && isset($_item[mdn])?'<button class="btn btn-minier bigger btn-success btn-primary" data-rel="tooltip" title="Associado ao SIMCARD '.$_item[simcard].'">A</button>':'')?>
			   <?=($_item[tu]==3?'<button class="btn btn-minier bigger btn-primary" data-rel="tooltip" title="Casado com o SIMCARD '.$_item[simcard].'">C</button>':'')?>
			   <?=($_item[uso_externo]==1?'<button class="btn btn-minier bigger btn-yellow" data-rel="tooltip" title="Sendo utilizado externamente via API">E</button>':'')?>
			  </td>
			  <td><?=($_item[observacoes]?'<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="'.$_item[observacoes].'"><i class="ace-icon fa fa-flag bigger-120"></i></button>':'')?></td>
			  <td align="center"><a href="<?=HOME_URI.$this->controller."/editar-mdn/".$_item[ID]?>"><button class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a></td>
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


