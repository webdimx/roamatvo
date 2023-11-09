<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
$_attributes = $model->ReportError($this->type);
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">


<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
	<!--<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>/vouchers" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>    
	<a href="<?=HOME_URI.$this->controller?>/exportReportVouchers/?<?=str_replace('path=relatorios/vouchers', '', $_SERVER['QUERY_STRING'])?>"  class="btn btn-success   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar</a>-->
	<a href="#"  class="btn btn-success getSells   btn-sm " ><i class="fa fa-cloud-download"></i><span class="text"> Importar Vendas</span></a>
</div>
</div>

<style>
			
</style>

<div class="table-content">
<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
			  
          
			  
		  <th rowspan="1" colspan="1">Nome</th>	 
		  <th rowspan="1" colspan="1">SIMCARD<br>
		  <th rowspan="1" colspan="1">Novo SIMCARD<br>
		  <th rowspan="1" colspan="1">Data Compra</th>
		  <th rowspan="1" colspan="1">Local da Venda<br>
		  <th rowspan="1" colspan="1">Ponto de Venda</th>
		  <th rowspan="1" colspan="1">Atendente</th> 
		  <th rowspan="1" colspan="1" width="30">Ações</th> 
		  
          </tr>
      </thead>

      <tbody>
      
          <?
          
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              
			  
			  <td><?=$_item[nome]?></td>
			  <td><span class="sim-text<?=$_item[id_skillsim]?>"><?=$_item[iccid]?></span></td>
			  <td><?=$_item[iccid_novo]?></td>
			  <td><?=$_item[data_compra]?></td>
			  <td><?=$_item[local]?></td>
			  <td><?=$_item[ponto]?></td>
			  <td><?=$_item[atendente]?></td>
			  <td align="center">
			  
			  <?
			  if(!$_item[iccid_novo]):
			  ?> 
			  <a data-rel="tooltip" title="" href="#modal-sim"  data-toggle="modal" data-id="<?=$_item[id_skillsim]?>" data-original-title="Corrigir SIMCARD" class="cs"><button class="btn btn-minier bigger btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a>
			  <?
			  else:
			  ?> 
			   <a data-rel="tooltip" href="#" data-original-title="SIMCARD Corrigido"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-check-circle bigger-120"></i></button></a>
			  	  
			  <?
			  endif;
			  ?> 
			  </td>
			  
          </tr>      
              
          				  
                          
                        
          <?
          endforeach;
          ?>
     </tbody>
</table>
  </div>
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
		
		$('.cs').click(function(){
			
			$('#modal-sim').find('.changeSim').attr('data-id', $(this).data('id'))
			
		})
		
		
		$('.changeSim').click(function(){
			
			$id = $(this).data('id')
			
			$.post(controllerUrl+'/changeSim/', {id: $(this).data('id'), sim: $('input[name=new_simcard]').val()}, function(a){
				
				
			window.location.reload()
			
				
				
			})
			
			
		})
		
		$('.getSells').click(function(){
			
			$(this).removeClass('getSells')
			$(this).find('.text').html(' Importando vendas, aguarde...')
			
			$.post(ajaxUrl+'/cron/getSells', '', function(a){
				
				
				window.location.reload()
				
				
			})
			
			
		})
		
	})
	
	
</script>
