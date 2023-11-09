<?php
if ( ! defined('ABSPATH')) exit;
$modelConfig = $this->load_model('configuracoes/configuracoes-model');
?>


<!-- Alert -->

<div id="modal-search" class="modal" tabindex="-1">
  <div class="modal-dialog" style="width: 90%">


      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Detalhes da Busca</h4>
          </div>

          <div class="modal-body">

          </div>

          <div class="modal-footer">
              <button class="btn btn-sm btn-primary" data-dismiss="modal">
                  <i class="ace-icon fa fa-check"></i>
                  Fechar
              </button>
          </div>
      </div>

  </div>
</div>

<!-- Alert -->

<div id="modal-alert" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Atenção</h4>
          </div>

          <div class="modal-body">

          </div>

          <div class="modal-footer">
              <button class="btn btn-sm btn-primary" data-dismiss="modal">
                  <i class="ace-icon fa fa-check"></i>
                  Fechar
              </button>
          </div>
      </div>

  </div>
</div>


<div id="modal-filter" class="modal" tabindex="-1">
  <div class="modal-dialog">

      <form class="filter-report">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Selecione os campos que deseja apresentar no relatório</h4>
          </div>

          <div class="modal-body row">
			  <div class="col-lg-6" style="padding: 0">
              <div class="profile-user-info profile-user-info-striped">


		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="iccid" name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>SIMCARD</span>
			</div>
		</div>


		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="fornecedor_simcard"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>FORNECEDOR SIMCARD</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="mdn"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>MDN</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="fornecedor_mdn"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>FORNCEDOR MDN</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="plano"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>PLANO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="tipo"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>TIPO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="emitir_nota"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>NF</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="data_transacao"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DATA DA TRANSAÇÃO</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="data_ativacao"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DATA DA ATIVAÇÃO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="data_off"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DATA OFF</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="adiar"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>ADIAR DATA OFF</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="atendente"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>ATENDENTE</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="local_venda"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOCAL DA VENDA</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="ponto_venda"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>PONTO DA VENDA</span>
			</div>
		</div>




					</div>
          </div>
			  <div class="col-lg-6" style="padding: 0">
              <div class="profile-user-info profile-user-info-striped">

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="nome"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>NOME DO CLIENTE</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="celular"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>CELULAR</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="email"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>E-MAIL</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="documento"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DOCUMENTO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="local_uso"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOCAL DE USO</span>
			</div>
		</div>


		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="dias_uso"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DIAS DE USO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="valor_plano"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VALOR DO PLANO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="forma_pagamento"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>FORMA DE PAGAMENTO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="moeda"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>MOEDA</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="desconto"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DESCONTO</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="valor_pago"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VALOR PAGO</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="aparelho"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>APARELHO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="paises"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>PAÍSES INFORMADOS</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="observacao"  name="filter[]"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>OBSERVAÇÕES</span>
			</div>
		</div>

					</div>
          </div>
		  </div>

          <div class="modal-footer">
              <button class="btn btn-sm btn-primary filter-report" data-dismiss="modals">
                  <i class="ace-icon fa fa-check"></i>
                  Carregar
              </button>
          </div>
      </div>
      </form>
  </div>
</div>

<div id="modal-cancelar" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Cancelar Venda</h4>
          </div>

          <div class="modal-body clearfix">

			  <p>
			  <label class="control-label no-padding-right" for="form-field-1"> Responsável pelo cancelamento:</label><br>
              <input type="text"  name="responsavel_cancelamento"  class="col-xs-12">
			  </p>
          </div>

          <div class="modal-footer">
              <button class="btn btn-sm" data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>

              <button class="btn btn-sm btn-primary removeSell"  data-id="">
                  <i class="ace-icon fa fa-check"></i>
                  Sim
              </button>
          </div>
      </div>

  </div>
</div>

<div id="modal-daily-report" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Gerar Relatório Diário</h4>
          </div>

          <div class="modal-body clearfix">

			  <p>
			  <label class="control-label no-padding-right" for="form-field-1"> Período:</label><br>
              <input type="text"  class="date-range col-xs-12" data-date-format="dd/mm/yyyy"  name="periodo" value="<?=date('d/m/Y')?> - <?=date('d/m/Y')?>"  >
			  </p>
          </div>

          <div class="modal-footer">
              <button class="btn btn-sm closeModal"  data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>

              <button class="btn btn-sm btn-primary report"  data-id="">
                  <i class="ace-icon fa fa-check"></i>
                  Gerar
              </button>
          </div>
      </div>

  </div>
