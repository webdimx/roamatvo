<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
parse_str($_COOKIE[reportSell], $fields);


$defaultFields = array('nome', 'plano', 'dias_uso', 'data_transacao', 'data_ativacao', 'data_off', 'iccid', 'mdn', 'status');
$fields = ($fields?$fields[filter]:$defaultFields);

?>

<script>controller='<?=$this->controller?>/vendas-externas'</script>



<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">


<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI?>vendas-externas" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>    
    <a href="<?=HOME_URI.$this->controller?>/exportReport/?<?=str_replace('path=vendas-externas', '', $_SERVER['QUERY_STRING'])?>"  class="btn btn-success   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar</a>
	<a href="<?=HOME_URI.$this->controller?>/exportReport/?<?=str_replace('path=vendas-externas', '', $_SERVER['QUERY_STRING'])?>"  class="btn btn-success exportSel   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar Selecionados</a>
</div>
</div>

	
<style>
			
</style>

	

<div class="table-content">
<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
          </th>
			  
			
		<th rowspan="1" colspan="1">Plano<br>
		<select  class="filter"  name="plano"   class="col-xs-12 col-sm-12 col-lg-12 required">
		<option value=""></option>
		<?
			
		 $json = MainController::CallApi('getTable', array('table' => 'wd_planos'));
		 foreach($json->info as $option):  
		?>
		<option value="<?=$option->ID?>" <?=($option->ID==$_GET[plano]?'selected':'') ?> data-local="<?=$option->local_uso?>"> <?=$option->nome?></option>
		<?
		 endforeach;  
		?>
		 </select>
			  
		  </th>
	     
			  
		  <th width="20" rowspan="1" colspan="1">Dias<br><input type="text" class="filter id" name="dias_uso" value="<?=$_GET['dias_uso']?>"></th>
			  
	     
		  <th rowspan="1" colspan="1">Data da Transação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_transacao" value="<?=$_GET['data_transacao']?>"> </th>
		  
		 
		  <th rowspan="1" colspan="1">Data da Ativação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_ativacao" value="<?=$_GET['data_ativacao']?>"> </th>
		  	
		  
		  <th rowspan="1" colspan="1">Data OFF<br><input type="text" class="filter date date-range " data-date-format="dd/mm/yyyy"  name="data_off" value="<?=$_GET['data_off']?>"></th>
		  
		  
		  <th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="iccid" value="<?=$_GET['iccid']?>"></th>
			  
		  
		  <th rowspan="1" colspan="1">Número da Linha<br><input type="text" class="filter" name="a|mdn" value="<?=$_GET['a|mdn']?>"></th>
		  
			  
		  
		  <th rowspan="1" colspan="1">Local de Uso<br>
			<select  name="a|local_uso"  class="filter">
				<option value=""></option>
				<?
				$json = MainController::CallApi('getTable', array('table' => 'wd_local_de_uso'));
		 		foreach($json->info as $option):  
				?>
				<option value="<?=$option->ID?>" <?=($option->ID==$_GET['a|local_uso']?'selected':'')?>><?=$option->local?></option>
				<?
				 endforeach;  
				?>
			</select> 	  
		  </th>
		  
		  
		  <th rowspan="1" colspan="1">Aparelho<br><input type="text" class="filter" name="aparelhos" value="<?=$_GET['aparelhos']?>"></th>
		  
			
		  <th rowspan="1" colspan="1">Países Informados<br><input type="text" class="filter" name="paises" value="<?=$_GET['paises']?>"></th>
		 
			  
		 
		  <th rowspan="1" colspan="1">Tipo<br>
			<select name="tipo" class="filter">
				<option value=""></option>  
				<option value="1"  <?=(1==$_GET[tipo]?'selected':'')?>>Venda</option>
				<option value="2"  <?=(2==$_GET[tipo]?'selected':'')?>>Desativação</option>
				<option value="3"  <?=(3==$_GET[tipo]?'selected':'')?>>Cancelamento</option>
			</select>	 
		  </th>
		  
			  
		  <!-- NEW -->
			  
			  
		  <!-- -->	  
			  
		  <? if(in_array('status', $fields)): ?>
		  <th  rowspan="1" colspan="1">Status<br>
			<select  class="filter"  name="status"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="1"  <?=(1==$_GET[status]?'selected':'') ?>>Aguardando Swap Ativação</option>
				<option value="2"  <?=(2==$_GET[status]?'selected':'') ?>>Ativo</option>
				<option value="3"  <?=(3==$_GET[status]?'selected':'') ?>>Aguardando Swap Desativação</option>
				<option value="4"  <?=(4==$_GET[status]?'selected':'') ?>>Desativado</option>
		   </select>	  
		  </th>
		  <? endif;?>	
         
          <th width="80" rowspan="1" colspan="1" align="center" >Ações<br></th>
          </tr>
      </thead>

      <tbody>
      
          <?
		  
		  
		  unset($_GET[path]);
		  $json = MainController::CallApi('getReportSells', $_GET);
		  
          $_attributes = $json->info;
		  
		  
          foreach($_attributes->data as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item->ID?>"><span class="lbl"></span></label></td>
			  
			 
			  
			
			  <td><?=$_item->plano?></td>
			  
			  
			  <td><?=$_item->dias_uso?></td>
			  
			  <td><?=$_item->data_transacao?></td>
			  
			  <td><?=$_item->data_ativacao?></td>
			  
			  
			  <td>
			  <?
			  $d = explode('/', $_item->data_off);
				  
			  echo ($_item->data_off?date('d/m/Y', mktime(0,0,0, $d[1], $d[0]+$_item->adiar, $d[2])):'');
				  
			  ?>
			  <?
			  if($_item->adiar):	  
			  ?>
			  <i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right " data-rel="tooltip" title="Data Original: <?=$_item->data_off?>"></i>
			  <?
			  endif;	  
			  ?>
			  </td>
			 
			  
			
			  
			  <td><?=$_item->iccid?></td>
			  
			  <? if(in_array('mdn', $fields)): ?>
			  <td><a href="<?=HOME_URI?>transacoes/?a|mdn=<?=$_item->mdn?>"><?=$_item->mdn?></a></td>
			  <? endif;?>
			<td><?=$_item->local_uso?></td>
			<td><?=$_item->aparelhos?></td>
			<td><?=$_item->paises?></td>
			
			
			<td><?=($_item->tipo==1?'Venda':($_item->tipo==2?'Desativação':'Cancelamento'))?></td>
			  <td>
				  
				  <?
				  switch($_item->status):
															   
					 case"1":
						echo 'Aguardando Swap de ativação';									   
					 break;
					
					 case"2":
						echo 'Ativo';										   
					 break;
															   
					 case"3":
						echo 'Aguardando Swap de desativação';										   
					 break;
															   
					 case"4":
						echo 'Desativado';										   
					 break;	
															   
		          endswitch;
				  ?>
				 </td>
			  
              
             <td align="center">
			  	
				<a data-rel="tooltip" title="Exportar" href="<?=HOME_URI.$this->controller."/importTransaction/".$_item->ID?>"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-file-excel-o bigger-120"></i></button></a>
				 
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
Total de registros: <strong><?=$_attributes->total?></strong></div>
</div>


<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
<?=$this->pagi($_attributes->total, $_attributes->page)?>
</div>
</div>


</div>

  

</div>

<script>
	
	$(window).load(function(){
		
		$('.table-content').mCustomScrollbar({axis:"x", theme:"inset-2-dark",mouseWheel:false})
		
	})
	
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
