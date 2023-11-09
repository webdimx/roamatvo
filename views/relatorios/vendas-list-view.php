<?php
if ( ! defined('ABSPATH')) exit;
$cfg = $this->getConfig();
parse_str($_COOKIE[reportSell], $fields);


$defaultFields = array('nome', 'plano', 'dias_uso', 'data_transacao', 'data_ativacao', 'data_off', 'iccid', 'mdn', 'status');
$fields = ($fields?$fields[filter]:$defaultFields);

?>

<script>controller='<?=$this->controller?>/vendas'</script>



<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">


<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
	<a href="#" class="btn btn-primary btn-sm filterRegistry"><i class="fa fa-search bigger-110 "></i> Filtrar</a>
    <a href="<?=HOME_URI.$this->controller?>/<?=$this->subController?>" class="btn btn-primary btn-sm  clear-filters"><i class="fa fa-ban bigger-110 "></i> Limpar filtros</a>
    <a style="display: none" href="#modal-return" class="returnModal" data-toggle="modal" >Ok</a>
		<a href="#modal-daily-report"  class="btn btn-warning dailyReport  btn-sm " data-toggle="modal" ><i class="fa fa-file-excel-o"></i>Exportar Relatório Diário</a>
    <a href="<?=HOME_URI.$this->controller?>/exportReport/?<?=str_replace('path=relatorios/vendas', '', $_SERVER['QUERY_STRING'])?>"  class="btn btn-success   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar</a>
	<a href="<?=HOME_URI.$this->controller?>/exportReport/?<?=str_replace('path=relatorios/vendas', '', $_SERVER['QUERY_STRING'])?>"  class="btn btn-success exportSel   btn-sm " ><i class="fa fa-file-excel-o"></i> Exportar Selecionados</a>
</div>
</div>


<style>

</style>