</div>

<div id="modal-sim" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Corrigir SIMCARD</h4>
          </div>

          <div class="modal-body clearfix">

			  <p>
			  <label class="control-label no-padding-right" for="form-field-1"> SIMCARD:</label><br>
              <input type="text"  name="new_simcard"  class="col-xs-12">
			  </p>
          </div>

          <div class="modal-footer">
              <button class="btn btn-sm" data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>

              <button class="btn btn-sm btn-primary changeSim"  data-id="">
                  <i class="ace-icon fa fa-check"></i>
                  Sim
              </button>
          </div>
      </div>

  </div>
</div>

<!-- Confirm -->

<div id="modal-confirm" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Atenção</h4>
          </div>

          <div class="modal-body">
              Deseja realmente excluir esses registros?
          </div>

          <div class="modal-footer">
              <button class="btn btn-sm" data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>

              <button class="btn btn-sm btn-primary removeAction" data-dismiss="modal">
                  <i class="ace-icon fa fa-check"></i>
                  Sim
              </button>
          </div>
      </div>

  </div>
</div>


<!-- Modal Importar -->

<div id="modal-import-lote" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Importar Lote</h4>
          </div>

          <div class="modal-body">
          	<div class="row">
			 <form class="importer">
              <div class="col-xs-12 ">

                  <div class="form-group">
						<label class="ace-file-input ace-file-multiple"><input multiple="" type="file" id="id-input-file-3" name="lote"><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>
				</div>
              </div>

			 <div class="col-lg-5ths ">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Tipo de Cadastro:</label><br>
                  <select  name="tipo"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="1">MDN</option>
					<option value="2">SIMCARD</option>
				    <option value="3">MDN e SIMCARD</option>
				  </select>
               </p>
              </div>


              <div class="col-lg-5ths field-mdn">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Fornecedor MDN:</label><br>
                  <select  name="fornecedor_mdn"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('fornecedores', true) as $option):
					?>
					<option value="<?=$option[ID]?>"> <?=$option[nome]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>

			  <div class="col-lg-5ths field-simcard">
                <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Fornecedor SIMCARD:</label><br>
                  <select  name="fornecedor_simcard"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('fornecedores', true) as $option):
					?>
					<option value="<?=$option[ID]?>"> <?=$option[nome]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>

			  <div class="col-lg-5ths field-both">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Código de Uso MDN:</label><br>
                  <select  name="tipo_uso"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('tipo_de_uso') as $option):
					?>
					<option value="<?=$option[ID]?>"> <?=$option[codigo]?> - <?=$option[apelido]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>

				<div class="col-lg-5ths field-mdn">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Status MDN:</label><br>
                  <select  name="status_mdn"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('status_mdn') as $option):
					?>
					<option value="<?=$option[ID]?>"><?=$option[status]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>

				 <div class="col-lg-5ths field-simcard">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Status SIMCARD:</label><br>
                  <select  name="status_simcard"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('status_simcard') as $option):
					?>
					<option value="<?=$option[ID]?>"><?=$option[status]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>


				 <div class="col-lg-5ths field-simcard">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Local de Estoque:</label><br>
                  <select  name="local_estoque"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('local_de_estoque') as $option):
					?>
					<option value="<?=$option[ID]?>"><?=$option[local]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>

				<div class="col-lg-5ths ">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Identificação do Lote:</label><br>
                  <input type="text"  name="lote"  class="col-xs-12 col-sm-12 col-lg-12   ">
               </p>
              </div>

			  <div class="col-lg-12 text-center">
                  <p>
					  <br>
					  <br>

               </p>
              </div>

				 <input type="hidden" name="file" class="file-import">
				 </form>

			  <div class="col-lg-12 tableImport ">


			  <div class="text-center"><img src="<?=HOME_URI?>views/assets/images/wait.gif" alt="" class="ajaxLoader hidden"></div>


			  </div>

              </div>

			  <div class="row">
			  	<div class="col-lg-12 text-center"><img src="<?=HOME_URI?>views/assets/images/wait.gif" alt="" class="ajaxLoader"  hidden></div>
			  </div>
          </div>

          <div class="modal-footer">


          <div class="emailFeed pull-left"></div>



                 <a href="" class="model"><button class="btn btn-warning btn-sm "   data-rel="tooltip" data-placement="bottom" title="Baixar Modelo de Planilha"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>


			  <button class="btn btn-sm " data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>
			  <button class="btn btn-sm btn-info import-action" onClick="$('.importer').submit()">
                  <i class="ace-icon fa fa-cloud-upload"></i>
                  Importar
              </button>



          </div>

      </div>

  </div>
