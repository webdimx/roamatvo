<?php
if (!defined('ABSPATH'))
	exit;
$cfg = $this->getConfig();
$_attributes = $model->sellReport($this->tipo);
?>

<script>controller='<?= $this->controller ?>'</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">


<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
	<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
		<a href="<?= HOME_URI . $this->controller ?>/vouchers/<?= $this->tipo ?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
		<a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>
	<a href="<?= HOME_URI . $this->controller ?>/exportReportVouchers/<?= $this->tipo ?>?<?= str_replace('path=relatorios/vouchers/' . ($this->tipo == 'site' ? 'site' : 'corp'), '', $_SERVER['QUERY_STRING']) ?>"  class="btn btn-success   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar</a>
	<a href="<?= HOME_URI . $this->controller ?>/exportReportVouchers/<?= $this->tipo ?>?<?= str_replace('path=relatorios/vouchers/' . ($this->tipo == 'site' ? 'site' : 'corp'), '', $_SERVER['QUERY_STRING']) ?>"  class="btn btn-success exportSel   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar Selecionados</a>
</div>
</div>

<style>

</style>

<div class="table-content">
<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
			<thead>
					<tr role="row">

					<th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
					<input type="hidden" value="<?= $this->type ?>" name="type">
					</th>

			<th rowspan="1" colspan="1">Data Compra<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_compra" value="<?= $_GET['data_compra'] ?>"></th>
				<th rowspan="1" colspan="1">Status<br>

			<select name="a|status" class="filter">

			<option value="">Selecione</option>
			<option value="1" <?= ("1" == $_GET['a|status'] ? 'selected' : '') ?>>Ativo</option>
			<option value="2" <?= (2 == $_GET['a|status'] ? 'selected' : '') ?>>Cancelado</option>


			</select>

			</th>
				<th rowspan="1" colspan="1">Resgatado<br>

			<select name="resgatado" class="filter">

			<option value="">Selecione</option>
			<option value="1" <?= ("1" == $_GET[resgatado] ? 'selected' : '') ?>>Não</option>
			<option value="2" <?= (2 == $_GET[resgatado] ? 'selected' : '') ?>>Sim</option>


			</select>

			</th>
			<th rowspan="1" colspan="1">Cod. Referência<br><input type="text" class="filter" name="cod_referencia" value="<?= $_GET['cod_referencia'] ?>"></th>
			<th rowspan="1" colspan="1">Meio de Pagamento<br>
			<select name="a|forma_pagamento" class="filter">

			<option value="">Selecione</option>
			<?
			foreach ($_attributes[fp] as $forma):
				?>
				 <option value="<?= $forma[forma_pagamento] ?>" <?= ($forma[forma_pagamento] == $_GET['a|forma_pagamento'] ? 'selected' : '') ?> ><?= ucfirst($forma[forma_pagamento]) ?></option>
				<?
			endforeach;
			?>


			</select>

			<th rowspan="1" colspan="1">Vendedor<br><input type="text" class="filter" name="vendedor" value="<?= $_GET['vendedor'] ?>"></th>
			<th rowspan="1" colspan="1">Vendedor Responsável<br><input type="text" class="filter" name="vendedor_responsavel" value="<?= $_GET['vendedor_responsavel'] ?>"></th>

			<th rowspan="1" colspan="1">Opção de Retirada<br>
			<select name="sedex" class="filter">

			<option value="">Selecione</option>
			<option value="1" <?= (1 == $_GET[sedex] ? 'selected' : '') ?>>Sedex</option>
			<option value="0" <?= ('0' == $_GET[sedex] ? 'selected' : '') ?>>Retirada no Quiosque</option>



			</select>
			</th>
			<th rowspan="1" colspan="1">Voucher<br><input type="text" class="filter" name="a|voucher" value="<?= $_GET['a|voucher'] ?>"></th>
			<th rowspan="1" colspan="1">Nome do Cliente<br><input type="text" class="filter" name="a|nome" value="<?= $_GET['a|nome'] ?>"></th>
			<th rowspan="1" colspan="1">Email<br><input type="text" class="filter" name="a|email" value="<?= $_GET['a|email'] ?>"></th>
			<th rowspan="1" colspan="1">Documento<br><input type="text" class="filter" name="a|cpf" value="<?= $_GET['a|cpf'] ?>"></th>
			<th rowspan="1" colspan="1">Cupom Utilizado<br><input type="text" class="filter" name="cupom" value="<?= $_GET['cupom'] ?>"></th>
			<th rowspan="1" colspan="1">Plano<br>
			<select  class="filter"  name="a|plano"   class="col-xs-12 col-sm-12 col-lg-12 required">
		<option value="">Selecione</option>
		<?
		foreach ($modelConfig->getOptions('planos', true) as $option):
			?>
			<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET['a|plano'] ? 'selected' : '') ?> data-local="<?= $option[local_uso] ?>"> <?= $option[nome] ?></option>
			<?
		endforeach;
		?>
		 </select>
			</th>
			<th rowspan="1" colspan="1">Valor Original<br><input type="text" class="filter" name="valor_original" value="<?= $_GET['valor_original'] ?>"></th>
			<th rowspan="1" colspan="1">Valor Base U$<br><input type="text" class="filter" name="valor_base" value="<?= $_GET['valor_base'] ?>"></th>
			<th rowspan="1" colspan="1">Valor Base R$<br><input type="text" class="filter  money" name="valor_base_real" value="<?= $_GET['valor_base_real'] ?>"></th>
			<th rowspan="1" colspan="1">Cotação<br><input type="text" class="filter" name="valor_dolar" value="<?= $_GET['valor_dolar'] ?>"></th>
			<th rowspan="1" colspan="1">Valor Total R$<br><input type="text" class="filter" name="valor_total_real" value="<?= $_GET['valor_total_real'] ?>"></th>
					<th rowspan="1" colspan="1">Valor Total U$<br><input type="text" class="filter" name="valor_total_dolar" value="<?= $_GET['valor_total_dolar'] ?>"></th>
			<th rowspan="1" colspan="1">Valor Frete<br><input type="text" class="filter" name="valor_frete" value="<?= $_GET['valor_frete'] ?>"></th>
			<th rowspan="1" colspan="1">Valor Venda R$<br><input type="text" class="filter" name="valor_venda_real" value="<?= $_GET['valor_venda_real'] ?>"></th>
			<th rowspan="1" colspan="1">Valor Venda U$<br><input type="text" class="filter" name="valor_venda_dolar" value="<?= $_GET['valor_venda_dolar'] ?>"></th>
			<th rowspan="1" colspan="1">Gateway<br>
			<select name="gateway" class="filter">

			<option value="">Selecione</option>
			<option value="PagSeguro" <?= ('PagSeguro' == $_GET[gateway] ? 'selected' : '') ?>>Pagseguro</option>
			<option value="AuthorizeNet" <?= ('AuthorizeNet' == $_GET[gateway] ? 'selected' : '') ?>>AuthorizeNet</option>
			<option value="Faturada" <?= ('Faturada' == $_GET[gateway] ? 'selected' : '') ?>>Faturada</option>

			</select>
			</th>
			<th rowspan="1" colspan="1">Valor a Receber<br><input type="text" class="filter" name="valor_receber" value="<?= $_GET['valor_receber'] ?>"></th>
			<th rowspan="1" colspan="1">Valor de Repasse<br><input type="text" class="filter" name="valor_venda" value="<?= $_GET['valor_venda'] ?>"></th>

			<th rowspan="1" colspan="1">Status do Pagamento<br>

			<select name="status_compra" class="filter">

			<option value="">Selecione</option>
			<option value="1" <?= (1 == $_GET[status_compra] ? 'selected' : '') ?>>Aguardando Pagamento</option>
			<option value="2" <?= (2 == $_GET[status_compra] ? 'selected' : '') ?>>Em análise</option>
			<option value="3" <?= (3 == $_GET[status_compra] ? 'selected' : '') ?>>Paga</option>
			<option value="4" <?= (4 == $_GET[status_compra] ? 'selected' : '') ?>>Disponível</option>
			<option value="6" <?= (6 == $_GET[status_compra] ? 'selected' : '') ?>>Devolvida</option>
			<option value="7" <?= (7 == $_GET[status_compra] ? 'selected' : '') ?>>Cancelada</option>
			<option value="10" <?= (10 == $_GET[status_compra] ? 'selected' : '') ?>>Compra Faturada</option>

			</select>
			</th>
			<th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="simcard" value="<?= $_GET['simcard'] ?>"></th>
			<th rowspan="1" colspan="1">Data de Retirada<br><input type="text"  class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_retirada" value="<?= $_GET['data_retirada'] ?>"></th>
			<th rowspan="1" colspan="1">Ponto de Entrega<br>
			<select  name="ponto_entrega"  class="filter">
				<option value="">Selecione</option>
				<?
				foreach ($modelConfig->getOptions('ponto_de_venda') as $option):
					?>
					<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[ponto_entrega] ? 'selected' : '') ?>><?= $option[ponto] ?></option>
					<?
				endforeach;
				?>
			</select>

			</th>

			<th rowspan="1" colspan="1">Atendente<br>
			<select  name="x|atendente"  class="filter">
				<option value="">Selecione</option>
				<?
				foreach ($modelConfig->getOptions('atendentes') as $option):
					?>
					<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET['x|atendente'] ? 'selected' : '') ?>><?= $option[nome] ?></option>
					<?
				endforeach;
				?>
			</select>

			</th>

			<th rowspan="1" colspan="1">Ações</th>


					</tr>
			</thead>

			<tbody>

					<?


					foreach ($_attributes[data] as $_item):
						?>
						<tr role="row" class="odd">
								<td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?= $_item[ID] ?>"><span class="lbl"></span></label></td>
								<td><?= $_item[data_compra] ?></td>
					<td><?= ($_item[status] == 1 ? 'Ativo' : 'Cancelado') ?></td>
					<td><?= ($_item[resgatado] == 2 ? 'Sim' : 'Não') ?></td>

					<td><?= $_item[cod_referencia] ?></td>
					<td><?= $_item[forma_pagamento] ?></td>
					<td><?= ($_item[vendedor] ? $_item[vendedor] : 'Site') ?></td>
					<td><?= ($_item[vendedor_responsavel]) ?></td>
					<td><?= $_item[retirada] ?></td>
					<td><?= $_item[voucher] ?></td>
					<td><?= $_item[nome] ?></td>
					<td><?= $_item[email] ?></td>
					<td><?= $_item[cpf] ?></td>
					<td><?= $_item[cupom] ?></td>
					<td><?= $_item[plano] ?></td>
					<td><?= $_item[valor_plano] ?></td>
					<td><?= $_item[valor_base] ?></td>
					<td><?= $_item[valor_base_real] ?></td>
					<td><?= $_item[valor_dolar] ?></td>
					<td><?= $_item[valor_total_real] ?></td>
					<td><?= $_item[valor_total_dolar] ?></td>
					<td><?= $_item[valor_frete] ?></td>
					<td><?= $_item[valor_venda_real] ?></td>
					<td><?= $_item[valor_venda_dolar] ?></td>

					<td><?= ($_item[gateway] ? $_item[gateway] : 'Faturado') ?></td>
					<td><?= $_item[valor_receber] ?></td>
					<td><?= $_item[valor_repasse] ?></td>
					<td>
						<?

						switch ($_item[status_compra]):

							case 1:

								echo "Aguardando Pagamento";

								break;

							case 2:

								echo "Em análise";

								break;


							case 3:

								echo "Paga";

								break;

							case 4:

								echo "Disponível";

								break;

							case 6:

								echo "Devolvida";

								break;


							case 7:

								echo "Cancelada";

								break;

							case 10:

								echo "Compra Faturada";

								break;


						endswitch;

						?>
						</td>


					<td><?= $_item[simcard] ?></td>
					<td><?= $_item[data_retirada] ?></td>
					<td><?= $_item[ponto_venda] ?></td>
					<td><?= $_item[atendente] ?></td>
					<td align="center">

					<a data-rel="tooltip" title="Exportar" href="<?= HOME_URI . $this->controller . "/importTransactionVoucher/" . $_item[ID] ?>"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-file-excel-o bigger-120"></i></button></a>

					<? if ($_item[id_venda]): ?>
						<a data-rel="tooltip" title="Exibir venda no sistema" href="<?= HOME_URI . "/transacoes/?id_skillsim=" . $_item[id_venda] ?>"><button class="btn btn-minier bigger btn-info"><i class="ace-icon fa fa-usd bigger-120"></i></button></a>
						<?
					endif;
					?>
					</td>
						</tr>




						<?
					endforeach;
					?>
		 </tbody>
</table>
	</div>
<div class="row">
<div class="col-xs-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
Total de registros: <strong><?= $_attributes[total] ?></strong></div>
</div>


<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
<?= $this->pagi($_attributes[total], $_attributes[page]) ?>
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

	$(window).load(function(){

		$('.table-content').mCustomScrollbar({axis:"x", theme:"inset-2-dark",mouseWheel:false})

	})
</script>
