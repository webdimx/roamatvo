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
<div class="widget-footer"><hr style="margin: 5px"><label class="pos-rel"><input name="showAll" type="checkbox" class="ace showAll" value="1" <?=($_POST[show]?'checked':'')?>><span class="lbl"></span></label> Mostrar Todos</div>