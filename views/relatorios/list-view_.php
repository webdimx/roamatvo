<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a href="<?=HOME_URI.$this->controller?>/remessa"  class="btn btn-primary btn-sm  verifyRemessa"><i class="fa fa-barcode bigger-110 "></i> Gerar remessa</a>
    <a href="#"  class="btn btn-primary btn-sm"><input style="position: absolute;top: 0;left: 0;height: 29px;width: 126px;opacity: 0" multiple type="file"  name="file" >
    <i class="fa fa-share bigger-110 "></i> Enviar retorno</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>
    
    
    <a href="#modal-confirm" data-toggle="modal" class="btn btn-danger  btn-sm  delete "><i class="fa fa-trash-o "></i> Excluir selecionados</a>
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
          <th rowspan="1" colspan="1">ID<br><input type="text" class="filter id" name="a|ID" value="<?=$_GET['a|ID']?>"></th>
          <th rowspan="1" colspan="1">Aluno<br><input type="text" class="filter" name="b|nome" value="<?=$_GET['b|nome']?>"></th>
          <th rowspan="1" colspan="1">Valor<br><input type="text" class="filter money" name="valor" value="<?=$_GET[valor]?>"></th>
          <th rowspan="1" colspan="1">Vencimento<br><input type="text" class="filter date-pickers " data-date-format="dd/mm/yyyy" name="data_vencimento" value="<?=$_GET['data_vencimento']?>"></th>
          <th rowspan="1" colspan="1" width="150">
		  Tipo<br>
          <select class="filter" name="tipo">
            	<option value=""></option>
            	<option value="1" <?=($_GET['tipo']==1?'selected':'')?>>Mensalidade</option>
            	<option value="2" <?=($_GET['tipo']==2?'selected':'')?>>Multa</option>
            	<option value="3" <?=($_GET['tipo']==3?'selected':'')?>>Boleto Único</option>
            	<option value="4" <?=($_GET['tipo']==4?'selected':'')?>>Material</option>
            	<option value="5" <?=($_GET['tipo']==5?'selected':'')?>>Matrícula</option>
            	
                
                
                
                
            </select>
          </th>
          <th rowspan="1" colspan="1" width="150">Status<br>
          <select class="filter" name="a|status">
            	<option value=""></option>
            	<option value="1" <?=($_GET['a|status']==1?'selected':'')?>>Pendente</option>
                <option value="2" <?=($_GET['a|status']==2?'selected':'')?>>Pago</option>
                <option value="4" <?=($_GET['a|status']==4?'selected':'')?>>Vencido</option>
                <option value="3" <?=($_GET['a|status']==3?'selected':'')?>>Acordo</option>
            </select>
          </th>
          
         
          
          
          
          
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList($this->type);
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <td width="20"><a href="<?=HOME_URI.$this->controller."/detalhes/".$_item[ID]?>"><?=$_item[ID]?></a></td>
              <td><a href="<?=HOME_URI.$this->controller."/detalhes/".$_item[ID]?>"><?=$_item[nome]?></a></td>
              <td><a href="<?=HOME_URI.$this->controller."/detalhes/".$_item[ID]?>">R$ <?=money($_item[valor])?></a></td>
              <td><?=formatDate($_item[data_vencimento])?></td>
              <td>
              
              <?
			  if($_item[tipo]==1):
				
				echo 'Mensalidade';											   
															   
			  elseif($_item[tipo]==2):
				
				echo 'Multa';											   
															   
	          elseif($_item[tipo]==3):
															   
				echo 'Boleto Único';											   
															   
			  elseif($_item[tipo]==4):
															   
				echo 'Material';
					
			  elseif($_item[tipo]==5):
															   
				echo 'Matrícula';
															   
			  endif;											   
															   
			  ?>
             
             
              
              <td align="center"><?=$model->getStatus($_item[status])?>
             
             <?
	         if($_item[status]==1 or $_item[status]==4):
			 ?>												   
             <button class="btn btn-success bl btn-minier pull-right submit-form markPay" data-id="<?=$_item[ID]?>" type="submit">
             <i class="ace-icon fa fa-check bigger-110"></i> </button>
             <?
			 endif;	  
			 ?>
             </td>
             
              
                
              
          				  
                          
                        
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
