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

					<div class="col-lg-12 ">
						<p>
							<label class="control-label no-padding-right" for="form-field-1">Local:</label><br>
							<input type="text" name="<?= $this->controller ?>[local]" class="col-xs-12 col-sm-12 col-lg-12 required"
								value="<?= $data[nome] ?>">
						</p>
					</div>



					<div class="col-lg-12 ">
						<p>
							<label class="control-label no-padding-right" for="form-field-1">Código:</label><br>
							<input type="text" name="<?= $this->controller ?>[codigo]" class="col-xs-12 col-sm-12 col-lg-12 required"
								value="<?= $data[codigo] ?>">
						</p>
					</div>

					<div class="col-xs-12 ">
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



					<div class="col-lg-12">
						<p>
							<label class="control-label no-padding-right" for="form-field-1">Observação:</label><br>
							<input type="text" name="<?= $this->controller ?>[observacao]" class="col-xs-12 col-sm-12 col-lg-12"
								maxlength="50" value="<?= $data[observacao] ?>">
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
