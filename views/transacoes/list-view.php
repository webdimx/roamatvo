<?php
if (!defined('ABSPATH'))
	exit;
$cfg = $this->getConfig();
$_attributes = $model->getList($this->type);
?>

<script>controller = '<?= $this->controller ?>'</script>





<? if ($this->grupo == 8): ?>

	<style>
		.filter {
			display: none
		}

		.hd {
			display: block
		}
	</style>

<? endif; ?>




<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">


	<div class="dt-buttons btn-overlap btn-group">
		<div class="btn-group btn-corner">
			<a href="<?= HOME_URI . $this->controller ?>/adicionar"
				class="btn btn-success btn-sm filterRegistry filterRegistry"><i class="fa fa-plus bigger-110 "></i> Novo</a>
			<a href="#" class="btn btn-primary btn-sm filterRegistry filterRegistry"><i class="fa fa-search bigger-110 "></i>
				Filtrar</a>
			<a href="<?= HOME_URI . $this->controller ?>" class="btn btn-primary btn-sm  clear-filters"><i
					class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
			<a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal">Ok</a>
			<? if (!$this->grupo == 8): ?><a href="#modal-confirm" data-toggle="modal"
					class="btn btn-danger  btn-sm  delete "><i class="fa fa-trash-o "></i> Excluir selecionados</a>
			<? endif; ?>
		</div>
	</div>

	<style>

	</style>
	<div class="table-content">
		<div class="row">
			<div class="">
				<div class="alert alert-info text-right" style="display: block;padding:4px 15px;margin-bottom: 0">
					Total de registros: <strong>
						<?= $_attributes[total] ?>
					</strong></div>
			</div>

		</div>
		<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid"
			aria-describedby="dynamic-table_info">
			<thead>
				<tr role="row">
					<th class="center" rowspan="1" colspan="1" width="20">

					</th>
					<th class="center" rowspan="1" colspan="1" width="20"><label class="pos-rel"><input type="checkbox"
								class="ace"><span class="lbl"></span></label>
						<input type="hidden" value="<?= $this->type ?>" name="type">
					</th>
					<th rowspan="1" colspan="1">Nome do Cliente<br><input type="text" class="filter hd" name="a|nome"
							value="<?= $_GET['a|nome'] ?>"></th>

					<th rowspan="1" colspan="1">Plano<br>

						<select class="filter" name="plano" class="col-xs-12 col-sm-12 col-lg-12 required">
							<option value=""></option>
							<?
							foreach ($modelConfig->getOptions('planos', true) as $option):
								?>
								<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET[plano] ? 'selected' : '') ?>
									data-local="<?= $option[local_uso] ?>">
									<?= $option[nome] ?>
								</option>
								<?
							endforeach;
							?>
						</select>

					</th>

					<th rowspan="1" colspan="1">Continente<br>

						<select class="filter" name="continente" class="col-xs-12 col-sm-12 col-lg-12 required">
							<option value=""></option>
							<?
							foreach ($modelConfig->getOptions('continentes', true) as $option):
								?>
								<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET['continentes'] ? 'selected' : '') ?>
									data-local="<?= $option[nome] ?>">
									<?= $option[nome] ?>
								</option>
								<?
							endforeach;
							?>
						</select>

					</th>



					<th rowspan="1" colspan="1">Consumo Diário<br><input type="text" class="filter id" name="consumo"
							value="<?= $_GET['consumo'] ?>"></th>
					<th rowspan="1" colspan="1">Consumo Total<br><input type="text" class="filter id" name="consumo_total"
							value="<?= $_GET['consumo_total'] ?>"></th>
					<th rowspan="1" colspan="1">Ciclo CM<br><input type="text" class="filter id" name="consumo_total"
							value="<?= $_GET['consumo_total'] ?>"></th>
					<th rowspan="1" colspan="1">Dias<br><input type="text" class="filter id" name="dias_uso"
							value="<?= $_GET['dias_uso'] ?>"></th>
					<th rowspan="1" colspan="1">Data da Transação<br><input type="text" class="filter date-range date"
							data-date-format="dd/mm/yyyy" name="data_transacao" value="<?= $_GET['data_transacao'] ?>"> </th>
					<th rowspan="1" colspan="1">Data da Ativação<br><input type="text" class="filter date-range date"
							data-date-format="dd/mm/yyyy" name="data_ativacao" value="<?= $_GET['data_ativacao'] ?>"> </th>
					<th rowspan="1" colspan="1">Data OFF<br><input type="text" class="filter date date-range "
							data-date-format="dd/mm/yyyy" name="data_off" value="<?= $_GET['data_off'] ?>"></th>
					<th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter hd" name="iccid"
							value="<?= $_GET['iccid'] ?>"></th>
					<th rowspan="1" colspan="1">MDN<br><input type="text" class="filter" name="a|mdn"
							value="<?= $_GET['a|mdn'] ?>"></th>
					<th>
						Fornecedor:<br>
						<select name="a|fornecedor_mdn" class="filter">
							<option value="" <?= ($_GET[fornecedor_mdn] ? '' : '') ?>>Selecione</option>
							<?
							foreach ($modelConfig->getOptions('fornecedores', true, true) as $option):
								?>
								<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $_GET['a|fornecedor_mdn'] ? 'selected' : '') ?>>
									<?= $option[apelido] ?>
								</option>
								<?
							endforeach;
							?>
						</select>
					</th>
					<th rowspan="1" colspan="1">País<br><input type="text" class="filter" name="pais"
							value="<?= $_GET['pais'] ?>"></th>
					<th rowspan="1" colspan="1">Tipo<br>
						<select name="a|ocorrencia" class="filter ">
							<option value="">Selecione</option>
							<option value="1" <?= ($_GET['a|ocorrencia'] == 1 ? 'selected' : '') ?>>Venda</option>
							<option value="2" <?= ($_GET['a|ocorrencia'] == 2 ? 'selected' : '') ?>>Cortesia</option>
						</select>
					</th>

					<th rowspan="1" colspan="1">Origem<br>
						<select name="origem" class="filter ">
							<option value="">Selecione</option>
							<option value="3" <?= ($_GET['origem'] == 3 ? 'selected' : '') ?>>AERO</option>
							<option value="2" <?= ($_GET['origem'] == 2 ? 'selected' : '') ?>>SITE</option>
							<option value="4" <?= ($_GET['origem'] == 4 ? 'selected' : '') ?>>CORP</option>
							<option value="1" <?= ($_GET['origem'] == 1 ? 'selected' : '') ?>>PAINEL</option>
							<option value="5" <?= ($_GET['origem'] == 5 ? 'selected' : '') ?>>HD</option>
						</select>
					</th>



					<th rowspan="1" colspan="1">Status<br>
						<select class="filter" name="a|status" class="col-xs-12 col-sm-12 col-lg-12 required">
							<option value=""></option>
							<option value="1" <?= (1 == $_GET['a|status'] ? 'selected' : '') ?>>ASAT</option>
							<option value="2" <?= (2 == $_GET['a|status'] ? 'selected' : '') ?>>ATVO</option>
							<option value="3" <?= (3 == $_GET['a|status'] ? 'selected' : '') ?>>ASDT</option>
							<option value="4" <?= (4 == $_GET['a|status'] ? 'selected' : '') ?>>DTVO</option>


						</select>
					</th>
					<th rowspan="1" colspan="1">N<br>
						<select class="filter" name="nota_d" class="col-xs-12 col-sm-12 col-lg-12 required">
							<option value=""></option>
							<option value="A" <?= (A == $_GET['nota_d'] ? 'selected' : '') ?>>A</option>
							<option value="S" <?= (S == $_GET['nota_d'] ? 'selected' : '') ?>>S</option>
							<option value="C" <?= (C == $_GET['nota_d'] ? 'selected' : '') ?>>C</option>
						</select>
					</th>



					<th width="80" rowspan="1" colspan="1" align="center">Ações<br></th>





				</tr>
			</thead>

			<tbody>

				<?


				foreach ($_attributes[data] as $_item):
					?>
					<tr role="row" class="odd" <?
					switch ($_item['status']) {


						case "1":


							if ($_item['erro']):

								echo "style='border-left: solid 4px #d15b47;'";

							else:

								echo "style='border-left: solid 4px #428BCA;'";

							endif;


							break;

						case "2":


							echo "style='border-left: solid 4px #87B87F;'";


							break;

						case "3":

							echo "style='border-left: solid 4px #E59729;'";

							break;

						case "4":

							echo "style='border-left: solid 4px #707070;'";

							break;





					}
					?>>
						<td align="center">

							<div class="action-buttons">



								<a data-rel="tooltip" data-ID="<?= $_item[nome] ?>" title="" href="#"
									class="green bigger-140 show-details-btn" data-original-title="Detalhes">
									<i class="ace-icon fa fa-angle-double-down"></i>
									<span class="sr-only">Details</span>
								</a>


							</div>

							<span class="lbl"></span></label>
						</td>
						<td align="center"><label class="pos-rel"><input name="item_id[]" type="checkbox" class="ace item_id"
									value="<?= $_item[ID] ?>"><span class="lbl"></span></label></td>
						<td>
							<?= $_item[nome] ?>
						</td>
						<td>
							<?= $_item[plano] ?>
						</td>
						<td>
							<?= $_item[continente] ?>
						</td>
						<td>
							<?= $_item[consumo] ?>
						</td>
						<td>
							<?= $_item[consumo_total] ?>
						</td>
						<td>
							<?= $_item[data_live] ?>
						</td>
						<td>
							<?= $_item[dias_uso] ?>
						</td>
						<td>
							<?= $_item[data_transacao] ?>
						</td>
						<td>
							<?= $_item[data_ativacao] ?>
						</td>
						<td>
							<?
							$d = explode('/', $_item[data_off]);
							echo date('d/m/Y', mktime(0, 0, 0, $d[1], $d[0] + $_item[adiar], $d[2]));
							?>
							<?
							if ($_item[adiar]):
								?>
								<i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right " data-rel="tooltip"
									title="Data Original: <?= $_item[data_off] ?>"></i>
								<?
							endif;
							?>
						</td>
						<td><a href="<?= HOME_URI ?>transacoes/?iccid=<?= $_item[iccid] ?>">
								<?= $_item[iccid] ?>
							</a>



						</td>
						<td><a href="<?= HOME_URI ?>transacoes/?a|mdn=<?= $_item[mdn] ?>">
								<?= $_item[mdn] ?>
							</a></td>
						<td>
							<?= $_item[fornecedor_alias] ?>
						</td>
						<td>
							<?= $_item[pais] ?>
						</td>
						<td>
							<?= ($_item[ocorrencia] == 1 ? 'Venda' : 'Cortesia') ?>
						</td>


						<? //($_item[origem]==2?$_item[ponto_venda]:($_item[origem]==4?$_item[ponto_venda]:$_item[detalhe]))?>
						<td>
							<?= ($_item[origem] == 2 ? $_item[ponto_venda] : ($_item[origem] == 4 ? $_item[ponto_venda] : $_item[detalhe])) ?>
						</td>
						<td>

							<?
							switch ($_item[status]):

								case "1":
									echo 'ASAT';
									break;

								case "2":
									echo 'ATVO';
									break;

								case "3":
									echo 'ASDT';
									break;

								case "4":
									echo 'DTVO';
									break;



							endswitch;
							?>
						</td>
						<td width="20px">
							<?= ($_item[emitir_nota] == 1 ? 'S' : ($_item[emitir_nota] == 3 ? 'C' : '')) ?>
						</td>

						<td align="center">

							<div class="btn-group">


								<button data-toggle="dropdown" class="btn btn-info btn-white dropdown-toggle" aria-expanded="false"
									style="width: 50px">
									<span class="ace-icon fa fa-caret-down icon-only"></span>
								</button>

								<ul class="dropdown-menu dropdown-info dropdown-menu-right">
									<li>
										<a href="<?= HOME_URI . $this->controller . "/editar/" . $_item[ID] ?>">Editar</a>
									</li>

									<li>
										<a data-rel="tooltip" data-toggle="modal"
											onClick="$('.removeSell').attr('data-id', '<?= $_item[ID] ?>')" title="Cancelar"
											href="#modal-cancelar">Cancelar</a>
									</li>

									<li>
										<a href="<?= HOME_URI . $this->controller . "/importTransaction/" . $_item[ID] ?>">Exportar</a>
									</li>

									<li>
										<a href="#" class="sendToHD" data-id="<?= $_item[ID] ?>">Enviar para HelpDesk</a>
									</li>

									<li>
										<a href="#" class="sendToRe" data-id="<?= $_item[ID] ?>">Enviar para Reembolso</a>
									</li>
								</ul>
							</div>

							<hr style="margin: 3px 0">

							<!--<a data-rel="tooltip" title="Editar" href="<?= HOME_URI . $this->controller . "/editar/" . $_item[ID] ?>"><button class="btn btn-minier bigger btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button></a>-->

							<?
							if ($_item[tipo] == 3):
								?>
								<button class="btn btn-minier bigger btn-primary" data-rel="tooltip" title=""
									data-original-title="Cancelado por <?= $_item[responsavel_cancelamento] ?>">C</button>
								<?
							endif;
							?>

							<!-- <a data-rel="tooltip" data-toggle="modal" onClick="$('.removeSell').attr('data-id', '<?= $_item[ID] ?>')" title="Cancelar" href="#modal-cancelar"><button class="btn btn-minier bigger btn-danger"><i class="ace-icon fa fa-close bigger-120"></i></button></a>

				 <a data-rel="tooltip" title="Exportar" href="<?= HOME_URI . $this->controller . "/importTransaction/" . $_item[ID] ?>"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-file-excel-o bigger-120"></i></button></a>-->


							<?
							if ($_item[adiar]):
								?>
								<button class="btn btn-minier bigger btn-warning" data-rel="tooltip" title=""
									data-original-title="Prorrogado">P</button>
								<?
							endif;
							?>

							<?
							if ($_item[helpdesk] == 2):
								?>
								<a href="<?= HOME_URI . "/helpdesk/?a|ID=" . $_item[ID] ?>"><button class="btn btn-minier bigger btn-info"
										data-rel="tooltip" title="" data-original-title="HelpDesk">H</button></a>
								<?
							endif;
							?>

							<?
							if ($_item[reembolso] == 2):
								?>
								<a href="<?= HOME_URI . "/reembolso/?a|ID=" . $_item[ID] ?>"><button
										class="btn btn-minier bigger btn-success" data-rel="tooltip" title=""
										data-original-title="Reembolso">R</button></a>
								<?
							endif;
							?>





						</td>

					</tr>

					<tr class="detail-row">
						<td colspan="20">
							<div class="table-detail">
								<div class="row">


									<div class="col-xs-12 col-sm-4">
										<div class="space visible-xs"></div>

										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> SIMCARD </div>

												<div class="profile-info-value">
													<span><a href="<?= HOME_URI ?>transacoes/?iccid=<?= $_item[iccid] ?>">
															<?= $_item[iccid] ?>
														</a></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Fornecedor SIMCARD </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[fornecedor_simcard] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> MDN </div>

												<div class="profile-info-value">
													<span><a href="<?= HOME_URI ?>transacoes/?a|mdn=<?= $_item[mdn] ?>">
															<?= $_item[mdn] ?>
														</a></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Fornecedor MDN </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[fornecedor_mdn] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Plano </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[plano] ?>
													</span>
												</div>
											</div>


											<div class="profile-info-row">
												<div class="profile-info-name"> Tipo</div>

												<div class="profile-info-value">
													<span>
														<?= ($_item[ocorrencia] == 1 ? 'Venda' : ($_item[ocorrencia] == 2 ? 'Cortesia' : '')) ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">n</div>

												<div class="profile-info-value">
													<span>
														<?= ($_item[emitir_nota] == 1 ? 's' : '') ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Data da Transação</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[data_transacao] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Data da Ativação</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[data_ativacao] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Data Off</div>

												<div class="profile-info-value">
													<span>
														<?
														$d = explode('/', $_item[data_off]);
														echo date('d/m/Y', mktime(0, 0, 0, $d[1], $d[0] + $_item[adiar], $d[2]));
														?>
														<?
														if ($_item[adiar]):
															?>
															<i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right "
																data-rel="tooltip" title="Data Original: <?= $_item[data_off] ?>"></i>
															<?
														endif;
														?>
													</span>
												</div>
											</div>



											<div class="profile-info-row">
												<div class="profile-info-name"> Local da Venda </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[local_venda] ?>
													</span>
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
													<span>
														<?= $_item[atendente] ?>
													</span>
												</div>
											</div>



											<div class="profile-info-row">
												<div class="profile-info-name"> Ponto de Venda/Entrega </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[ponto_venda] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Nome do Cliente </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[nome] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Celular</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[celular] ?>
													</span>
												</div>
											</div>


											<div class="profile-info-row">
												<div class="profile-info-name"> E-mail</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[email] ?>
													</span>
												</div>
											</div>


											<div class="profile-info-row">
												<div class="profile-info-name">Documento</div>

												<div class="profile-info-value">
													<span>
														<?= formatCnpjCpf($_item[documento]) ?>
													</span>
												</div>
											</div>


											<div class="profile-info-row">
												<div class="profile-info-name">Local de Uso</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[local_uso] ?>
													</span>
												</div>
											</div>



											<div class="profile-info-row">
												<div class="profile-info-name"> Valor do Plano</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[valor_plano] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Desconto do Plano</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[desconto_plano] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Valor Final do Plano</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[final_plano] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> ERRO API</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[erro] ?>
													</span>
												</div>
											</div>

										</div>
									</div>

									<div class="col-xs-12 col-sm-4">
										<div class="space visible-xs"></div>

										<div class="profile-user-info profile-user-info-striped">

											<div class="profile-info-row">
												<div class="profile-info-name"> Dias de Uso</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[dias_uso] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Forma de Pagamento </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[forma_pagamento] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Moeda </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[moeda] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Desconto </div>

												<div class="profile-info-value">
													<span>
														<?= $_item[desconto] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Valor Pago</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[valor_pago] ?>
													</span>
												</div>
											</div>



											<div class="profile-info-row">
												<div class="profile-info-name">Aparelho</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[aparelhos] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Países Informados</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[paises] ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Países Visitados</div>

												<div class="profile-info-value">
													<span>
														<?= implode(', ', unserialize($_item[paises_visitados])) ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Lote Ativação</div>

												<div class="profile-info-value">
													<span>
														<?= $modelSwap->getLoteAtivacao($_item[ID]) ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Lote Desativação</div>

												<div class="profile-info-value">
													<span>
														<?= $modelSwap->getLoteDesativacao($_item[ID]) ?>
													</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Observações</div>

												<div class="profile-info-value">
													<span>
														<?= $_item[observacao] ?>
													</span>
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
</div>

