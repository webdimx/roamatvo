<?
if ($this->action == 'edit'):
	$data = $this->data[0];
endif;
?>

<div class="widget-box  page-box" id="cliente" style="opacity: 1;">
		<div class="widget-header widget-header-small">
				<h6 class="widget-title">Informações</h6>
		</div>

		<div class="widget-body">
				<div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
						<div class="content">



							<div class="row">

				<div class="col-lg-5ths   hidden-lg hidden-sm">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Foto da Venda:</label><br>
									<input type="file" id="id-input-file-2" name="file" data-path="professores" data-field="professores" value="<?= $data['foto'] ?>" />
								</p>
							</div>

				<div class="col-lg-5ths ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">SIMCARD/ICCID:</label><br>


					<input type="text"  name="<?= $this->controller ?>[iccid]"  class="col-xs-12 col-sm-12 col-lg-12 auto-complete  required" value="<?= $data[iccid] ?>">
					<div class="ui-widget-content"></div>

								</p>
							</div>

				<div class="col-lg-5ths ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Fornecedor do SIMCARD:</label><br>
									<select  name="<?= $this->controller ?>[fornecedor_simcard]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('fornecedores', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[fornecedor_simcard] ? 'selected' : '') ?> > <?= $option[nome] ?></option>
						<?
					endforeach;
					?>
					</select>

								</p>
							</div>

				<div class="col-lg-5ths ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">MDN:</label><br>
									<input type="text"  name="<?= $this->controller ?>[mdn]"  class="col-xs-12 col-sm-12 col-lg-12   required" value="<?= $data[mdn] ?>">
								</p>
							</div>

				<div class="col-lg-5ths ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Plano:</label><br>
									<select  name="<?= $this->controller ?>[planos]" id="plano"   class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('planos', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[plano] ? 'selected' : '') ?> data-local="<?= $option[local_uso] ?>" data-fornecedor="<?= $option[fornecedor] ?>"> <?= $option[nome] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

				<div class="col-lg-5ths ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Fornecedor do MDN:</label><br>
									<select  name="<?= $this->controller ?>[fornecedor_mdn]"  class="col-xs-12 col-sm-12 col-lg-12 required <?= ($data[fornecedor_mdn] ? 'disabled' : '') ?>">
					<option value="" <?= ($data[fornecedor_mdn] ? 'disabled' : '') ?>>Selecione</option>
					<?
					foreach ($modelConfig->getOptions('fornecedores', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[fornecedor_mdn] ? 'selected' : ($data[fornecedor_mdn] ? 'disabled' : '')) ?> > <?= $option[nome] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

				<div class="col-lg-3">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Tipo:</label><br>
					<select name="<?= $this->controller ?>[tipo]" class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="1" <?= ($data[tipo] == 1 || !$data[tipo] ? 'selected' : '') ?>>Venda</option>
					<option value="2" <?= ($data[tipo] == 2 ? 'selected' : '') ?>>Desativação</option>
					<option value="3" <?= ($data[tipo] == 3 ? 'selected' : '') ?>>Cancelamento</option>
					</select>
								</p>
							</div>

			 <div class="col-lg-3">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Motivo da Troca:</label><br>
					<select name="<?= $this->controller ?>[motivo_troca]" class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="1" <?= ($data[tipo] == 1 ? 'selected' : '') ?>>Técninca</option>
					<option value="2" <?= ($data[tipo] == 2 ? 'selected' : '') ?>>Por Erro</option>
					</select>
								</p>
							</div>
				<div class="col-lg-3">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Motivo da Ampliação:</label><br>
					<select name="<?= $this->controller ?>[motivo_ampliacao]" class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="1" <?= ($data[tipo] == 1 ? 'selected' : '') ?>>Cortesia</option>
					<option value="2" <?= ($data[tipo] == 2 ? 'selected' : '') ?>>Cobrado</option>
					<option value="3" <?= ($data[tipo] == 3 ? 'selected' : '') ?>>Por erro</option>
					</select>
								</p>
							</div>

			 <div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">n:</label><br>
					<select name="<?= $this->controller ?>[emitir_nota]" class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="" >Selecione</option>
					 <option value="1" <?= ($data["emitir_nota"] == 1 ? 'selected' : '') ?>>s</option>
					<option value="2" <?= ($data["emitir_nota"] == 2 || !$data[emitir_nota] ? 'selected' : '') ?>>n</option>
					</select>


								</p>
							</div>

							<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Data da Transação:</label><br>
									<input type="text"  name="<?= $this->controller ?>[data_transacao]"  class="col-xs-12 col-sm-12 col-lg-12 required data date-picker " data-date-format="dd/mm/yyyy" value="<?= ($data[data_transacao] ? formatDate($data[data_transacao]) : date('d/m/Y')) ?>">
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Data da Ativação:</label><br>
									<input type="text"  name="<?= $this->controller ?>[data_ativacao]"  class="col-xs-12 col-sm-12 col-lg-12 required data date-picker " data-date-format="dd/mm/yyyy" value="<?= ($data[data_ativacao] ? formatDate($data[data_ativacao]) : date('d/m/Y')) ?>">
								</p>
							</div>



				<div class="col-lg-3">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Atendente:</label><br>
									<select  name="<?= $this->controller ?>[atendente]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('atendentes', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[atendente] ? 'selected' : '') ?> > <?= $option[nome] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

							<div class="col-lg-3">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Local da Venda:</label><br>
									<select  name="<?= $this->controller ?>[local_venda]" data-pontos=""  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('local_de_venda', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[local_venda] ? 'selected' : '') ?> > <?= $option[local] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

				<div class="col-lg-3">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Ponto de Venda:</label><br>
									<select  name="<?= $this->controller ?>[ponto_venda]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('ponto_de_venda', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[ponto_venda] ? 'selected' : '') ?> > <?= $option[ponto] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>



							<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Nome do Cliente:</label><br>
									<input type="text"  name="<?= $this->controller ?>[nome]"  class="col-xs-12 col-sm-12 col-lg-12   required" value="<?= $data[nome] ?>">
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Celular:</label><br>
									<input type="text"  name="<?= $this->controller ?>[celular]"  class="col-xs-12 col-sm-12 col-lg-12 celular" value="<?= $data[celular] ?>">
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">E-mail:</label><br>
									<input type="text"  name="<?= $this->controller ?>[email]"  class="col-xs-12 col-sm-12 col-lg-12" value="<?= $data[email] ?>">
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Documento:</label><br>
									<input type="text"  name="<?= $this->controller ?>[documento]"  class="col-xs-12 col-sm-12 col-lg-12" value="<?= $data[documento] ?>">
								</p>
							</div>



				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Local de Uso:</label><br>
									<select  name="<?= $this->controller ?>[local_uso]" id="plano"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('local_de_uso', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[local_uso] ? 'selected' : '') ?> > <?= $option[local] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Dias de Uso:</label><br>
									<input type="text"  name="<?= $this->controller ?>[dias_uso]"  class="col-xs-12 col-sm-12 col-lg-12   required" value="<?= $data[dias_uso] ?>" readonly>
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Data Off:</label><br>
									<input type="text"  name="<?= $this->controller ?>[data_off]"  class="col-xs-12 col-sm-12 col-lg-12 required" data-date-format="dd/mm/yyyy" value="<?= ($data[data_off] ? formatDate($data[data_off]) : '') ?>" readonly >
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Adiar Data Off:</label><br>
										<select class="col-xs-12 col-sm-12 col-lg-12" name="<?= $this->controller ?>[adiar]" >
						<option value="0">Selecione</option>
						<?
						for ($i = 1; $i <= 30; $i++):
							?>
							<option value="<?= $i ?>" <?= ($data[adiar] == $i ? 'selected' : '') ?>><?= $i ?> dia<?= ($i > 1 ? 's' : '') ?></option>
							<?
						endfor;
						?>
					</select>
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Valor do Plano USD:</label><br>
									<input type="text"  name="<?= $this->controller ?>[valor_plano]"  class="col-xs-12 col-sm-12 col-lg-12 moneyUSD required" readonly value="<?= $data[valor_plano] ?>">
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Forma de Pagamento:</label><br>
									<select  name="<?= $this->controller ?>[forma_pagamento]" id="fp"  class="col-xs-12 col-sm-12 col-lg-12 required <?= ($data[forma_pagamento] ? 'disabled' : '') ?>">
					<option value="" <?= ($data[forma_pagamento] ? 'disabled' : '') ?> >Selecione</option>
					<?
					foreach ($modelConfig->getOptions('formas_pagamento', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[forma_pagamento] ? 'selected' : ($data[forma_pagamento] ? 'disabled' : '')) ?> > <?= $option[forma_pagamento] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Moeda:</label><br>
									<select  name="<?= $this->controller ?>[moeda]"  class="col-xs-12 col-sm-12 col-lg-12 required">
					<option value="">Selecione</option>
					<?
					foreach ($modelConfig->getOptions('moedas', true) as $option):
						?>
						<option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[moeda] ? 'selected' : '') ?> > <?= $option[moeda] ?></option>
						<?
					endforeach;
					?>
					</select>
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Desconto:</label><br>
									<input type="text"  name="<?= $this->controller ?>[desconto]"  class="col-xs-12 col-sm-12 col-lg-12  moneyUSD " value="<?= $data[desconto] ?>">
								</p>
							</div>

				<div class="col-lg-3 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Valor Pago:</label><br>
									<input type="text"  name="<?= $this->controller ?>[valor_pago]"  class="col-xs-12 col-sm-12 col-lg-12  moneyUSD required" value="<?= $data[valor_pago] ?>">
								</p>
							</div>

				<div class="col-lg-6 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Aparelho:</label><br>
									<input type="text"  name="<?= $this->controller ?>[aparelhos]"  class="col-xs-12 col-sm-12 col-lg-12" value="<?= $data[aparelhos] ?>">
								</p>
							</div>


				<div class="col-lg-6 ">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Países Informados:</label><br>
									<input type="text"  name="<?= $this->controller ?>[paises]"  class="col-xs-12 col-sm-12 col-lg-12" value="<?= $data[paises] ?>">
								</p>
							</div>


				<div class="col-lg-12 col-xs-12">
								<p>
									<label class="control-label no-padding-right" for="form-field-1">Observações:</label><br>
									<textarea  name="<?= $this->controller ?>[observacao]"  class="col-xs-12 col-sm-12 col-lg-12 "  style="height:60px"><?= $data[observacao] ?></textarea>
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
	$(document).ready(function(){

		$( ".auto-complete" ).autocomplete({

			source: function( request, response ) {
			$.ajax( {

			url: ajaxUrl+"/transacoes/getSim",
			dataType: "jsonp",
			data: {
			term: request.term
			},
			success: function( data ) {


			response($.map(data,function(item) {

				return {
								label: item.simcard,
								value: item.simcard,
				abbrev: item.ID
							};

							}));


			}
			} );
			},
			minLength: 2,
			select: function( event, ui ) {




				if( ui.item.abbrev==""){

					return false

				}

				$.post(ajaxUrl+'/transacoes/getInfoSim', {'sim': ui.item.abbrev, 'query':'sim'}, function(a){


					a = $.parseJSON(a)

					if(a[0].mdn){
					$("[name='transacoes[mdn]'").val(a[0].mdn)
					$("[name='transacoes[fornecedor_simcard]'").val(a[0].fornecedor_simcard)
					$("[name='transacoes[fornecedor_mdn]'").val(a[0].fornecedor_mdn)
					}
					else
					{

					$("[name='transacoes[fornecedor_simcard]'").val(a[0].fornecedor_simcard)

					}



					})

			}

		});

		$("[name='transacoes[emitir_nota]']").change(function(){


			if($(this).val()==1){

				$("[name='transacoes[documento]']").addClass('required')

			}
			else
			{
				$("[name='transacoes[documento]']").removeClass('required')

			}


		})

		function getPlanes($f){

			$.post(ajaxUrl+'cadastros/getPlanos', {ID: $f}, function(a){



			})

		}



		$('#plano').change(function(){


			$.post(ajaxUrl+'cadastros/getPlano', {ID: $(this).val()}, function(a){

				$a = $("[name='transacoes[data_ativacao]']").val().split('/')

				a = $.parseJSON(a)

				$b = new Date($a[2], $a[1]-1, parseInt($a[0])+parseInt(a[0].qtd_dias), 0, 0, 0)


				$("[name='transacoes[data_off]']").val(("0" + $b.getDate()).slice(-2)+'/'+("0" + ($b.getMonth()+1)).slice(-2)+'/'+$b.getFullYear())

				$("[name='transacoes[local_uso]']").val(a[0].local_uso).addClass('disabled')
				$("[name='transacoes[dias_uso]']").val(a[0].qtd_dias)
				$("[name='transacoes[valor_plano]']").val(a[0].valor.replace(',', '.'))
				$("[name='transacoes[local_uso]'] option:not(:selected)").attr('disabled', true)




			})

		})


		$("[name='transacoes[desconto]']").blur(function(){

			$vc = ($("[name='transacoes[valor_plano]']").val().replace(',','.')-$(this).val().replace(',','.'))






		})

		$("[name='transacoes[local_venda]']").change(function(){


			$("[name='transacoes[ponto_venda]']").html('')

				 $.post(ajaxUrl+'cadastros/getPonto', {ID: $(this).val()}, function(a){

				 if(a){

					b = JSON.parse(a)

					if(b.length>1){

						$("[name='transacoes[ponto_venda]']").append($('<option>').attr('value', '').html('Selecione'))

					}



					b.forEach(function(item, index){



						$("[name='transacoes[ponto_venda]']").append($('<option>').attr('value', item.ID).html(item.ponto))


					 })



				 }

			 })

		})

		$("[name='transacoes[fornecedor_mdn]']").change(function(){

			if($("[name='transacoes[mdn]']").val()==""){


				$.post(ajaxUrl+'/transacoes/getInfoSim', {'sim': $(this).val(), 'query':'fornecedor'}, function(a){

					a = $.parseJSON(a)

					$("[name='transacoes[mdn]'").val(a[0].mdn)

				})

			}

		})

		$("[name='transacoes[fornecedor_mdn]']").change(function(){

			if($("[name='transacoes[mdn]']").val()==""){


				$.post(ajaxUrl+'/transacoes/getInfoSim', {'sim': $(this).val(), 'query':'fornecedor'}, function(a){

					a = $.parseJSON(a)

					$("[name='transacoes[mdn]'").val(a[0].mdn)

				})

			}

		})


		$("[name='transacoes[planos]']").change(function(){



			if($("[name='transacoes[fornecedor_mdn]']").val()==""){


				$.post(ajaxUrl+'/transacoes/getInfoSim', {'sim': $(this).val(), 'query':'plano'}, function(a){

					a = $.parseJSON(a)

					$("[name='transacoes[mdn]'").val(a[0].mdn)
					$("[name='transacoes[fornecedor_mdn]'").val(a[0].fornecedor_mdn).addClass('disabled')
					$("[name='transacoes[fornecedor_mdn]'] option:not(:selected)").attr('disabled', true)

				})

			}

		})


		$("[name='transacoes[data_ativacao]']").change(function(){

			if($("[name='transacoes[dias_uso]']").val()){

			$a = $(this).val().split('/')

			$b = new Date($a[2], $a[1]-1, parseInt($a[0])+parseInt($("[name='transacoes[dias_uso]']").val()), 0, 0, 0)


			$("[name='transacoes[data_off]']").val(("0" + $b.getDate()).slice(-2)+'/'+("0" + ($b.getMonth()+1)).slice(-2)+'/'+$b.getFullYear())
			}

		})




	})
</script>
