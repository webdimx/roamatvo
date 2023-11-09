<?php if ( ! defined('ABSPATH')) exit; ?>



<div class="wrap" style="">

<div class="col-sm-7 col-md-7 col-lg-7 ">
	<div class="widget-box">
		<div class="widget-header widget-header-flat widget-header-small">
			<h5 class="widget-title">
				<i class="ace-icon fa fa-signal"></i>
				Transações
			</h5>
			<div class="widget-toolbar no-border">
			
			Período: <input type="text" style="height: 27px;font-size: 13px" class="sell-filter date-range date sel" data-date-format="dd/mm/yyyy" name="data_transacao" value="<?=date('d/m/Y').' - '.date('d/m/Y')?>">
			Tipo: <select name="number" id="number" class="sellType-filter">
					<option  value="todas">Todos</option>
					<option value="transacoes">Transações</option>
					<option value="canceladas">Canceladas</option>
				    <option value="prorrogadas">Prorrogadas</option>
				</select>
			</div>

		</div>

		<div class="widget-body">
			<div class="widget-main sells">
				<div id="monthly-budget-content" style="min-height: 300px"></div>

				

				<div class="clearfix">

				</div>
			</div><!-- /.widget-main -->
		</div><!-- /.widget-body -->
	</div><!-- /.widget-box -->
	
	<div class="widget-box">
		<div class="widget-header widget-header-flat widget-header-small">
			<h5 class="widget-title">
				<i class="ace-icon fa fa-signal"></i>
				Swaps
			</h5>
			
			<div class="widget-toolbar no-border">
				Selecione: <select name="number" id="number" class="swap-filter">
					<option  value="swap/swap">Hoje</option>
					<option value="swap/swap-pendent">Futuros</option>
				</select>
			</div>	

		</div>

		<div class="widget-body">
			<div class="widget-main swap-card" >
				
				<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Fornecedor
																</th>

																<th>
																	Qtd
																</th>

															</tr>
														</thead>

														<tbody class="swapss">
															
															<?
															foreach($model->reportSwap() as $mdn):
															
															
															?>
															<tr class="<?=$mdn[fornecedor_]?>">
																<td><?=$mdn[fornecedor]?></td>
																<td class="badges">
																<span class="badge badge-<?=($mdn[tipo]==1)?'success':'info'?>" data-rel="tooltip" data-placement="left" title="<?=($mdn[tipo]==1)?'Ativação':'Desativação'?>"><?=$mdn[total]?></span>
																</td>
															</tr>
															<?
															endforeach;
															?>
															
															
														</tbody>
													</table>
				
				
			</div><!-- /.widget-main -->
		</div><!-- /.widget-body -->
	</div>
</div>
	

<div class="col-sm-5 col-md-5 col-lg-5 ">
	<div class="widget-box">
		<div class="widget-header widget-header-flat widget-header-small">
			<h5 class="widget-title">
				<i class="ace-icon fa fa-signal"></i>
				SIMCARD
			</h5>
			<div class="widget-toolbar no-border">
				
				Agrupar por: 
											<select name="number" id="number" class="simcard-filter">
											<option  value="simcard/simcards">Fornecedor</option>
											<option value="simcard/simcards_local">Local de Estoque</option>
											
										</select>
				
													
												</div>

		</div>

		<div class="widget-body">
			<div class="widget-main card-simcard">
				<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Fornecedor
																</th>

																<th>
																	Total/Ativos/Estoque
																</th>

															</tr>
														</thead>

														<tbody>
															
															<?
															foreach($model->reportSim() as $mdn):
															?>
															<tr>
																<td><?=$mdn[nome]?></td>
																<td>
																<span class="badge badge-warning"><?=$mdn[total]?></span>
																<span class="badge badge-success"><?=$mdn[ativo]?></span>
																<span class="badge badge-info"><?=$mdn[estoque]?></span>
																</td>
															</tr>
															<?
															endforeach;
															?>
															
															
														</tbody>
													</table>
				
				<div class="widget-footer"><hr style="margin: 5px"><label class="pos-rel"><input name="showAll" type="checkbox" class="ace showAll" value="1"><span class="lbl"></span></label> Mostrar Todos</div>
			</div><!-- /.widget-main -->
		</div><!-- /.widget-body -->
	</div><!-- /.widget-box -->
	
	<div class="widget-box">
		<div class="widget-header widget-header-flat widget-header-small">
			<h5 class="widget-title">
				<i class="ace-icon fa fa-signal"></i>
				MDN
			</h5>


		</div>

		<div class="widget-body">
			<div class="widget-main">
				
				<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Fornecedor
																</th>

																<th>
																Total/Ativos/Estoque	
																</th>

															</tr>
														</thead>

														<tbody>
															
															<?
															foreach($model->reportMdn() as $mdn):
															?>
															<tr>
																<td><?=$mdn[nome]?></td>
																<td>
																	<span class="badge badge-warning"><?=$mdn[total]?></span>
																	<span class="badge badge-success"><?=$mdn[ativo]?></span>
																	<span class="badge badge-info"><?=$mdn[estoque]?></span>
																</td>
															</tr>
															<?
															endforeach;
															?>
															
														</tbody>
													</table>
