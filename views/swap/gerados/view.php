<?
$data = $this->data[0];

?>
<div class=" page-box" id="informacoes" style="opacity: 1;">

 <table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <thead>
          <tr role="row">
            
			<th rowspan="1" colspan="1" width="20%">MDN</th>
			<? if($data[tipo]!=2): ?><th rowspan="1" colspan="1" width="20%">SIMCARD ANTIGO</th><? endif; ?>
			<? if($data[tipo]!=2): ?><th rowspan="1" colspan="1" width="20%">ÚLTIMA  DESATIVAÇÃO</th><? endif; ?>
			<th rowspan="1" colspan="1" width="20%"><?=($data[tipo]==1?'NOVO SIMCARD':'SIMCARD A SER DESATIVADO')?></th>
			<th rowspan="1" colspan="1" width="20%">NOME</th>
			<th rowspan="1" colspan="1" width="20%">ATIVAÇÃO</th>
			<th rowspan="1" colspan="1" width="20%">PLANO</th>
			<th rowspan="1" colspan="1" width="20%">DIAS</th>
			<th rowspan="1" colspan="1" width="20%">DESATIVAÇÃO</th>
			<th rowspan="1" colspan="1" width="20%">REPATRIADO</th>
          </tr>
      </thead>

      <tbody>
      
          <?
          $_attributes = $model->getSwapItens($data[ID]);
          
          foreach($_attributes as $_item):
		  
		  $last = $model->getLastInfo(($_item[tipo]?$_item[da]:$_item[data_off]), $_item[mdn], $data[tipo]);
		  
		  
          ?>
          <tr role="row" class="odd">
			  
              <td><?=$_item[mdn]?></td>
			  <? if($data[tipo]!=2): ?><td><?=$last[iccid]?></td><? endif; ?>
			  <? if($data[tipo]!=2): ?><td><?=$last[data_off]?></td><? endif; ?>
			  <td><?=$_item[iccid]?></td>
			  <td><?=$_item[nome]?></td>
			  <td><?=$_item[data_ativacao]?></td>
			  <td><?=$_item[plano]?></td>
			  <td><?=$_item[dias]?></td>
			  <td><?=$_item[data_desativacao]?></td>
			  <td><?=($_item[repatriado]?'Sim':'')?></td>
		  </tr>
          <?
          endforeach;
          ?>
     </tbody>
</table>
</div>
<div class="test">


<div id="demo" style="display: none">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
      <tbody>
          <?
          $_attributes = $model->getSwapItens($data[ID]);
          
          foreach($_attributes as $_item):
		  
		  $last = $model->getLastInfo(($_item[tipo]?$_item[da]:$_item[data_off]), $_item[mdn], $data[tipo]);
		  
		  
          ?>
          <tr role="row" class="odd">
			  
              <td><?=$_item[mdn]?></td>
			  <td><?=$_item[iccid]?></td>
		  </tr>
          <?
          endforeach;
          ?>
     </tbody>
</table>
</div>
	
	
<script>
	$(document).ready(function(){
		
		function copy(element_id){
		  var aux = document.createElement("div");
		  aux.setAttribute("contentEditable", true);
		  aux.innerHTML = document.getElementById(element_id).innerHTML;
		  aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
		  document.body.appendChild(aux);
		  aux.focus();
		  document.execCommand("copy");
		  document.body.removeChild(aux);
		}
		
		$('.cc').click(function(){
			
			copy('demo')
			
			$('#modal-alert .modal-body').html('Copiado para área de Transferência!')
			$('#modal-alert').modal('show');
			
		})
		
		
	})
</script>
        