<div class="well well-sm filtersField">
	<h4 class="blue smaller"><i class="fa fa-filter" aria-hidden="true"></i> FILTRAR CAMPOS
		<i class="fa fa-chevron-circle-down pull-right showFilters" aria-hidden="true"></i>
	</h4>

	<div class="fileds-select">
	<div class="modal-body row">

		<form class="filter-report">
			  <div class="col-lg-5ths" style="padding: 0">
              <div class="profile-user-info profile-user-info-striped">


		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace selectAll" value="" name=""><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>SELECIONAR TODOS</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="iccid" name="filter[]" <?=(in_array('iccid', $fields)?'checked':'') ?>	><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>SIMCARD</span>
			</div>
		</div>


		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="fornecedor_simcard"  name="filter[]" <?=(in_array('fornecedor_simcard', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>FORNECEDOR SIMCARD</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="mdn"  name="filter[]" <?=(in_array('mdn', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>MDN</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="fornecedor_mdn"  name="filter[]" <?=(in_array('fornecedor_mdn', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>FORNECEDOR MDN</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="plano"  name="filter[]" <?=(in_array('plano', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>PLANO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="status_mdn"  name="filter[]" <?=(in_array('status_mdn', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>STATUS MDN</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="voucher"  name="filter[]" <?=(in_array('voucher', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VOUCHER</span>
			</div>
		</div>

				  <div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="detalhe"  name="filter[]" <?=(in_array('detalhe', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DETALHE</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="motivo_ampliacao"  name="filter[]" <?=(in_array('motivo_ampliacao', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>MOTIVO DA AMPLIAÇÃO</span>
			</div>
		</div>




				  </div></div>
		<div class="col-lg-5ths" style="padding: 0">
			<div class="profile-user-info profile-user-info-striped">

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="emitir_nota"  name="filter[]" <?=(in_array('emitir_nota', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>NF</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="data_transacao"  name="filter[]" <?=(in_array('data_transacao', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DATA DA TRANSAÇÃO</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="data_ativacao"  name="filter[]" <?=(in_array('data_ativacao', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DATA DA ATIVAÇÃO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="data_off"  name="filter[]" <?=(in_array('data_off', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DATA OFF</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="adiar"  name="filter[]" <?=(in_array('adiar', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>ADIAR DATA OFF</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="atendente"  name="filter[]" <?=(in_array('atendente', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>ATENDENTE</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="area_atuacao"  name="filter[]" <?=(in_array('area_atuacao', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOCAL DE ATUAÇÃO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="status_simcard"  name="filter[]" <?=(in_array('status_simcard', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>STATUS SIMCARD</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="ocorrencia"  name="filter[]" <?=(in_array('ocorrencia', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>TIPO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="helpdesk"  name="filter[]" <?=(in_array('helpdesk', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>HELPDESK</span>
			</div>
		</div>


		</div>

					</div>

			  <div class="col-lg-5ths" style="padding: 0">
              <div class="profile-user-info profile-user-info-striped">

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="local_venda"  name="filter[]" <?=(in_array('local_venda', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOCAL DA VENDA</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="ponto_venda"  name="filter[]" <?=(in_array('ponto_venda', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>PONTO DA VENDA</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="nome"  name="filter[]" <?=(in_array('nome', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>NOME DO CLIENTE</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="celular"  name="filter[]" <?=(in_array('celular', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>CELULAR</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="email"  name="filter[]" <?=(in_array('email', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>E-MAIL</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="documento"  name="filter[]" <?=(in_array('documento', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DOCUMENTO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="lote_mdn"  name="filter[]" <?=(in_array('lote_mdn', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOTE MDN</span>
			</div>
		</div>


				  <div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="motivo_troca"  name="filter[]" <?=(in_array('motivo_troca', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>MOTIVO DA TROCA</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="reembolso"  name="filter[]" <?=(in_array('reembolso', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>REEMBOLSO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="cancelamento"  name="filter[]" <?=(in_array('cancelamento', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>CANCELADO</span>
			</div>
		</div>

		</div>
		</div>

		 <div class="col-lg-5ths" style="padding: 0">
		<div class="profile-user-info profile-user-info-striped">

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="local_uso"  name="filter[]" <?=(in_array('local_uso', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOCAL DE USO</span>
			</div>
		</div>


		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="dias_uso"  name="filter[]" <?=(in_array('dias_uso', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DIAS DE USO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="valor_plano"  name="filter[]" <?=(in_array('valor_plano', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VALOR DO PLANO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="desconto_plano"  name="filter[]" <?=(in_array('desconto_plano', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DESCONTO DO PLANO</span>
			</div>
		</div>
        <div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="valor_dolar_dia"  name="filter[]" <?=(in_array('valor_dolar_dia', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VALOR DOLAR DO DIA</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="final_plano"  name="filter[]" <?=(in_array('final_plano', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VALOR FINAL DO PLANO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="forma_pagamento"  name="filter[]" <?=(in_array('forma_pagamento', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>FORMA DE PAGAMENTO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="moeda"  name="filter[]" <?=(in_array('moeda', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>MOEDA</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="desconto"  name="filter[]" <?=(in_array('desconto', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DESCONTO</span>
			</div>
		</div>

			<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="lote_simcard"  name="filter[]" <?=(in_array('lote_simcard', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>LOTE SIMCARD</span>
			</div>
		</div>









					</div>
          </div>
		  <div class="col-lg-5ths" style="padding: 0">
		<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="status"  name="filter[]" <?=(in_array('status', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>STATUS</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="valor_pago"  name="filter[]" <?=(in_array('valor_pago', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>VALOR PAGO</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="aparelho"  name="filter[]" <?=(in_array('aparelho', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>APARELHO</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="paises"  name="filter[]" <?=(in_array('paises', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>PAÍSES INFORMADOS</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="observacao"  name="filter[]" <?=(in_array('observacao', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>OBSERVAÇÕES</span>
			</div>
		</div>






			<!--<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="tipo_transacao"  name="filter[]" <?=(in_array('tipo_transacao', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>TIPO DE TRANSAÇÃO</span>
			</div>
		</div>-->

			<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="descricao_motivo"  name="filter[]" <?=(in_array('descricao_motivo', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>DESCRIÇÃO DO MOTIVO</span>
			</div>
		</div>

		<div  class="profile-info-row <?=($this->filter?'hidden':'')?>">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="origem"  name="filter[]" <?=(in_array('origem', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>ORIGEM</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="_status"  name="filter[]" <?=(in_array('_status', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>A</span>
			</div>
		</div>

		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px">
				<label class="pos-rel"><input type="checkbox" class="ace" value="nota_d"  name="filter[]" <?=(in_array('nota_d', $fields)?'checked':'') ?>><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span>N. DETERM</span>
			</div>
			</div>

					</div>


          </div>
			<div class="col-lg-12 text-center">
			  	<p></p><button class="btn btn-sm btn-primary filter-report" data-dismiss="modals">
                  <i class="ace-icon fa fa-check"></i>
                  Filtrar Campos
              </button>
			  </div>
			</form>
		  </div>

	</div>
</div>
<div class="table-content">
<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <th class="center" rowspan="1" colspan="1"  width="20"><label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl"></span></label>
          <input type="hidden" value="<?=$this->type?>" name="type">
          </th>

		<? if(in_array('nome', $fields)): ?>
        <th rowspan="1" colspan="1">Nome do Cliente<br><input type="text" class="filter" name="a|nome" value="<?=$_GET['a|nome']?>"></th>
		<? endif;?>
		<? if(in_array('plano', $fields)): ?>
		<th rowspan="1" colspan="1">Plano<br>
		<select  class="filter"  name="plano"   class="col-xs-12 col-sm-12 col-lg-12 required">
		<option value=""></option>
		<?
		 foreach($modelConfig->getOptions('planos', true) as $option):
		?>
		<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[plano]?'selected':'') ?> data-local="<?=$option[local_uso]?>"> <?=$option[nome]?></option>
		<?
		 endforeach;
		?>
		 </select>

		  </th>
	      <? endif;?>
		  <? if(in_array('dias_uso', $fields)): ?>
		  <th width="20" rowspan="1" colspan="1">Dias<br><input type="text" class="filter id" name="dias_uso" value="<?=$_GET['dias_uso']?>"></th>
		  <? endif;?>
	      <? if(in_array('data_transacao', $fields)): ?>
		  <th rowspan="1" colspan="1">Data da Transação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_transacao" value="<?=$_GET['data_transacao']?>"> </th>
		  <? endif;?>
		  <? if(in_array('data_ativacao', $fields)): ?>
		  <th rowspan="1" colspan="1">Data da Ativação<br><input type="text" class="filter date-range date" data-date-format="dd/mm/yyyy"  name="data_ativacao" value="<?=$_GET['data_ativacao']?>"> </th>
		  <? endif;?>
		  <? if(in_array('data_off', $fields)): ?>
		  <th rowspan="1" colspan="1">Data OFF<br><input type="text" class="filter date date-range " data-date-format="dd/mm/yyyy"  name="data_off" value="<?=$_GET['data_off']?>"></th>
		  <? endif;?>
		  <? if(in_array('adiar', $fields)): ?>
		  <th width="20" rowspan="1" colspan="1">Adiar<br>
			 <input type="text" class="filter id"   name="adiar" value="<?=$_GET['adiar']?>">
		  </th>
		  <? endif;?>
		  <? if(in_array('iccid', $fields)): ?>
		  <th rowspan="1" colspan="1">SIMCARD<br><input type="text" class="filter" name="iccid" value="<?=$_GET['iccid']?>"></th>
		  <? endif;?>
		  <? if(in_array('fornecedor_simcard', $fields)): ?>
		  <th rowspan="1" colspan="1">Fornecedor SIMCARD<br>
			<select  name="a|fornecedor_simcard"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('fornecedores') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['a|fornecedor_simcard']?'selected':'')?>><?=$option[nome]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>
		  <? if(in_array('mdn', $fields)): ?>
		  <th rowspan="1" colspan="1">MDN<br><input type="text" class="filter" name="a|mdn" value="<?=$_GET['a|mdn']?>"></th>
		  <? endif;?>
		  <? if(in_array('fornecedor_mdn', $fields)): ?>
		  <th rowspan="1" colspan="1">Fornecedor MDN<br>
			<select  name="a|fornecedor_mdn"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('fornecedores') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['a|fornecedor_mdn']?'selected':'')?>><?=$option[nome]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>
		  <? if(in_array('emitir_nota', $fields)): ?>
		  <th width="20" rowspan="1" colspan="1">n<br>
			<select name="emitir_nota" class="filter id">
				<option value=""></option>
				<option value="1"  <?=(1==$_GET[emitir_nota]?'selected':'')?>>s</option>
			</select>
		  </th>
		  <? endif;?>
		  <? if(in_array('atendente', $fields)): ?>
		  <th rowspan="1" colspan="1">Atendente<br>
			<select  name="atendente"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('atendentes') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[atendente]?'selected':'')?>><?=$option[nome]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>

		  <? if(in_array('area_atuacao', $fields)): ?>
		  <th rowspan="1" colspan="1">Local de Atuação<br>
			<select  name="area_atuacao"  class="filter">
				<option value=""></option>
				<option value="1" <?=(1==$_GET[area_atuacao]?'selected':'')?>>AERO</option>
				<option value="2" <?=(2==$_GET[area_atuacao]?'selected':'')?>>HD</option>
			</select>
		  </th>
		  <? endif;?>
		  <? if(in_array('local_venda', $fields)): ?>
		  <th rowspan="1" colspan="1">Local da Venda<br>
			 <select  name="local_venda"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('local_de_venda') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[local_venda]?'selected':'')?>><?=$option[local]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>
		   <? if(in_array('ponto_venda', $fields)): ?>
		  <th rowspan="1" colspan="1">Ponto da Venda<br>
			<select  name="ponto_venda"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('ponto_de_venda') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET[ponto_venda]?'selected':'')?>><?=$option[ponto]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>
		  <? if(in_array('celular', $fields)): ?>
		  <th rowspan="1" colspan="1">Celular<br><input type="text" class="filter" name="a|celular" value="<?=$_GET['a|celular']?>"></th>
		  <? endif;?>
		   <? if(in_array('email', $fields)): ?>
		  <th rowspan="1" colspan="1">E-mail<br><input type="text" class="filter" name="a|email" value="<?=$_GET['a|email']?>"></th>
		  <? endif;?>
		   <? if(in_array('documento', $fields)): ?>
		  <th rowspan="1" colspan="1">Documento<br><input type="text" class="filter" name="documento" value="<?=$_GET['documento']?>"></th>
		  <? endif;?>
		   <? if(in_array('local_uso', $fields)): ?>
		  <th rowspan="1" colspan="1">Local de Uso<br>
			<select  name="a|local_uso"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('local_de_uso') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['a|local_uso']?'selected':'')?>><?=$option[local]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>
		   <? if(in_array('valor_plano', $fields)): ?>
		  <th rowspan="1" colspan="1">Valor do Plano<br><input type="text" class="filter moneyUSD" name="valor_plano" value="<?=$_GET['valor_plano']?>"></th>
		  <? endif;?>
		  <? if(in_array('desconto_plano', $fields)): ?>
		  <th rowspan="1" colspan="1">Desconto do Plano<br><input type="text" class="filter moneyUSD" name="desconto_plano" value="<?=$_GET['desconto_plano']?>"></th>
		  <? endif;?>
		  <? if(in_array('valor_dolar_dia', $fields)): ?>
		  <th rowspan="1" colspan="1">Valor Dolar do Dia<br><input type="text" class="filter moneyUSD" name="valor_dolar_dia" value="<?=$_GET['valor_dolar_dia']?>"></th>
		  <? endif;?>
		  <? if(in_array('final_plano', $fields)): ?>
		  <th rowspan="1" colspan="1">Valor Final do Plano<br><input type="text" class="filter moneyUSD" name="final_plano" value="<?=$_GET['final_plano']?>"></th>
		  <? endif;?>
		  <? if(in_array('forma_pagamento', $fields)): ?>
		  <th rowspan="1" colspan="1">Forma de Pagamento<br><input type="text" class="filter" name="forma_pagamento" value="<?=$_GET['forma_pagamento']?>"></th>
		  <? endif;?>
		  <? if(in_array('moeda', $fields)): ?>
		  <th width="20" rowspan="1" colspan="1">Moeda<br>
			<select  name="a|moeda"  class="filter id">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('moedas') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['a|moeda']?'selected':'')?>><?=$option[moeda]?></option>
				<?
				 endforeach;
				?>
			</select>
		  </th>
		  <? endif;?>
		  <? if(in_array('desconto', $fields)): ?>
		  <th rowspan="1" colspan="1">Desconto<br><input type="text" class="filter moneyUSD" name="desconto" value="<?=$_GET['desconto']?>"></th>
		  <? endif;?>
		   <? if(in_array('valor_pago', $fields)): ?>
		  <th rowspan="1" colspan="1">Valor Pago<br><input type="text" class="filter moneyUSD" name="valor_pago" value="<?=$_GET['valor_pago']?>"></th>
		  <? endif;?>
		  <? if(in_array('aparelho', $fields)): ?>
		  <th rowspan="1" colspan="1">Aparelho<br><input type="text" class="filter" name="aparelhos" value="<?=$_GET['aparelhos']?>"></th>
		  <? endif;?>
		  <? if(in_array('paises', $fields)): ?>
		  <th rowspan="1" colspan="1">Países Informados<br><input type="text" class="filter" name="paises" value="<?=$_GET['paises']?>"></th>
		  <? endif;?>

		  <? if(in_array('status_mdn', $fields)): ?>

			  <th width="20" rowspan="1" colspan="1">Status MDN<br>
			  <select  name="m|status"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('status_mdn') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['m|status']?'selected':'')?>><?=$option[status]?></option>
				<?
				 endforeach;
				?>
			  </select>
		      </th>
		  </th>
		  <? endif;?>

		  <? if(in_array('status_simcard', $fields)): ?>
		  <th rowspan="1" colspan="1">Status SIMCARD<br>

			  <select  name="c|status"  class="filter">
				<option value=""></option>
				<?
				 foreach($modelConfig->getOptions('status_simcard') as $option):
				?>
				<option value="<?=$option[ID]?>" <?=($option[ID]==$_GET['c|status']?'selected':'')?>><?=$option[status]?></option>
				<?
				 endforeach;
				?>
			  </select>

	      </th>
		  <? endif;?>

		  <? if(in_array('lote_mdn', $fields)): ?>
		  <th rowspan="1" colspan="1">Lote MDN<br><input type="text" class="filter" name="m|lote" value="<?=$_GET['m|lote']?>"></th>
		  <? endif;?>

		  <? if(in_array('lote_simcard', $fields)): ?>
		  <th rowspan="1" colspan="1">Lote SIMCARD<br><input type="text" class="filter" name="c|lote" value="<?=$_GET['c|lote']?>"></th>
		  <? endif;?>

	      <? if(in_array('voucher', $fields)): ?>
		  <th rowspan="1" colspan="1">Voucher<br><input type="text" class="filter" name="voucher" value="<?=$_GET['voucher']?>"></th>
		  <? endif;?>

		   <? if(in_array('observacao', $fields)): ?>
		  <th rowspan="1" colspan="1">Observações<br><input type="text" class="filter" name="a|observacao" value="<?=$_GET['a|observacao']?>"></th>
		  <? endif;?>
		   <? if(in_array('ocorrencia', $fields)): ?>
		  <th rowspan="1" colspan="1">Tipo<br>
			<select name="ocorrencia" class="filter">
				<option value=""></option>
				<option value="1"  <?=(1==$_GET[ocorrencia]?'selected':'')?>>Venda</option>
				<option value="2"  <?=(2==$_GET[ocorrencia]?'selected':'')?>>Cortesia</option>

			</select>
		  </th>
		  <? endif;?>

			<? if(in_array('motivo_troca', $fields)): ?>
		  <th rowspan="1" colspan="1">Motivo da Troca<br>
			<select name="motivo_troca" class="filter">
				<option value=""></option>
				<option value="1" <?=($_GET[motivo_troca]==1?'selected':'')?>>Técnica</option>
				<option value="2" <?=($_GET[motivo_troca]==2?'selected':'')?>>Por Erro</option>
			</select>
		  </th>
		  <? endif;?>

			<? if(in_array('motivo_ampliacao', $fields)): ?>
		  <th rowspan="1" colspan="1">Motivo da Ampliação<br>
			<select name="motivo_ampliacao" class="filter">
				<option value=""></option>
				<option value="1" <?=($_GET[motivo_ampliacao]==1?'selected':'')?>>Cortesia</option>
				<option value="2" <?=($_GET[motivo_ampliacao]==2?'selected':'')?>>Cobrado</option>
				<option value="3" <?=($_GET[motivo_ampliacao]==3?'selected':'')?>>Por erro</option>
			</select>
		  </th>
		  <? endif;?>

			<? if(in_array('descricao_motivo', $fields)): ?>
		  <th rowspan="1" colspan="1">Descrição do Motivo<br>
			<input type="text" class="filter" name="descricao_motivo" value="<?=$_GET['descricao_motivo']?>">
		  </th>
		  <? endif;?>

		   <? if(in_array('tipo_transacao', $fields)): ?>
		  <th rowspan="1" colspan="1">Tipo da Transação<br>
			<select name="tipo_transacao" class="filter  ">
				<option value="">Selecione</option>
				<option value="1" <?=($_GET[tipo_transacao]==1?'selected':'')?>>Nacional</option>
				<option value="2" <?=($_GET[tipo_transacao]==2?'selected':'')?>>Internacional</option>
			  </select>
		  </th>
		  <? endif;?>

		  <!-- NEW -->


		  <!-- -->

		<? if(!$this->filter && in_array('origem', $fields)): ?>
		  <th  rowspan="1" colspan="1">Origem<br>
			<select  class="filter"  name="origem"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value="">Selecione</option>
				<option value="3" <?=($_GET['origem']==3?'selected':'')?>>Aeroporto</option>
				<option value="2" <?=($_GET['origem']==2?'selected':'')?>>Site</option>
				<option value="4" <?=($_GET['origem']==4?'selected':'')?>>Corporativo</option>
				<option value="1" <?=($_GET['origem']==1?'selected':'')?>>Painel</option>
				<option value="5" <?=($_GET['origem']==5?'selected':'')?>>HD</option>
		   </select>
		  </th>
		  <? endif;?>

	    <? if(in_array('detalhe', $fields)): ?>
		  <th  rowspan="1" colspan="1">Detalhe<br>
			 <input type="text" class="filter" name="detalhe" value="<?=$_GET['detalhe']?>">
		  </th>
		  <? endif;?>

		<? if(in_array('helpdesk', $fields)): ?>
		  <th  rowspan="1" colspan="1">Helpdesk<br>
			 <select  class="filter"  name="helpdesk"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="2"  <?=(2==$_GET['helpdesk']?'selected':'') ?>>Sim</option>
				<option value="1"  <?=(1==$_GET['helpdesk']?'selected':'') ?>>Não</option>

		   </select>
		  </th>
		  <? endif;?>

		<? if(in_array('reembolso', $fields)): ?>
		  <th  rowspan="1" colspan="1">Reembolso<br>
		  <select  class="filter"  name="reembolso"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="2"  <?=(2==$_GET['reembolso']?'selected':'') ?>>Sim</option>
				<option value="1"  <?=(1==$_GET['reembolso']?'selected':'') ?>>Não</option>

		   </select>
		  </th>
		  <? endif;?>
		  <? if(in_array('reembolso', $fields)): ?>
		  <th  rowspan="1" colspan="1">Cancelado<br>
		  <select  class="filter"  name="tipo"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="3"  <?=(2==$_GET['reembolso']?'selected':'') ?>>Sim</option>
				<option value=""  <?=(1==$_GET['reembolso']?'selected':'') ?>>Não</option>

		   </select>
		  </th>
		  <? endif;?>
		 <? if(in_array('nota_d', $fields)): ?>
		  <th  rowspan="1" colspan="1" width="20">N<br>
			<select  class="filter"  name="nota_d"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="A"  <?=(A==$_GET['nota_d']?'selected':'') ?>>A</option>
				<option value="S"  <?=(S==$_GET['nota_d']?'selected':'') ?>>S</option>

		   </select>
		  </th>
		  <? endif;?>
		  <? if(in_array('_status', $fields)): ?>
		  <th  rowspan="1" colspan="1">A<br>
			<select  class="filter"  name="_status"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="1"  <?=(1==$_GET['_status']?'selected':'') ?>>C</option>
				<option value="2"  <?=(2==$_GET['_status']?'selected':'') ?>>H</option>
				<option value="3"  <?=(3==$_GET['_status']?'selected':'') ?>>R</option>
				<option value="4"  <?=(4==$_GET['_status']?'selected':'') ?>>P</option>

		   </select>
		  </th>
		  <? endif;?>

		  <? if(in_array('status', $fields)): ?>
		  <th  rowspan="1" colspan="1">Status<br>
			<select  class="filter"  name="a|status"   class="col-xs-12 col-sm-12 col-lg-12 required">
				<option value=""></option>
				<option value="1"  <?=(1==$_GET['a|status']?'selected':'') ?>>ASAT</option>
				<option value="2"  <?=(2==$_GET['a|status']?'selected':'') ?>>ATVO</option>
				<option value="3"  <?=(3==$_GET['a|status']?'selected':'') ?>>ASDT</option>
				<option value="4"  <?=(4==$_GET['a|status']?'selected':'') ?>>DTVO</option>
		   </select>
		  </th>
		  <? endif;?>

          <th width="80" rowspan="1" colspan="1" align="center" >Ações<br></th>
          </tr>
      </thead>

      <tbody>

          <?
          $_attributes = $model->getList($this->type, '','','','','', $this->filter);

          foreach($_attributes[data] as $_item):
          ?>
          <tr role="row" class="odd">
              <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>

			  <? if(in_array('nome', $fields)): ?>
              <td> <?=$_item[nome]?></td>
			  <? endif;?>

			  <? if(in_array('plano', $fields)): ?>
			  <td><?=$_item[plano]?></td>
			  <? endif;?>

			  <? if(in_array('dias_uso', $fields)): ?>
			  <td><?=$_item[dias_uso]?></td>
			  <? endif;?>

			  <? if(in_array('data_transacao', $fields)): ?>
			  <td><?=$_item[data_transacao]?></td>
			  <? endif;?>

			  <? if(in_array('data_ativacao', $fields)): ?>
			  <td><?=$_item[data_ativacao]?></td>
			  <? endif;?>

			  <? if(in_array('data_off', $fields)): ?>
			  <td>
			  <?
			  $d = explode('/', $_item[data_off]);
			  echo date('d/m/Y', mktime(0,0,0, $d[1], $d[0]+$_item[adiar], $d[2]));
			  ?>
			  <?
			  if($_item[adiar]):
			  ?>
			  <i class="ace-icon fa fa-exclamation-triangle bigger-120 orange pull-right " data-rel="tooltip" title="Data Original: <?=$_item[data_off]?>"></i>
			  <?
			  endif;
			  ?>
			  </td>
			  <? endif;?>

			  <? if(in_array('adiar', $fields)): ?>
			  <td><?=$_item[adiar]?></td>
			  <? endif;?>

			  <? if(in_array('iccid', $fields)): ?>
			  <td><?=$_item[iccid]?></td>
			  <? endif;?>
			   <? if(in_array('fornecedor_simcard', $fields)): ?>
			  <td><?=$_item[fornecedor_simcard]?></td>
			  <? endif;?>
			  <? if(in_array('mdn', $fields)): ?>
			  <td><?=$_item[mdn]?></td>
			  <? endif;?>
			   <? if(in_array('fornecedor_mdn', $fields)): ?>
			  <td><?=$_item[fornecedor_mdn]?></td>
			  <? endif;?>
			  <? if(in_array('emitir_nota', $fields)): ?>
		  	  <td><?=($_item[emitir_nota]==1?'s':'')?></td>
		      <? endif;?>
		 	  <? if(in_array('atendente', $fields)): ?>
		 	  <td><?=$_item[atendente]?></td>
		     <? endif;?>
			 <? if(in_array('area_atuacao', $fields)): ?>
		 	  <td><?=($_item[area_atuacao])?></td>
		     <? endif;?>
		     <? if(in_array('local_venda', $fields)): ?>
			  	<td><?=$_item[local_venda]?></td>
		     <? endif;?>

		     <? if(in_array('ponto_venda', $fields)): ?>
		  		<td><?=$_item[ponto_venda]?></td>
		     <? endif;?>
			<? if(in_array('celular', $fields)): ?>
			<td><?=$_item[celular]?></td>
			<? endif;?>
			<? if(in_array('email', $fields)): ?>
			<td><?=$_item[email]?></td>
			<? endif;?>
			<? if(in_array('documento', $fields)): ?>
			<td><?=$_item[documento]?></td>
			<? endif;?>
			<? if(in_array('local_uso', $fields)): ?>
			<td><?=$_item[local_uso]?></td>
			<? endif;?>
			<? if(in_array('valor_plano', $fields)): ?>
			<td><?=$_item[valor_plano]?></td>
			<? endif;?>
			<? if(in_array('desconto_plano', $fields)): ?>
			<td><?=$_item[desconto_plano]?></td>
			<? endif;?>
				<? if(in_array('valor_dolar_dia', $fields)): ?>
			<td><?=$_item[valor_dolar_dia]?></td>
			<? endif;?>
			<? if(in_array('final_plano', $fields)): ?>
			<td><?=$_item[final_plano]?></td>
			<? endif;?>
			<? if(in_array('forma_pagamento', $fields)): ?>
			<td><?=$_item[forma_pagamento]?></td>
			<? endif;?>
			<? if(in_array('moeda', $fields)): ?>
			<td><?=$_item[moeda]?></td>
			<? endif;?>
			<? if(in_array('desconto', $fields)): ?>
			<td><?=$_item[desconto]?></td>
			<? endif;?>
			<? if(in_array('valor_pago', $fields)): ?>
			<td><?=$_item[valor_pago]?></td>
			<? endif;?>
			<? if(in_array('aparelho', $fields)): ?>
			<td><?=$_item[aparelhos]?></td>
			<? endif;?>
			<? if(in_array('paises', $fields)): ?>
			<td><?=$_item[paises]?></td>
			<? endif;?>
			<? if(in_array('status_mdn', $fields)): ?>
			<td><?=$_item[status_mdn]?></td>
			<? endif;?>
			<? if(in_array('status_simcard', $fields)): ?>
			<td><?=$_item[status_simcard]?></td>
			<? endif;?>
			<? if(in_array('lote_mdn', $fields)): ?>
			<td><?=$_item[lote_mdn]?></td>
			<? endif;?>
			<? if(in_array('lote_simcard', $fields)): ?>
			<td><?=$_item[lote_simcard]?></td>
			<? endif;?>

			<? if(in_array('voucher', $fields)): ?>
			<td><?=$_item[voucher]?></td>
			<? endif;?>
			<? if(in_array('observacao', $fields)): ?>
			<td><?=($_item[observacao]?'<button class="btn btn-xs btn-warning" data-rel="tooltip" data-placement="left" title="'.$_item[observacao].'"><i class="ace-icon fa fa-flag bigger-120"></i></button>':'')?></td>
			<? endif;?>
			<? if(in_array('ocorrencia', $fields)): ?>
			<td>
			  	<?
				  switch($_item[ocorrencia]):

					 case"1":
						echo 'Venda';
					 break;

					 case"2":
						echo 'Cortesia';
					 break;



		          endswitch;
				  ?>

			</td>
			<? endif;?>

			  <? if(in_array('motivo_troca', $fields)): ?>
			<td>
			  	<?
				  switch($_item[motivo_troca]):

					 case"1":
						echo 'Técnica';
					 break;

					 case"2":
						echo 'Por Erro';
					 break;

		          endswitch;
				  ?>

			</td>
			<? endif;?>

			  <? if(in_array('motivo_ampliacao', $fields)): ?>
			<td>
			  	<?
				  switch($_item[motivo_ampliacao]):

					 case"1":
						echo 'Cortesia';
					 break;

					 case"2":
						echo 'Cobrado';
					 break;

					 case"3":
						echo 'Por erro';
					 break;


		          endswitch;
				  ?>

			</td>
			<? endif;?>

			  <? if(in_array('descricao_motivo', $fields)): ?>
			<td><?=$_item[descricao_motivo]?></td>
			<? endif;?>

			<? if(in_array('tipo_transacao', $fields)): ?>
			<td><?=($_item[tipo_transacao]==1?'Nacional':'Internacional')?></td>
			<? endif;?>

			  <? if(!$this->filter && in_array('origem', $fields)): ?>
			<td><?
				  switch($_item[origem]):

					case"1":
					   echo 'PAINEL';
					break;

					case"2":
					   echo 'SITE';
					break;

					case"3":
					   echo 'AERO';
					break;

					case"4":
					   echo 'CORP';
					break;

					case"5":
					   echo 'HD';
					break;

				 endswitch;
				  ?></td>
			<? endif;?>


			  <? if(in_array('detalhe', $fields)): ?>
			<td><?=$_item[detalhe]?></td>
			<? endif;?>

			  <? if(in_array('helpdesk', $fields)): ?>
			<td><?=($_item[helpdesk]==2?'Sim':'Não')?></td>
			<? endif;?>

			<? if(in_array('reembolso', $fields)): ?>
			<td><?=($_item[reembolso]==2?'Sim':'Não')?></td>
			<? endif;?>

			<? if(in_array('cancelamento', $fields)): ?>
			<td><?=($_item[tipo]==3?'Sim':'Não')?></td>
			<? endif;?>


			<? if(in_array('nota_d', $fields)): ?>
			<td><?=($_item[nota_d]?'A':($_item[emitir_nota]?'S':''))?></td>
			<? endif;?>

			<? if(in_array('_status', $fields)): ?>
			<td>
			<?
				  switch($_GET[_status]):

				case"1":
					echo 'C - '.$_item[cancelamento];
				 break;

				 case"2":
					echo 'H';
				 break;

				 case"3":
					echo 'R';
				 break;

				 case"4":
					echo 'P';
				 break;

		          endswitch;
				  ?>
			</td>
			<? endif;?>

			<? if(in_array('motivo_cancelamento', $fields)): ?>
			<td>
				<?=$_item[status]?>
			</td>
			<? endif;?>


			  <? if(in_array('status', $fields)): ?>
			  <td>

				  <?
				  switch($_item[status]):

					case"1":
					echo 'ASAT';
				 break;

				 case"2":
					echo 'ATVO';
				 break;

				 case"3":
					echo 'ASDT';
				 break;

				 case"4":
					echo 'DTVO';
				 break;

		          endswitch;
				  ?>
				 </td>
			  <? endif;?>


             <td align="center">

				<a data-rel="tooltip" title="Exportar" href="<?=HOME_URI.$this->controller."/importTransaction/".$_item[ID]?>"><button class="btn btn-minier bigger btn-success"><i class="ace-icon fa fa-file-excel-o bigger-120"></i></button></a>

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
Total de registros: <strong><?=$_attributes[total]?></strong></div>
</div>


<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
<?=$this->pagi($_attributes[total], $_attributes[page])?>
</div>
</div>


</div>



</div>

<script>

	$(window).load(function(){

		$('.table-content').mCustomScrollbar({axis:"x", theme:"inset-2-dark",mouseWheel:false})

	})

	$(document).ready(function(){


		$('.dailyReport').click(function(){
			$('.filterRegistry').removeClass('filterRegistry').addClass('filterDisabled')

		})

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
</script>
