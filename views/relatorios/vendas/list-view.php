<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
          </th>
			  
		<? if(in_array('nome', $_POST[filter])): ?>	  
        <th rowspan="1" colspan="1">Nome do Cliente<br><input type="text" class="filter" name="a|nome" value="<?=$_GET['a|nome']?>"></th>
		<? endif;?>	
		<? if(in_array('plano', $_POST[filter])): ?>	
		<th rowspan="1" colspan="1">Plano<br>
		<select  class="filter"  name="plano"   class="col-xs-12 col-sm-12 col-lg-12 required">
		<option value=""></option>
		<?
		 foreach($modelConfig->getOptions('planos', true) as $option):  
		?>
		<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[plano]?'selected':'') ?> data-local="<?=$option[local_uso]?>"> <?=$option[nome]?></option>
		<?
		 endforeach;  
		?>
		 </select>
			  
		  </th>
	      <? endif;?>	
		  <? if(in_array('dias_uso', $_POST[filter])): ?>	  
		  <th rowspan="1" colspan="1">Dias<br><input type="text" class="filter" name="dias_uso" value="<?=$_GET['dias_uso']?>"></th>
		  <? endif;?>	
	      <? if(in_array('data_transacaoe', $_POST[filter])): ?>
		  <th rowspan="1" colspan="1">Data da Transação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_transacao" value="<?=$_GET['data_transacao']?>"> </th>
		  <? endif;?>	
		  <? if(in_array('data_ativacao', $_POST[filter])): ?>
		  <th rowspan="1" colspan="1">Data da Ativação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_ativacao" value="<?=$_GET['data_ativacao']?>"> </th>
		  <? endif;?>	
		  <? if(in_array('data_off', $_POST[filter])): ?>
		  <th rowspan="1" colspan="1">Data OFF<br><input type="text" class="filter date date-range " data-date-format="dd/mm/yyyy"  name="data_off" value="<?=$_GET['data_off']?>"></th>
		  <? endif;?>
		  <? if(in_array('iccid', $_POST[filter])): ?>
		  <th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="iccid" value="<?=$_GET['iccid']?>"></th>
		  <? endif;?>
		  <? if(in_array('mdn', $_POST[filter])): ?>
		  <th rowspan="1" colspan="1">MDN<br><input type="text" class="filter" name="a|mdn" value="<?=$_GET['a|mdn']?>"></th>
		  <? endif;?>
		  <? if(in_array('status', $_POST[filter])): ?>
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
          $_attributes = $model->getList($this->type);
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
			  
			  <? if(in_array('nome', $_POST[filter])): ?>
              <td> <?=$_item[nome]?></td>
			  <? endif;?>
			  
			  <? if(in_array('plano', $_POST[filter])): ?>
			  <td><?=$_item[plano]?></td>
			  <? endif;?>
			  
			  <? if(in_array('dias_uso', $_POST[filter])): ?>
			  <td><?=$_item[dias_uso]?></td>
			  <? endif;?>
			  
			  <? if(in_array('data_transacao', $_POST[filter])): ?>
			  <td><?=$_item[data_transacao]?></td>
			  <? endif;?>
			  
			  <? if(in_array('dias_ativacao', $_POST[filter])): ?>
			  <td><?=$_item[data_ativacao]?></td>
			  <? endif;?>
			  
			  <? if(in_array('dias_off', $_POST[filter])): ?>
			  <td>
			  <?
			  $d = explode('/', $_item[data_off]);
			  echo date('d/m/Y', mktime(0,0,0, $d[1], $d[0]+$_item[adiar], $d[2]));
			  ?>
			  <?
			  if($_item[adiar]):	  
			  ?>
			  <i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right " data-rel="tooltip" title="Data Original: <?=$_item[data_off]?>"></i>
			  <?
			  endif;	  
			  ?>
			  </td>
			  <? endif;?>
			  
			  <? if(in_array('iccid', $_POST[filter])): ?>
			  <td><?=$_item[iccid]?></td>
			  <? endif;?>
			  
			  <? if(in_array('mdn', $_POST[filter])): ?>
			  <td><?=$_item[mdn]?></td>
			  <? endif;?>
			  
			  <? if(in_array('status', $_POST[filter])): ?>
			  <td>
				  
				  <?
				  switch($_item[status]):
															   
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
			  <? endif;?>
			  
              
             <td align="center">
				<a data-rel="tooltip" title="Editar" href="<?=HOME_URI.$this->controller."/editar/".$_item[ID]?>"><button class="btn btn-minier bigger btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a>
			  	
				 <?
				 if($_item[tipo]==3):
				 ?>
				 <button class="btn btn-minier bigger btn-primary" data-rel="tooltip" title="" data-original-title="Cancelado">C</button>
				 <?
				 else:
				 ?> 
				  <a data-rel="tooltip" data-toggle="modal" onClick="$('.removeSell').attr('data-id', '<?=$_item[ID]?>')" title="Cancelar" href="#modal-cancelar"><button class="btn btn-minier bigger btn-danger"><i class="ace-icon fa fa-close bigger-120"></i></button></a>
				 <?
				 endif;
				 ?>
				<a data-rel="tooltip" title="Exportar" href="<?=HOME_URI.$this->controller."/importTransaction/".$_item[ID]?>"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-file-excel-o bigger-120"></i></button></a>
				 <?
				 if($_item[adiar]):
				 ?>
				 <button class="btn btn-minier bigger btn-warning" data-rel="tooltip" title="" data-original-title="Prorrogado">P</button>
				 <?
				 endif;
				 ?>
				 
				 	<button class="btn btn-minier bigger  show-details-btn">
						<a data-rel="tooltip" title="Detalhes" href="#" class="white bigger-140">
							<i class="ace-icon fa fa-angle-double-down"></i>
						</a>
				 
				    </button>
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