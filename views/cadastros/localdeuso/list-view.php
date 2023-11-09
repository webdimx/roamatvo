<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="<?=HOME_URI.$this->controller?>/adicionar-local-de-uso" class="btn btn-success btn-sm filterRegistry filterRegistry"><i class="fa fa-plus bigger-110 "></i> Novo</a>
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller.$this->subController?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>    
    <a href="#modal-confirm" data-toggle="modal" data-table="wd_local_de_uso" class="btn btn-danger  btn-sm  delete "><i class="fa fa-trash-o "></i> Excluir selecionados</a>
</div>
</div>
	
<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
          </th>
          <th rowspan="1" colspan="1">Local<br><input type="text" class="filter" name="local" value="<?=$_GET['local']?>"></th>
          <th rowspan="1" colspan="1">Situação<br>
			 <select name="situacao" class="filter">
				<option value=""></option>
				<option value="1" <?=($_GET[situacao]==1?'checked':'')?>>Ativo</option>
				<option value="2" <?=($_GET[situacao]==2?'checked':'')?>>Inativo</option>
			</select>  	  
		  </th>
          <th rowspan="1" colspan="1" width="20">Obs.<br>&nbsp;</th>
		  <th width="20" rowspan="1" colspan="1" align="center">Ações<br>&nbsp;</th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList('localdeuso');
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <td><?=$_item[local]?></td>
              <td><?=($_item[situacao]==1?'Ativo':'Inativo')?></td>
              <td><?=($_item[observacao]?'<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="'.$_item[observacao].'"><i class="ace-icon fa fa-flag bigger-120"></i></button>':'')?></td>
			  <td align="center"><a href="<?=HOME_URI.$this->controller."/editar-local-de-uso/".$_item[ID]?>"><button class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a></td>
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
		
		$('.date-pickers').datepicker().on('changeDate', function (e) {
			
			$('.filterRegistry').trigger('click')
			
		});
		
		$('.date-pickers').datepicker({
			
			
			autoclose: true,
			todayHighlight: true,
			
			
		})
		
		
		
		
		$('input[name=file]').change(function(a){
			
			
			if($(this).val()){
			 files = a.target.files;
			 }
			
			
			
			var $data = new FormData();
		
			$.each(files, function(key, value)
			{
				$data.append(key, value);
				
			});
			
			
			var dados = new FormData(this);
			
			
			
			
			$.ajax({
				url: controllerUrl+'retorno',
				type: 'POST',
				data:  $data,
				mimeType:"multipart/form-data",
				contentType: false,
				cache: false,
				processData:false,
				success: function(data, textStatus, jqXHR)
					{
						
						$('.returnModal').trigger('click')
						
					},
				error: function(jqXHR, textStatus, errorThrown) 
					{
						// Em caso de erro
					}          
			});
			
			console.log(files[0])
			
		})
		
	})
</script>