<script>

	$(window).load(function () {

		$('.table-content').mCustomScrollbar({ axis: "x", theme: "inset-2-dark", mouseWheel: false })

	})

	$(document).ready(function () {

		$('.sendToHD').click(function (a) {


			a.preventDefault()

			$.post(controllerUrl + 'sendTo', { id: $(this).data('id'), to: 'HD' }, function (a) {

				if (a) {

					$alert('Transação Enviada para o HelpDesk com sucesso!')

				}

			})




		})


		$('.sendToRe').click(function (a) {

			a.preventDefault()

			$.post(controllerUrl + 'sendTo', { id: $(this).data('id'), to: 'RE' }, function (a) {

				if (a) {

					$alert('Transação Enviada para o Reembolso com sucesso!')

				}

			})

		})

		$('.date-pickers').datepicker().on('changeDate', function (e) {

			$('.filterRegistry').trigger('click')

		});

		$('.date-pickers').datepicker({


			autoclose: true,
			todayHighlight: true,


		})




		$('input[name=file]').change(function (a) {


			if ($(this).val()) {
				files = a.target.files;
			}



			var $data = new FormData();

			$.each(files, function (key, value) {
				$data.append(key, value);

			});


			var dados = new FormData(this);




			$.ajax({
				url: controllerUrl + 'retorno',
				type: 'POST',
				data: $data,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				success: function (data, textStatus, jqXHR) {

					$('.returnModal').trigger('click')

				},
				error: function (jqXHR, textStatus, errorThrown) {
					// Em caso de erro
				}
			});

			console.log(files[0])

		})

		function $alert(msg) {

			$('#modal-alert .modal-body').html(msg)
			$('#modal-alert').modal('show');


		}

		$('.show-details-btn').click(function () {


			$.get(controllerUrl + 'getDetails', { ID: $(this).data('id') }, function () {




			})


		})

	})
</script>
