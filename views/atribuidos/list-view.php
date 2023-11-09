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
	
	<?
	if(!$this->subController=='historico'):
	?>
	<a href="<?=HOME_URI.$this->controller?>?mdn=1" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-files-o bigger-110 "></i> Apenas MDN</a>
	<a href="<?=HOME_URI.$this->controller?>?simcard=1" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-files-o bigger-110 "></i> Apenas SIMCARD</a>
	<a href="<?=HOME_URI.$this->controller?>/historico" class="btn btn-primary btn-sm "><i class="fa fa-history" aria-hidden="true"></i> Histórico</a>
	<a href="<?=HOME_URI.$this->controller?>?transacao=1" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-files-o bigger-110 "></i> Associados a Transações</a>
	<?
	endif;
	?>
	<a href="#"  class="btn btn-primary btn-sm btn-success export" data-action="all"><i class="fa fa-file-excel-o bigger-110 "></i> Exportar</a>
</div>
</div>

<style>
			
</style>











<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer table-<?=$this->controller?>" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
		   
          </th>
          <? if(!$_GET[mdn]):?><th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="simcard" value="<?=$_GET['simcard']?>"><input type="hidden" value="<?=$_GET[historico]?>" name="historico"> </th><? endif;?>
          <? if(!$_GET[simcard]):?><th rowspan="1" colspan="1">MDN<br><input type="text" class="filter" name="a|mdn" value="<?=$_GET['a|mdn']?>"></th><? endif;?>
          <? if(!$_GET[simcard]):?> <th rowspan="1" colspan="1">Status MDN<br>
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
			  
		  </th><? endif;?>
		   <? if(!$_GET[mdn]):?><th rowspan="1" colspan="1">Status SIMCARD<br>
		  <select  name="status_simcard"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('status_simcard') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[status_simcard]?'selected':'')?>><?=$option[status]?></option>
					<?
					 endforeach;  
					?>
			</select>   	  
		  </th><? endif;?>
           <? if(!$_GET[mdn]):?><th rowspan="1" colspan="1">Estoque<br>
			  <select  name="local_estoque"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('local_de_estoque') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[local_estoque]?'selected':'')?>><?=$option[local]?></option>
					<?
					 endforeach;  
					?>
			</select>   <? endif;?>
			  
		</th>
          <th rowspan="1" colspan="1">Ativado em<br><input type="text" class="filter date-range date " data-date-format="dd/mm/yyyy" name="data_ativacao" value="<?=$_GET['data_ativacao']?>"></th>
          <th rowspan="1" colspan="1">Plano<br>
			   <select  name="plano"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('planos') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[plano]?'selected':'')?>><?=$option[nome]?></option>
					<?
					 endforeach;  
					?>
			</select> 
		  </th>
          <th rowspan="1" colspan="1">Dias<br><input type="text" class="filter id" name="dias_uso" value="<?=$_GET[dias_uso]?>"></th>
          <th rowspan="1" colspan="1">Data Off<br><input type="text" class="filter date-range date " data-date-format="dd/mm/yyyy" name="data_off" value="<?=$_GET['data_off']?>"></th>
          <th rowspan="1" colspan="1">Fornecedores<br>
		 <select  name="fornecedor"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getListAssociate() as $option):  
					?>
					<option value="<?=$option[value]?>" <?=($option[value]==$_GET['fornecedor']?'selected':'')?>><?=$option[fornecedor]?></option>
					<?
					 endforeach;  
					?>
			</select> 	  
		  </th>
          <th rowspan="1" colspan="1">Obs.<br>&nbsp;</th>
		  <th rowspan="1" colspan="1"></th>
         
          
          
          
          
          </tr>
      </thead>

      <tbody>
      
          <?
		  

          $_attributes = $model->getList($this->subController);
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <? if(!$_GET[mdn]):?> <td><?=$_item[simcard]?></td><? endif;?>
			  <? if(!$_GET[simcard]):?><td><?=$_item[mdn]?></td><? endif;?>
			  <? if(!$_GET[simcard]):?><td><?=$_item[status_mdn]?></td><? endif;?>
			  <? if(!$_GET[mdn]):?><td><?=$_item[status_simcard]?></td><? endif;?>
			  <? if(!$_GET[mdn]):?><td><?=$_item[local_estoque]?></td><? endif;?>
			  <td><?=$_item[data_ativacao]?></td>
			  <td><?=$_item[plano]?></td>
			  <td><?=$_item[qtd_dias]?></td>
			  <td>
			  <?
	 		  if($_item[adiar]):
			  $d = explode('/', $_item[data_off]);
			  echo date('d/m/Y', mktime(0,0,0, $d[1], $d[0]+$_item[adiar], $d[2]));
			  ?>
			  <?
			 	  
			  ?>
			  <i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right " data-rel="tooltip" title="Data Original: <?=$_item[data_off]?>"></i>
			  <?
	
			 
				 
				 
			  endif;
			 
			  ?>
			  
			  
			  </td>
			  <td>
			 <?=$_item[fornecedor_simcard]?><?=($_item[fornecedor_simcard] && $_item[fornecedor_mdn]?'/':'')?><?=$_item[fornecedor_mdn]?>
			  
			  </td>
			  <td><?=($_item[observacao]?'<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="'.$_item[observacao].'"><i class="ace-icon fa fa-flag bigger-120"></i></button>':'')?></td>
			  <td>
			  <div class="action-buttons">
						<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
							<i class="ace-icon fa fa-angle-double-down"></i>
							<span class="sr-only">Details</span>
						</a>
					</div>
			  </td>
                    
		  </tr>
		  <tr class="detail-row">
													<td colspan="13">
														<div class="table-detail">
															<div class="row">
																

																<div class="col-xs-12 col-sm-4">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[simcard]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Status SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[status_simcard]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor_simcard]?></span>
																			</div>
																		</div>
																			<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Estoque</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_estoque]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Plano </div>

																			<div class="profile-info-value">
																				<span><?=$_item[plano]?></span>
																			</div>
																		</div>
																		
																		
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_uso]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Venda</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_venda]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Nome</div>

																			<div class="profile-info-value">
																				<span><?=$_item[nome]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> E-mail</div>

																			<div class="profile-info-value">
																				<span><?=$_item[email]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Observação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[observacoes]?></span>
																			</div>
																		</div>

																		

																	
																		
																	</div>
																</div>
																
																<div class="col-xs-12 col-sm-8">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[mdn]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Status MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[status_mdn]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor_mdn]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">&nbsp;</div>

																			<div class="profile-info-value">
																				<span></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Dias</div>

																			<div class="profile-info-value">
																				<span><?=$_item[qtd_dias]?></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">&nbsp;</div>

																			<div class="profile-info-value">
																				<span></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Ponto de Venda</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_ativacao]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Celular</div>

																			<div class="profile-info-value">
																				<span><?=$_item[celular]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Documento</div>

																			<div class="profile-info-value">
																				<span><?=$_item[documento]?></span>
																			</div>
																		</div>

																	</div>
																</div>

																
															</div>
														</div>
													</td>
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