<div class="widget-footer">Mostrar Todos</div>
				<div class="clearfix">

				</div>
			</div><!-- /.widget-main -->
		</div><!-- /.widget-body -->
	</div>
</div>	

	




</div> <!-- .wrap -->


<script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
<script src="http://www.authenticgoods.co/themes/quantum-pro/demos/assets/vendor/flot/jquery.flot.js"></script>
<script src="http://www.authenticgoods.co/themes/quantum-pro/demos/assets/vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="http://www.authenticgoods.co/themes/quantum-pro/demos/assets/vendor/flot/jquery.flot.resize.js"></script>
<script src="http://www.authenticgoods.co/themes/quantum-pro/demos/assets/vendor/flot/jquery.flot.time.js"></script>
<script src="http://www.authenticgoods.co/themes/quantum-pro/demos/assets/vendor/flot.curvedlines/curvedLines.js"></script>

<script>
	
	$(document).ready(function(){
		
		
		function loader(container){
			
			
			$(container).html('<div class="text-center"><img src="'+ajaxUrl+'views/assets/images/wait.gif"></div>')
			
		}
		
		
		
		
		$('.swap-filter').change(function(){
			
			loader('.swap-card')
			
			$.post(controllerUrl+'getCard', {card: $(this).val()}, function(a){
				
				
				
				$('.swap-card').html(a)
				$('.swapss tr').each(function(){
			
			if($(this).attr('class')==$(this).prev().attr('class')){
			   
				
			   $a = $(this).find('.badge').clone()
			   $(this).prev().find('.badges').append($a)
				
			   $(this).remove()
			}
			
		})
				
			})
			
			
		})
		
		$('.simcard-filter').change(function(){
			
			loader('.card-simcard')
			
			$.post(controllerUrl+'getCard', {card: $(this).val()}, function(a){
				
				$('.card-simcard').html(a)
				
			})
			
			
		})
		
		$('.sellType-filter').change(function(){
			
			loader('#monthly-budget-content')
			
			$.post(controllerUrl+'getCard', {card: 'sells/sells', tipo: $(this).val(), range:$('.sell-filter').val()}, function(a){
				
				$('.sells').html(a)
				
			})
			
			
		})
		
		
		
		$('body').on('click','.applyBtn, .ranges li',function(){
			
			loader('#monthly-budget-content')
			
			$.post(controllerUrl+'getCard', {card: 'sells/sells', tipo: $('.sellType-filter').val(), range:$('.sell-filter').val()}, function(a){
				
				$('.sells').html(a)
				
			})
			
			
		})
		
		
		
	
		
		$('.swapss tr').each(function(){
			
			if($(this).attr('class')==$(this).prev().attr('class')){
			   
				
			   $a = $(this).find('.badge').clone()
			   $(this).prev().find('.badges').append($a)
				
			   $(this).remove()
			}
			
		})
		
		
		$('body').on('click','.showAll', function(){
			
				
		
		if($('.showAll:checked').val()){
			
			_show = $('.showAll').val()
			
			loader('.card-simcard')
			
			$.post(controllerUrl+'getCard', {card: $('.simcard-filter').val(), show: _show}, function(a){
				
				$('.card-simcard').html(a)
				
			})
			
		}
		else
		{
			
			loader('.card-simcard')
			
			$.post(controllerUrl+'getCard', {card: $('.simcard-filter').val()}, function(a){
				
				$('.card-simcard').html(a)
				
			})
			
		}
		
		
	})

	loader('#monthly-budget-content')
		
		$.post(controllerUrl+'getCard', {card: 'sells/sells', tipo: $('.sellType-filter').val(), range: '<?=date('d/m/Y')?> - <?=date('d/m/Y')?>'}, function(a){
				
				$('.sells').html(a)
				
		})
		
		
	})
	
	
	
	
	
	
	
	
</script>

<style>
	select{
		height: auto;
   	 	margin: 2px;
		padding: 2px 5px !important;
	}
	.legend td{padding: 4px;font-size: 13px}
</style>