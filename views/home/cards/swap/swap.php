<?php if ( ! defined('ABSPATH')) exit; ?>


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


<script>

	$(document).ready(function(){
		
		
		
		
		$('.swapss tr').each(function(){
			
			if($(this).attr('class')==$(this).prev().attr('class')){
			   
				
			   $a = $(this).find('.badge').clone()
			   $(this).prev().find('.badges').append($a)
				
			   $(this).remove()
			}
			
		})
		
		
	})

</script>