</div>



<!-- MODAL TROCAR FORNECEDOR -->

<div id="modal-change-status" class="modal" tabindex="-1">
  <div class="modal-dialog" style="width: 50%">


      <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Mudar Status MDN</h4>
          </div>

          <div class="modal-body">
          	<div class="row">
			 <form class="changeStatus">
              <div class="col-xs-12 ">



                  <div class="form-group">
						<label class="ace-file-input ace-file-multiple">
						<input multiple="" type="file" id="id-input-file-7" name="lote"><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>

              </div>
              </div>

              <div class="col-lg-12 ">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Status:</label><br>
                  <select  name="status"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('status_mdn') as $option):
					?>
					<option value="<?=$option[ID]?>"><?=$option[status]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>




			  <div class="col-lg-12 text-center">
                  <p>
					  <br>
					  <br>

               </p>
              </div>

				 <input type="hidden" name="file" class="file-import">
				 </form>

			  <div class="col-lg-12 tableImport ">




			  </div>

              </div>

			  <div class="row">
			  	<div class="col-lg-12 text-center"><img src="<?=HOME_URI?>views/assets/images/wait.gif" alt="" class="ajaxLoader"  hidden></div>
			  </div>
          </div>

          <div class="modal-footer">


          <div class="emailFeed pull-left"></div>


			  <button class="btn btn-sm " data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>
			  <button class="btn btn-sm btn-info import-action" onClick="$('.changeStatus').submit()">
                  <i class="ace-icon fa fa-cloud-upload"></i>
                  Importar
              </button>




          </div>

      </div>

  </div>
</div>



<div id="modal-recharge" class="modal" tabindex="-1">
  <div class="modal-dialog" >


      <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Fazer Recarga</h4>
			  <p>Digite o ICCID para aparecer as opções de recargas</p>
          </div>

          <div class="modal-body">
          	<div class="row">
			 <form class="recharge">


              <div class="col-lg-12 ">
			 	 <p>
				 	 <label class="control-label no-padding-right" for="form-field-1"> Digite o ICCID:</label><br>
					 <input type="text" name="iccid" class="col-xs-12 col-sm-12 col-lg-12 ">
              	 </p>

                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Dias:</label><br>
                  <select  name="plano"  class="col-xs-12 col-sm-12 col-lg-12 ">
					 <option>Selecione</option>
				  </select>
               </p>
              </div>




			  <div class="col-lg-12 text-center">
                  <p>
					  <br>
					  <br>

               </p>
              </div>

				 <input type="hidden" name="file" class="file-import">
				 </form>

			  <div class="col-lg-12 tableImport ">




			  </div>

              </div>

			  <div class="row">
			  	<div class="col-lg-12 text-center"><img src="<?=HOME_URI?>views/assets/images/wait.gif" alt="" class="ajaxLoader"  hidden></div>
			  </div>
          </div>

          <div class="modal-footer">


          <div class="emailFeed pull-left"></div>


			  <button class="btn btn-sm " data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>
			  <button class="btn btn-sm btn-info recharge-action" onClick="$('.recharge').submit()">
                  <i class="ace-icon fa fa-cloud-upload"></i>
                  Confirmar
              </button>




          </div>

      </div>

  </div>
</div>

