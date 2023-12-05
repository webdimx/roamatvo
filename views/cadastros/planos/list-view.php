<?php
if (!defined('ABSPATH'))
	exit;
$cfg = $this->getConfig();
?>

<script>controller = '<?= $this->controller ?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">

	<div class="dt-buttons btn-overlap btn-group">
		<div class="btn-group btn-corner">
			<a href="<?= HOME_URI . $this->controller ?>/adicionar-plano"
				class="btn btn-success btn-sm filterRegistry filterRegistry"><i class="fa fa-plus bigger-110 "></i> Novo</a>
			<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i>
				Filtrar</a>
			<a href="<?= HOME_URI . $this->controller . $this->subController ?>"
				class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
			<a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal">Ok</a>
			<a href="#modal-confirm" data-toggle="modal" data-table="wd_planos" class="btn btn-danger  btn-sm  delete "><i
					class="fa fa-trash-o "></i> Excluir selecionados</a>
		</div>
	</div>

	<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid"
		aria-describedby="dynamic-table_info">
		<thead>
			<tr role="row">
				<th class="center" rowspan="1" colspan="1" width="20"><label class="pos-rel"><input type="checkbox"
							class="ace"><span class="lbl"></span></label>
					<input type="hidden" value="<?= $this->type ?>" name="type">
				</th>
				<th rowspan="1" colspan="1">Nome<br><input type="text" class="filter" name=a|nome
						value="<?= $_GET['a|nome'] ?>"></th>
				<th rowspan="1" colspan="1">Código<br><input type="text" class="filter" name="codigo_plano"
				value="<?= $_GET['codigo_plano'] ?>"></th>
				<th rowspan="1" colspan="1">Situação<br>
					<select name="a|situacao" class="filter">
						<option value=""></option>
						<option value="1" <?= ($_GET[situacao] == 1 ? 'selected' : '') ?>>Ativo</option>
						<option value="2" <?= ($_GET[situacao] == 2 ? 'selected' : '') ?>>Inativo</option>
					</select>
				</th>
				<th rowspan="1" colspan="1">Valor(USD)<br><input type="text" class="filter moneyUSD" name="valor"
						value="<?= $_GET[valor] ?>"></th>
				<th rowspan="1" colspan="1">Qtd de Dias<br><input type="text" class="filter" name="qtd_dias"
						value="<?= $_GET['qtd_dias'] ?>"></th>
				<th rowspan="1" colspan="1">Continente<br>
					<select name="continente" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('continentes', true) as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET['a|ID'] ? 'selected' : '') ?>>
								<?= $option[nome] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>

				<th rowspan="1" colspan="1">País<br>
					<select name="b|ID" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('paises', true) as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET['b|ID'] ? 'selected' : '') ?>>
								<?= $option[nome] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>

				<th rowspan="1" colspan="1">Preferêncial<br>
					<select name="preferencial" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('plano_opcoes', true) as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[nome] ? 'selected' : '') ?>>
								<?= $option[nome] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>

				<th rowspan="1" colspan="1">Fornecedor Indicado<br>
					<select name="fornecedor" class="filter">
						<option value=""></option>
						<?
						foreach ($modelConfig->getOptions('fornecedores', true) as $option):
							?>
							<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[nome] ? 'selected' : '') ?>>
								<?= $option[nome] ?>
							</option>
							<?
						endforeach;
						?>
					</select>
				</th>

				<th rowspan="1" colspan="1" width="20">Obs.<br>&nbsp;</th>
				<th width="20" rowspan="1" colspan="1" align="center">Ações<br>&nbsp;</th>
			</tr>
		</thead>

		<tbody>

			<?
			$_attributes = $model->getList('planos');

			foreach ($_attributes[data] as $_item):
				?>
				<tr role="row" class="odd">
					<td align="center"><label class="pos-rel"><input name="item_id[]" type="checkbox" class="ace item_id"
								value="<?= $_item[ID] ?>"><span class="lbl"></span></label></td>
					<td>
						<?= $_item[nome] ?>
					</td>
					<td>
						<?= $_item[codigo_plano] ?>
					</td>
					<td>
						<?= ($_item[situacao] == 1 ? 'Ativo' : 'Inativo') ?>
					</td>
					<td>
						<?= $_item[valor] ?>
					</td>
					<td>
						<?= $_item[qtd_dias] ?>
					</td>
					<td>
						<?= $_item[continente] ?>
					</td>
					<td>
						<?= $_item[pais] ?>
					</td>
					<td>
						<?= $_item[preferencial] ?>
					</td>
					<td>
						<?= $_item[fornecedor] ?>
					</td>
					<td>
						<?= ($_item[observacao] ? '<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="' . $_item[observacao] . '"><i class="ace-icon fa fa-flag bigger-120"></i></button>' : '') ?>
					</td>
					<td align="center"><a href="<?= HOME_URI . $this->controller . "/editar-plano/" . $_item[ID] ?>"><button
								class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a></td>
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

	$(document).ready(function () {

		$()

		$('.date-pickers').datepicker().on('changeDate', function (e) {

			$('.filterRegistry').trigger('click')

		});

		$('.date-pickers').datepicker({


			autoclose: true,
			todayHighlight: true,


		})

	})
</script>
