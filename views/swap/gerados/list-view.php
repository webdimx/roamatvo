<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
 	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>/gerados" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
	<a href="<?=HOME_URI.$this->controller?>/gerados/?todos=1" class="btn btn-success btn-sm  clear-filters"><i class="fa fa-eye bigger-110 "></i> Mostrar todos</a>
</div>
</div>

	
<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
		  <input type="hidden" name="future" value="<?=$_GET[futuros]?>">
          </th>
          <th rowspan="1" colspan="1" width="">SWAP<br><input type="text" class="filter id" name="ID" value="<?=$_GET['ID']?>"></th>
          <th rowspan="1" colspan="1">Fornecedor<br>
			  <select name="fornecedor" class="filter">
			  	<option value=""></option>
				  
				<? foreach($model->getFornecedorList() as $for): ?>
					<option value="<?=$for[0]?>" <?=($for[0]==$_GET[fornecedor]?'selected':'')?>><?=$for[1]?></option>
				<? endforeach; ?>
				
			  </select>
		  </th>
          <th rowspan="1" colspan="1" width="150">Tipo de Swap<br>
			 <select name="tipo" class="col-xs-12 col-sm-12 col-lg-12 filter">
				<option value=""></option>  
				<option value="1" <?=($_GET[tipo]==1?'selected':'')?>>Ativação</option>
				<option value="2" <?=($_GET[tipo]==2?'selected':'')?>>Desativação</option>
			  </select> 	  
		  </th>
          <th rowspan="1" colspan="1" width="150">Quantidade do Lote<br><input type="text" class="filter" name="qtd_lote" value="<?=$_GET['qtd_lote']?>"></th>
		  <th width="100" rowspan="1" colspan="1" align="center">Data<br><input class="filter date-range date" name="data" value="<?=$_GET['data']?>"   type="text" data-date-format="dd/mm/yyyy"></th>
			  
          <th width="20" rowspan="1" colspan="1" align="center">Ações<br></th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getListSwaps();
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <td>SWAP Lote: <?=$_item[ID]?> - <?=$model->getFornecedor(str_replace(array("'", '-'), array('', ','), $_item[fornecedor]))?> <?=$_item[data]?>_<?=$_item[hora]?> - <?=$_item[name]?></td>
			  <td><?=$model->getFornecedor(str_replace(array("'", '-'), array('', ','), $_item[fornecedor]))?></td>
			  <td><?=($_item[tipo]==1?'Ativação':'Desativação')?></td>
			  <td><?=$_item[qtd_lote]?></td>
			  <td><?=$_item[swap_data]?></td>
			  <td><a href="<?=HOME_URI.$this->controller."/detalhe/".$_item[ID]?>"><button class="btn btn-xs btn-success"><i class="ace-icon fa fa-eye bigger-120"></i></button></a></td>
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

<script>
	
	$(document).ready(function(){
		
		$('.gswap').click(function(){
			
			$('.stype').html(($(this).data('tipo')==1?'Venda':'Data Off'))
			$('.makeSwap').attr('data-tipo', $(this).data('tipo'))
			
		})
		
		$('.checkAll').click(function(){
			
			if($(this).is(':checked')){
			$('#modal-swap').find('input[type=checkbox]').prop('checked', true)
			}
			else{
			$('#modal-swap').find('input[type=checkbox]').prop('checked', false)
			}
		})
		
		$('.makeSwap').click(function(){
			
			$f = new Array;
			
			$('.makeSwap').parents('#modal-swap').find('input[type=checkbox]:checked').each(function(){
				
				if($(this).val()){
					
					$f.push($(this).val())
					
				}
				
				
			})
			
			
			$.post(controllerUrl+'getSwapPendent', {tipo: $(this).data('tipo'), 'fornecedores': JSON.stringify($f)}, function(a){
				
				
				
			})
			
		})
		
	})
</script>