<script>


	$('body').on('keydown, change', ' .recharge input[name="iccid"]', function(){

		if($(this).val().length==20){



		$.post(ajaxUrl+'ajax/getOptionsRecharge', {iccid: $(this).val()}, function(a){



				   $('select[name=plano]').html('').append('<option>Selecione</option>')

				a = JSON.parse(a);

				a.forEach((value) => {


					$('select[name=plano]').append('<option value="'+value.ID+'">'+value.qtd_dias+' '+(value.qtd_dias==1?'Dia':'Dias')+'</option>')

				})

		})

		}

	})

</script>
<!-- Modal Exportar -->


<div id="modal-export-lote" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Enviar lote de Simcard para Local de Venda</h4>
          </div>

          <div class="modal-body">
          	<div class="row">
			 <form class="importerSend">
              <div class="col-xs-12 ">



                  <div class="form-group">
						<label class="ace-file-input ace-file-multiple"><input multiple="" type="file" id="id-input-file-5" name="lote"><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>

              </div>
              </div>

              <div class="col-lg-6 ">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Local de Estoque:</label><br>
                  <select  name="local_estoque"  class="col-xs-12 col-sm-12 col-lg-12 ">
					<option value="">Selecione</option>
					<?
					 foreach($modelConfig->getOptions('local_de_estoque') as $option):
					?>
					<option value="<?=$option[ID]?>"><?=$option[local]?></option>
					<?
					 endforeach;
					?>
				  </select>
               </p>
              </div>

			  <div class="col-lg-6 ">
                  <p>
                  <label class="control-label no-padding-right" for="form-field-1"> Identificação do Lote:</label><br>
                  <input type="text"  name="lote"  class="col-xs-12 col-sm-12 col-lg-12  ">
               </p>
              </div>


			  <div class="col-lg-12 text-center">
                  <p>
					  <br>
					  <br>

               </p>
              </div>

				 <input type="hidden" name="file" class="file-import">
				 </form>

			  <div class="col-lg-12 tableImport ">


			  <div class="text-center"><img src="<?=HOME_URI?>views/assets/images/wait.gif" alt="" class="ajaxLoader hidden"></div>


			  </div>

              </div>

			  <div class="row">
			  	<div class="col-lg-12 text-center"><img src="<?=HOME_URI?>views/assets/images/wait.gif" alt="" class="ajaxLoader"  hidden></div>
			  </div>
          </div>

          <div class="modal-footer">


          <div class="emailFeed pull-left"></div>


			  <button class="btn btn-sm " data-dismiss="modal">
                  <i class="ace-icon fa fa-times"></i>
                  Cancelar
              </button>
			  <button class="btn btn-sm btn-info import-action" onClick="$('.importerSend').submit()">
                  <i class="ace-icon fa fa-cloud-upload"></i>
                  Importar
              </button>




          </div>

      </div>

  </div>
</div>

<div id="modal-swap" class="modal" tabindex="-1">
  <div class="modal-dialog">


      <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="blue ">Gerar Swap de <span class="stype"></span></h4>
          </div>

          <div class="modal-body">


			  <div class="">
				<div class="row">

					<div class="col-xs-12 col-sm-12">
						<div class="space visible-xs"></div>
						<div class="f-content"></div>
					</div>
				</div>

          	 </div>
          </div>

          <div class="modal-footer">

          <div class="swapFeed pull-left">
			  <p><label class="pos-rel swapT"><input type="checkbox" name="adiar" class="ace gswap" value="1" data-tipo="1"><span class="lbl"></span> Exibir Swaps do dia seguinte</label></p>
			  <p class="text-left"><label class="pos-rel"><input type="checkbox" name="OnlySelected" class="ace gswap" value="1" data-tipo="1"><span class="lbl"></span> Somente os Selecionados</label></p>
			  </div>


              <button class="btn btn-sm btn-success  btn-primary makeSwap">
                  <i class="fa fa-refresh" aria-hidden="true"></i>
                  Gerar Swap
              </button>


          </div>

      </div>

  </div>
</div>

<script>

$(document).ready(function(){

	$("#modal-daily-report .close, #modal-daily-report .closeModal").click(function(){

		$('.filterDisabled').removeClass('filterDisabled').addClass('filterRegistry')



	})

	$( ".report" ).on( "click", function() {
		window.location='<?=HOME_URI?>/relatorios/getSellersByDay/?periodo=' + $('input[name="periodo"]').val()
		$('#modal-daily-report .close').trigger('click')
} );

})

</script>
