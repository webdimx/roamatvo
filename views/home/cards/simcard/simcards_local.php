<table class="table table-bordered table-striped">
<thead class="thin-border-bottom">
	<tr>
		<th>
			<i class="ace-icon fa fa-caret-right blue"></i>Fornecedor
		</th>
		<th>
			<i class="ace-icon fa fa-caret-right blue"></i>Local
		<th>
			Qtd
		</th>

	</tr>
</thead>

<tbody>

	<?
	foreach($model->reportSim('true') as $mdn):
	?>
	<tr>
		<td><?=$mdn[fornecedor]?></td>
		<td><?=$mdn[local]?></td>
		<td>
		<span class="badge badge-success"><?=$mdn[total]?></span>
		</td>
	</tr>
	<?
	endforeach;
	?>


</tbody>
</table>