<?php
if (!defined('ABSPATH'))
	exit;
$cfg = $this->getConfig();
?>

<script>controller = '<?= $this->controller ?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



	<div class="dt-buttons btn-overlap btn-group">
		<div class="btn-group btn-corner">
			<a href="<?= HOME_URI . $this->controller ?>/adicionar-simcard"
				class="btn btn-success btn-sm filterRegistry filterRegistry"><i class="fa fa-plus bigger-110 "></i> Novo</a>

			<?
			if ($_SESSION['userdata']['grupo'] != 8):
				?>
				<a href="#modal-import-lote" class="btn btn-success btn-sm ic" data-toggle="modal" data-type="2"><i
						class="fa  fa-cloud-upload bigger-110 "></i> Importar Lote SIMCARD</a>
				<a href="#" class="btn btn-warning btn-sm exportCad" data-type="simcard" data-method="all"><i
						class="fa fa-file-excel-o bigger-110 "></i> Exportar</a>
				<a href="#" class="btn btn-warning btn-sm exportCad" data-type="simcard"><i
						class="fa fa-file-excel-o bigger-110 "></i> Exportar Selecionados</a>
				<?
			endif;
			?>
			<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i>
				Filtrar</a>
			<a href="<?= HOME_URI . $this->controller . $this->subController ?>"
				class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
		</div>
	</div>

	<style>

	</style>

	<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid"
		aria-describedby="dynamic-table_info">
		<thead>
			<tr role="row">
				<th class="center" rowspan="1" colspan="1" width="20"><label class="pos-rel"><input type="checkbox"
							class="ace"><span class="lbl"></span></label>
				<th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="simcard"
						value="<?= $_GET['simcard'] ?>"></th>
				<th rowspan="1" colspan="1">Fornecedor<br>
					<select name="fornecedor_simcard" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('fornecedores') as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[fornecedor_simcard] ? 'selected' : '') ?>>
								<?= $option[nome] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>
				<th rowspan="1" colspan="1">Status<br>
					<select name="status_simcard" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('status_simcard') as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[status_simcard] ? 'selected' : '') ?>>
								<?= $option['status'] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>

				<th rowspan="1" colspan="1">Lote<br><input type="text" class="filter" name="lote" value="<?= $_GET[lote] ?>">
				</th>
				<th rowspan="1" colspan="1">Local de Estoque<br>
					<select name="local_estoque" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('local_de_estoque') as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[local_estoque] ? 'selected' : '') ?>>
								<?= $option[local] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>
				<th rowspan="1" width="10" colspan="1">Data<br><input class="form-control date-range date filter" name="data"
						value="<?= $_GET['data'] ?>" type="text" data-date-format="dd/mm/yyyy"></th>
				<th width="20" rowspan="1" colspan="1" align="center">Associação<br></th>
				<th width="20" rowspan="1" colspan="1" align="center">Obs<br></th>
				<th width="120" rowspan="1" colspan="1" align="center">Ações<br></th>
			</tr>
		</thead>

		<tbody>

			<?
			$_attributes = $model->getList('simcard');

			foreach ($_attributes[data] as $_item):
				?>
				<tr role="row" class="odd">
					<td align="center"><label class="pos-rel"><input name="item_id[]" type="checkbox" class="ace item_id"
								value="<?= $_item[ID] ?>"><span class="lbl"></span></label></td>
					<td>

						<a href="<?= HOME_URI ?>transacoes/?iccid=<?= $_item[simcard] ?>">
							<?= $_item[simcard] ?>
						</a>



					</td>
					<td>
						<?= $_item[fornecedor] ?>
					</td>
					<td>
						<?= $_item[status] ?>
					</td>

					<td>
						<?= $_item[lote] ?>
					</td>
					<td>
						<?= $_item[local_estoque] ?>
					</td>
					<td>
						<?= $_item[data] ?>
					</td>
					<td align="center">
						<?= (isset($_item[simcard]) && isset($_item[mdn]) ? '<button class="btn btn-minier bigger btn-success btn-primary" data-rel="tooltip" title="Associado ao MDN ' . $_item[mdn] . '">A</button>' : '') ?>
						<?= ($_item[tipo_uso] == 3 ? '<button class="btn btn-minier bigger btn-primary" data-rel="tooltip" title="Casado com o MDN ' . $_item[mdn] . '">C</button>' : '') ?>
					</td>
					<td>
						<?= ($_item[observacoes] ? '<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="' . $_item[observacoes] . '"><i class="ace-icon fa fa-flag bigger-120"></i></button>' : '') ?>
					</td>
					<td align="center">
						<a href="#" data-rel="tooltip" data-toggle="modal" title="Copiar Código" class="copy"
							data-id="<?= $_item[codigo] ?>"><button class="btn btn-xs"><i
									class="ace-icon fa fa-copy bigger-120"></i></button></a>
						<a href="<?= HOME_URI . $this->controller . "/editar-simcard/" . $_item[ID] ?>"><button
								class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a>
						<a href="#" data-rel="tooltip" data-toggle="modal" title="Excluir" class="delSim"
							data-id="<?= $_item[simcard] ?>"><button class="btn btn-xs btn-danger"><i
									class="ace-icon fa fa-trash bigger-120"></i></button></a>

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
				Total de registros: <strong>
					<?= $_attributes[total] ?>
				</strong></div>
		</div>


		<div class="col-xs-6">
			<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
				<?= $this->pagi($_attributes[total], $_attributes[page]) ?>
			</div>
		</div>


	</div>
</div>


<script>

	$('.copy').on('click', function (a) {

		a.preventDefault()
		a.stopPropagation()

		navigator.clipboard.writeText($(this).data('id')).then();


	})


</script>
