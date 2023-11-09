<?php 
if ( ! defined('ABSPATH')) exit; 
?>

<script>
	controller='<?=$this->controller?>'+'/alertas'
	controllerUrl='<?=HOME_URI.$this->controller?>/alertas'
</script>

<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">



<div class="dt-buttons btn-overlap btn-group">
<div class="btn-group btn-corner">
  
    <a href="#modal-confirm" data-toggle="modal" class="btn btn-info  btn-sm  delete " data-table="wd_alertas"><i class="fa fa-check "></i> Marcar selecionados como resolvido</a>
</div>
</div>


<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
          <td align="center" width="10"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$_item[ID]?>"><span class="lbl"></span></label></td>
          <th rowspan="1" colspan="1">Notificação<br><input type="text" class="filter " style="max-width:40%" name="busca" value="<?=$_GET[busca]?>" placeholder="Pesquisar por Nome, ID, Aula ou Pauta"></th>
          <th width="120" rowspan="1" colspan="1">Data <input type="text" class="filter date-picker " data-date-format="dd/mm/yyyy"  name="data" value="<?=$_GET['data']?>"></th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getAlerts();
          
          foreach($_attributes[data] as $alert):
	
	
		  $txt = array(
		
			array('link' => 'javascript:;', 'text' => '{aluno} com ID nº {cod} faltou na aula {nome}'),
			array('link' => HOME_URI.'agendamento/editar/{target_id}', 'text' => '{aluno} com ID nº {cod} desmarcou a aula {nome}.'),
			array('link' => HOME_URI.'agendamento/editar/{target_id}', 'text' => 'Foi desmarcada a aula {nome} do aluno {aluno} com ID nº {cod}.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'A fatura {cod} referente a mensalidade venceu hoje.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'A fatura {cod} referente a multa venceu hoje.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'A fatura {cod} referente a matricula venceu hoje.'),
			array('link' => 'javascript:;', 'text' => 'Foi gerada uma nova multa hora aula para {aluno} com matricula nº {cod}.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'A fatura {cod} referente a material venceu hoje.')
		
		 );
		  
          ?>
          
          <tr role="row" class="odd">
			  
             <td align="center"><label class="pos-rel"><input  name="item_id[]" type="checkbox" class="ace item_id" value="<?=$alert[ID]?>"><span class="lbl"></span></label></td>
              
			  
			  <td>
				 
				  <a href="<?=str_replace(array('{cod}', '{target_id}', '{aluno}'), array($alert[codigo], $alert[target_id], $alert[aluno]), $txt[$alert[type]][link])?>">
					  
					  
				  <?=str_replace(array('{cod}', '{nome}', '{aluno}'), array($alert[codigo], $alert[nome], $alert[aluno]), $txt[$alert[type]][text])?></a></td>
              
			  
			  <td><?=formatDate($alert[data])?></td>
			  
		  </tr>
                        
          <?
          endforeach;
          ?>
     </tbody>
</table>
  
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
