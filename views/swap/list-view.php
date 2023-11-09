<?php 
if ( ! defined('ABSPATH')) exit; 
$cfg = $this->getConfig();
?>

<script>controller='<?=$this->controller?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
    <a href="#modal-swap" class="btn btn-warning btn-sm gswap" data-toggle="modal" data-tipo="1"><i class="fa fa-refresh bigger-110 "></i> Gerar Ativação</a>
	<a href="#modal-swap" class="btn btn-success btn-sm  gswap" data-toggle="modal" data-tipo="2"><i class="fa fa-close bigger-110 "></i> Gerar Desativação</a>
	<a href="<?=HOME_URI.$this->controller?><?=($_GET[todos]?'':'?todos=1')?>" class="btn btn-success btn-sm " data-toggle="modal" data-tipo="2"><i class="fa fa-eye bigger-110 "></i> <?=($_GET[futuros]?'Exibir de Hoje':'Exibir Todos')?></a>
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
</div>
</div>

<style>
			
</style>











<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
		  <input type="hidden" name="future" value="<?=$_GET[futuros]?>">
          </th>
          <th rowspan="1" colspan="1">ID Transação<br><input type="text" class="filter " name="ID" value="<?=$_GET['ID']?>"></th>
          <th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="iccid" value="<?=$_GET['iccid']?>"></th>
          <th rowspan="1" colspan="1">MDN<br><input type="text" class="filter" name="a|mdn" value="<?=$_GET['a|mdn']?>"></th>
          <th rowspan="1" colspan="1">Tipo<br>
			 
			  <select name="tipo" class="col-xs-12 col-sm-12 col-lg-12 filter">
				<option value=""></option>  
				<option value="1" <?=($_GET[tipo]==1?'selected':'')?>>Venda</option>
				<option value="2" <?=($_GET[tipo]==2?'selected':'')?>>Desativação</option>
				<option value="3" <?=($_GET[tipo]==3?'selected':'')?>>Cancelamento</option>
			  </select> 
			  
		  </th>
          <th rowspan="1" colspan="1">Data da Transação<br><input type="text" class="filter date-range date " data-date-format="dd/mm/yyyy" name="data_transacao" value="<?=$_GET['data_transacao']?>"></th>
		  <th rowspan="1" colspan="1">Data de Ativação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy" name="data_ativacao" value="<?=$_GET['data_ativacao']?>"></th>
		  <th rowspan="1" colspan="1">Plano<br>
			<select  name="plano"  class="filter">
					<option value=""></option>
					<?
					 foreach($modelConfig->getOptions('planos') as $option):  
					?>
					<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['plano']?'selected':'')?>><?=$option[nome]?></option>
					<?
					 endforeach;  
					?>
			</select> 		  
		  </th>
          <th rowspan="1" colspan="1">Nome Cliente<br><input type="text" class="filter  " name="a|nome" value="<?=$_GET['a|nome']?>"></th>
	      <th rowspan="1" colspan="1">Tipo de Swap<br>
			  <select name="a|status" class="col-xs-12 col-sm-12 col-lg-12 filter">
				<option value=""></option>  
				<option value="1" <?=($_GET['a|status']==1?'selected':'')?>>Ativação</option>
				<option value="3" <?=($_GET['a|status']==3?'selected':'')?>>Desativação</option>
			  </select> 
		  </th>
         <th></th>
          
          
          
          
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getList();
          
          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
              <td width=""><?=$_item[ID]?></td>
			  <td width=""><a href="<?=HOME_URI?>transacoes/?iccid=<?=$_item[iccid]?>"><?=$_item[iccid]?></a></td>
			  <td width=""><a href="<?=HOME_URI?>transacoes/?a|mdn=<?=$_item[mdn]?>"><?=$_item[mdn]?></a></td>
			  <td width="">
			  <?=($_item[tipo]==1?'Venda':($_item[tipo]==2?'Desativação':'Cancelamento'))?></td>
			  <td width=""><?=$_item[data_transacao]?></td>
			  <td width=""><?=$_item[data_ativacao]?></td>
			  <td width=""><?=$_item[plano]?></td>
			  <td width=""><?=$_item[nome]?></td>
			  <td width=""><?=($_item[tipo_swap])?></td>
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
																				<span><?=$_item[iccid]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor_simcard]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[mdn]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor_mdn]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Plano </div>

																			<div class="profile-info-value">
																				<span><?=$_item[plano]?></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Tipo</div>

																			<div class="profile-info-value">
																				<span><?=($_item[tipo]==1?'Venda':($_item[tipo]==2?'Desatvação':'Cancelamento'))?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> n</div>

																			<div class="profile-info-value">
																				<span><?=($_item[emitir_nota]==1?'s':'')?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Data da Transação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_transacao]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Data da Ativação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_ativacao]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Data Off</div>

																			<div class="profile-info-value">
																				<span><?
			  $d = explode('/', $_item[data_off]);
			  echo date('d/m/Y', mktime(0,0,0, $d[1], $d[0]+$_item[adiar], $d[2]));
			  ?>
			  <?
			  if($_item[adiar]):	  
			  ?>
			  <i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right " data-rel="tooltip" title="Data Original: <?=$_item[data_off]?>"></i>
			  <?
			  endif;	  
			  ?></span>
																			</div>
																		</div>
																		
																		

																		

																	
																		
																	</div>
																</div>
																
																<div class="col-xs-12 col-sm-4">
																	<div class="space visible-xs"></div>
			
																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Atendente</div>

																			<div class="profile-info-value">
																				<span><?=$_item[atendente]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local da Venda </div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_venda]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Ponto de Venda </div>

																			<div class="profile-info-value">
																				<span><?=$_item[ponto_venda]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Nome do Cliente </div>

																			<div class="profile-info-value">
																				<span><?=$_item[nome]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Celular</div>

																			<div class="profile-info-value">
																				<span><?=$_item[celular]?></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> E-mail</div>

																			<div class="profile-info-value">
																				<span><?=$_item[email]?></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Documento</div>

																			<div class="profile-info-value">
																				<span><?=$_item[documento]?></span>
																			</div>
																		</div>
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Local de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_uso]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Dias de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[dias_uso]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Valor do Plano</div>

																			<div class="profile-info-value">
																				<span><?=$_item[valor_plano]?></span>
																			</div>
																		</div>

																	</div>
																</div>
																
																<div class="col-xs-12 col-sm-4">
																	<div class="space visible-xs"></div>
			
																	<div class="profile-user-info profile-user-info-striped">
																		
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Forma de Pagamento </div>

																			<div class="profile-info-value">
																				<span><?=$_item[forma_pagamento]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Moeda </div>

																			<div class="profile-info-value">
																				<span><?=$_item[moeda]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Desconto </div>

																			<div class="profile-info-value">
																				<span><?=$_item[desconto]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Valor Pago</div>

																			<div class="profile-info-value">
																				<span><?=$_item[valor_pago]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Aparelho</div>

																			<div class="profile-info-value">
																				<span><?=$_item[aparelhos]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Países Informados</div>

																			<div class="profile-info-value">
																				<span><?=$_item[paises]?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Lote Ativação</div>

																			<div class="profile-info-value">
																				<span><?=$modelSwap->getLoteAtivacao($_item[ID])?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Lote Desativação</div>

																			<div class="profile-info-value">
																				<span><?=$modelSwap->getLoteDesativacao($_item[ID])?></span>
																			</div>
																		</div>
																		
																		<div class="profile-info-row">
																			<div class="profile-info-name">Observações</div>

																			<div class="profile-info-value">
																				<span><?=$_item[observacao]?></span>
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
		
			
		
		
		
		
	})
</script>
