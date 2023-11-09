<?php if ( ! defined('ABSPATH')) exit; ?>



				
				<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th>
									<i class="ace-icon fa fa-caret-right blue"></i> Fornecedor
								</th>

								<th>
									Qtd
								</th>

							</tr>
						</thead>

						<tbody class="swaps">

							<?
							foreach($model->reportSwap('true') as $mdn):
							?>
							<tr>
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
				