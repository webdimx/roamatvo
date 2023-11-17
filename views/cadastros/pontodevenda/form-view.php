<?
if ($this->action == 'edit'):
	$data = $this->data[0];


endif;


?>

<div class="widget-box  ui-sortable-handle page-box" id="cliente" style="opacity: 1;">
	<div class="widget-header widget-header-small">
		<h6 class="widget-title">Informações</h6>
	</div>

	<div class="widget-body">
		<div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
			<div class="content">



				<div class="row">

					<div class="col-lg-6 ">
						<p>
							<label class="control-label no-padding-right" for="form-field-1">Ponto:</label><br>
							<input type="text" name="<?= $this->controller ?>[ponto]" class="col-xs-12 col-sm-12 col-lg-12 required"
								value="<?= $data[ponto] ?>">
						</p>
					</div>


					<div class="col-lg-6 ">
						<p>
							<label class="control-label no-padding-right" for="form-field-1">Local de Venda:</label><br>
							<select name="<?= $this->controller ?>[local]" class="col-xs-12 col-sm-12 col-lg-12 required">
								<option value="">Selecione</option>
								<?
								foreach ($modelConfig->getOptions('local_de_venda', true) as $option):
									?>
									<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[local] ? 'selected' : '') ?>>
										<?= $option[local] ?>
									</option>
									<?
								endforeach;
								?>
							</select>
						</p>
					</div>


					<div class="col-xs-6 ">
						<p>


							<label class="control-label no-padding-right" for="form-field-1">É aeroporto?:</label><br>



							<select name="<?= $this->controller ?>[aeroporto]" class="col-xs-12 col-sm-12 col-lg-12">
								<option value="">Selecione</option>

								<option value="1" <?= ($data[aeroporto] ? 'selected' : '') ?>> Sim</option>

							</select>

						</p>
					</div>

					<div class="col-lg-6">
						<p>
							<label class="control-label no-padding-right" for="form-field-1">Observação:</label><br>
							<input type="text" name="<?= $this->controller ?>[observacao]" class="col-xs-12 col-sm-12 col-lg-12"
								maxlength="50" value="<?= $data[observacao] ?>">
						</p>
					</div>


					<div class="col-xs-6 ">
						<p>


							<label class="control-label no-padding-right" for="form-field-1">Situação:</label><br>


							<label>
								<input name="<?= $this->controller ?>[situacao]" type="radio" class="ace" value="1"
									<?= ($data[situacao] == 1 || !$data[situacao] ? 'checked' : '') ?>>
								<span class="lbl"> Ativo</span>
							</label>
							<label>
								<input name="<?= $this->controller ?>[situacao]" type="radio" class="ace" value="2"
									<?= ($data[situacao] == 2 ? 'checked' : '') ?>>
								<span class="lbl"> Inativo</span>
							</label>

						</p>
					</div>



					<p>&nbsp;</p>
					<div class="col-xs-12">
						<?
						if ($this->action):
							?>
							<input type="hidden" name="<?= $this->controller ?>[action]" value="<?= $this->action ?>">
							<input type="hidden" name="<?= $this->controller ?>[ID]" value="<?= $data[ID] ?>">
							<input type="hidden" name="<?= $this->controller ?>[add]" value="">
							<?
						endif;
						?>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>

<script>
	$(document).ready(function () {


		/////



		$('.tipo').change(function () {



			if ($(this).val() != 1) {

				$('.venc').html('Vencimento:')

			}

			else {

				$('.venc').html('Data do Primeiro Vencimento:')


			}


			if ($(this).val() == 2) {

				$('.venc').html('Vencimento:')
				$('.ha').hide()
				$('.ha').find('select, input').val()
				$('.ha').find('select, input').removeClass('required')

			}
			else {

				$('.ha').show()
				$('.ha').find('select, input').val()
				//$('.ha').find('select, input').addClass('required')

			}





		})

		$('.fp').change(function () {


			if ($(this).val() == 2) {

				$('.venc').html('Vencimento:')
				$('.pd').hide()
				$('.pd').find('select, input').val()
				$('.pd').find('select, input').removeClass('required')
			}
			else {

				$('.venc').html('Data do Primeiro Vencimento:')
				$('.pd').show()
				$('.pd').find('select, input').val()
				$('.pd').find('select, input').addClass('required')

			}

		})



	})
</script>
