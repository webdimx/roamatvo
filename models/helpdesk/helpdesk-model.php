<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class FinanceiroModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'wd_financeiro';
		$this->tableStudent = 'wd_alunos';
		//self::markPast();
	}

	public function _submit(){
		
		$this->form_data = array();
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			foreach ($_POST[financeiro]  as $key => $value ) {
			$this->form_data[$key] = $value;	
		}} 
		else 
		{
		return;
		}
		
		
		if(chk_array( $this->form_data, 'action')=='edit'):
		
				$query = $this->db->update($this->table, 'ID', chk_array( $this->form_data, 'ID'), array(
				
				
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => dateDB(chk_array( $this->form_data, data_vencimento)),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'data_desconto' =>  (chk_array( $this->form_data, 'data_desconto')?dateDB(chk_array( $this->form_data, 'data_desconto')):NULL),
				'valor_desconto' => (chk_array( $this->form_data, 'valor_desconto')? formatMoney(chk_array( $this->form_data, 'valor_desconto')): '0'),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => (chk_array( $this->form_data, 'data_multa')?dateDB(chk_array( $this->form_data, 'data_multa')):''),
				'valor_multa' => (chk_array( $this->form_data, 'valor_multa')?formatMoney(chk_array( $this->form_data, 'valor_multa')):'0.00'),
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
				'negativar_protestar' => chk_array( $this->form_data, 'negativar_protestar'),
				'tipo' => chk_array( $this->form_data, 'tipo'),
				
				
		));
		
		
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' editou a fatura nº  '.chk_array( $this->form_data, 'ID').'.');
		
		
		if ( ! $query ) {
		  echo $this->form_msg = 'error_update';
		  return;
		} else {
		  echo $this->form_msg = 'success_update';
		  return;
		}
		
		else:
		
		// Boleto mensalidade
		
		
		if(chk_array( $this->form_data, 'tipo')==1):
		
		
		$last = self::lastPortion(chk_array( $this->form_data, 'aluno_id'));
		
		$data = explode('/', chk_array( $this->form_data, 'data_vencimento'));
		$data_desconto = explode('/', chk_array( $this->form_data, 'data_desconto'));
		$data_multa = explode('/', chk_array( $this->form_data, 'data_multa'));
		$prazo = explode('/', chk_array( $this->form_data, 'prazo'));
		
		
		$x = 0;
		for($i=0+$last;$i<=2+$last;$i++):
		
		
		$query = $this->db->insert($this->table, array(
			
			
			
		
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
			    'parcela' => $i+1,
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => date('Y-m-d', mktime(0,0,0, $data[1]+$x, $data[0], $data[2])),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'data_desconto' =>  date('Y-m-d', mktime(0,0,0, $data_desconto[1]+$x, $data_desconto[0], $data_desconto[2])),
				'valor_desconto' => (chk_array( $this->form_data, 'valor_desconto')? formatMoney(chk_array( $this->form_data, 'valor_desconto')): '0'),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => date('Y-m-d', mktime(0,0,0, $data_multa[1]+$x, $data_multa[0], $data_multa[2])),
				'valor_multa' => formatMoney(chk_array( $this->form_data, 'valor_multa')),
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
			    'tipo' => chk_array( $this->form_data, 'tipo'),
			    'negativar_protestar' => chk_array( $this->form_data, 'negativar_protestar'),
				
				
		));
		
		$last_id = $this->db->last_id;
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' adicionou a fatura nº  '.$last_id.'.');
		
		$x++;
		endfor;
		
		
		
		
		
		// Boleto MHA
		
		elseif(chk_array( $this->form_data, 'tipo')==2):
		
		$data = explode('/', chk_array( $this->form_data, 'data_vencimento'));
		$data_desconto = explode('/', chk_array( $this->form_data, 'data_desconto'));
		$data_multa = explode('/', chk_array( $this->form_data, 'data_multa'));
		$prazo = explode('/', chk_array( $this->form_data, 'prazo'));
		
		
		$query = $this->db->insert($this->table, array(
			
			
			
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => date('Y-m-d', mktime(0,0,0, $data[1], $data[0], $data[2])),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => date('Y-m-d', mktime(0,0,0, $data_multa[1], $data_multa[0], $data_multa[2])),
				'valor_multa' => (chk_array( $this->form_data, 'valor_multa')?formatMoney(chk_array( $this->form_data, 'valor_multa')):'0.00'),
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
			    'tipo' => chk_array( $this->form_data, 'tipo')
				
				
		));
			
		
		$last_id = $this->db->last_id;
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' adicionou a fatura nº  '.$last_id.'.');
		
		
		//Material e Mensalidade
		
			
		else:
		
		$data = explode('/', chk_array( $this->form_data, 'data_vencimento'));
		$data_desconto = explode('/', chk_array( $this->form_data, 'data_desconto'));
		$data_multa = explode('/', chk_array( $this->form_data, 'data_multa'));
		$prazo = explode('/', chk_array( $this->form_data, 'prazo'));
		
		$query = $this->db->insert($this->table, array(
			
			
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
			    //'parcela' => $i+1,
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => date('Y-m-d', mktime(0,0,0, $data[1], $data[0], $data[2])),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'data_desconto' =>  date('Y-m-d', mktime(0,0,0, $data_desconto[1], $data_desconto[0], $data_desconto[2])),
				'valor_desconto' => (chk_array( $this->form_data, 'valor_desconto')? formatMoney(chk_array( $this->form_data, 'valor_desconto')): '0'),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => date('Y-m-d', mktime(0,0,0, $data_multa[1], $data_multa[0], $data_multa[2])),
				'valor_multa' => formatMoney(chk_array( $this->form_data, 'valor_multa')),
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
			    'tipo' => chk_array( $this->form_data, 'tipo')
				
				
		));
		
		
		$last_id = $this->db->last_id;
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' adicionou a fatura nº  '.$last_id.'.');
		
		
		
		endif;
		
		$last_id = $this->db->last_id;
		
		
		if ( ! $query ) {
			echo $this->form_msg = 'error';
			return;
		} else {
			echo $this->form_msg = 'success';
			return;
		}
		
		endif;
			
	}
	
	
	public function __geraFatura(){
		
		
			$query = $this->db->insert($this->table, array(
			
			
			
		
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => date('Y-m-d', mktime(0,0,0, $data[1], $data[0], $data[2])),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'data_desconto' =>  date('Y-m-d', mktime(0,0,0, $data_desconto[1], $data_desconto[0], $data_desconto[2])),
				'valor_desconto' => (chk_array( $this->form_data, 'valor_desconto')? formatMoney(chk_array( $this->form_data, 'valor_desconto')): '0'),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => date('Y-m-d', mktime(0,0,0, $data_multa[1], $data_multa[0], $data_multa[2])),
				'valor_multa' => formatMoney(chk_array( $this->form_data, 'valor_multa')),
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
			    'tipo' => '2'
				
				
		));	
		
		
	}
	
	
	public function _multaSubmit(){
		
		$this->form_data = array();
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			foreach ($_POST[financeiro]  as $key => $value ) {
			$this->form_data[$key] = $value;	
		}} 
		else 
		{
		return;
		}
		
		
		if(chk_array( $this->form_data, 'action')=='edit'):
		
				$query = $this->db->update($this->table, 'ID', chk_array( $this->form_data, 'ID'), array(
				
				
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => dateDB(chk_array( $this->form_data, data_vencimento)),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'data_desconto' =>  dateDB(chk_array( $this->form_data, 'data_desconto')),
				'valor_desconto' => (chk_array( $this->form_data, 'valor_desconto')? formatMoney(chk_array( $this->form_data, 'valor_desconto')): '0'),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => dateDB(chk_array( $this->form_data, 'data_multa')),
				'valor_multa' => formatMoney(chk_array( $this->form_data, 'valor_multa')),	
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
				
				
		));
		
		
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' editou a multa hora aula nº  '.chk_array( $this->form_data, 'ID').'.');
		
		if ( ! $query ) {
		  echo $this->form_msg = 'error_update';
		  return;
		} else {
		  echo $this->form_msg = 'success_update';
		  return;
		}
		
		else:
		
		
		
		$last = self::lastPortion(chk_array( $this->form_data, 'aluno_id'));
		
		$data = explode('/', chk_array( $this->form_data, 'data_vencimento'));
		$data_desconto = explode('/', chk_array( $this->form_data, 'data_desconto'));
		$data_multa = explode('/', chk_array( $this->form_data, 'data_multa'));
		$prazo = explode('/', chk_array( $this->form_data, 'prazo'));
		
		
		
		
		
		$query = $this->db->insert($this->table, array(
			
			
			
		
				'aluno_id' => chk_array( $this->form_data, 'aluno_id'),
				'valor' => formatMoney(chk_array( $this->form_data, 'valor')),
			    //'parcela' => $i+1,
				'forma_pagamento' => chk_array( $this->form_data, 'forma_pagamento'),
				'data_vencimento' => date('Y-m-d', mktime(0,0,0, $data[1], $data[0], $data[2])),
				'juros_dia' => formatMoney(chk_array( $this->form_data, 'juros_dia')),
				'data_desconto' =>  date('Y-m-d', mktime(0,0,0, $data_desconto[1], $data_desconto[0], $data_desconto[2])),
				'valor_desconto' => (chk_array( $this->form_data, 'valor_desconto')? formatMoney(chk_array( $this->form_data, 'valor_desconto')): '0'),
				'prazo' => chk_array( $this->form_data, 'prazo'),	
				'data_multa' => date('Y-m-d', mktime(0,0,0, $data_multa[1], $data_multa[0], $data_multa[2])),
				'valor_multa' => formatMoney(chk_array( $this->form_data, 'valor_multa')),
				'status' => chk_array( $this->form_data, 'status'),
				'observacoes' => chk_array( $this->form_data, 'observacoes'),
			    'tipo' => '2'
				
				
		));
		
		
		
		
		$last_id = $this->db->last_id;
		
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' adicionou a multa hora aula nº  '.$last_id.'.');
		
		
		if ( ! $query ) {
			echo $this->form_msg = 'error';
			return;
		} else {
			echo $this->form_msg = 'success';
			return;
		}
		
		endif;
			
	}
	
	public function geraFatura(){
		
		
		
		
	}
	
	public function getList() {
		
		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		unset($_GET[path], $_GET[p]);
		
		foreach($_GET as $key => $search):
		
		  if($search){
			  
		  switch($key):
		  
		  	case"ID":
		  	  $qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  	break;
			
			case"email":
			
				$qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  
		  	break;
			
			case"valor":
			
				$qs .=  $key." = '".formatMoney($search)."' and ";
		  
		  	break;
			
			case"data_vencimento":
			
				$qs .=  "date(".$key.") = '".dateDB($search)."' and ";
		  
		  	break;
			
			case"status":
			
				$qs .=  $key." = '".$search."' and ";
		  
		  	break;
			
			default:
			  $qs .= str_replace('|','.', $key)." like '%".$search."%' and ";
		  	break;
			
		  endswitch;
		  
		  }
		
		endforeach;
		
		$qs = ($qs)?'where '.substr($qs, 0, -4):'';
	
		
		$query = $this->db->query('SELECT a.*, b.nome  FROM '.$this->table.' a LEFT JOIN '.$this->tableStudent.' b ON a.aluno_id = b.ID '.$qs.' ORDER BY ID DESC '.($page?"LIMIT ".($page - 1) * 20 .",20":"").'');
		$count = $this->db->query('SELECT a.*, b.nome  FROM '.$this->table.' a LEFT JOIN '.$this->tableStudent.' b ON a.aluno_id = b.ID '.$qs.' ORDER BY ID DESC');
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);
	}
	
	public function getRegistry($id) {
	
		$query = $this->db->query("SELECT a.*, b.nome  FROM `".$this->table."` a LEFT JOIN `".$this->tableStudent."` b ON a.aluno_id = b.ID   where a.ID = '".$id."' ");
		if ( ! $query ) {
		return array();
		}
		
		
		return $query->fetchAll();
	} 
	
	
	
	public function getListPendent() {
		
		
		$query = $this->db->query("select a.*, b.nome, b.email  from wd_financeiro a LEFT JOIN wd_alunos b On a.aluno_id = b.ID  where datediff(data_vencimento, now()) = '10' and b.boleto = '2'");
		
		if ( ! $query ) {
			return array();
		}
		
		return $query->fetchAll();
	}
	
	public function del($ids){
		
		foreach(explode(',',$ids) as $id):		
		
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' deletou o boleto nº '.$id.'');
		
		$del = $this->db->delete($this->table, 'ID', $id);
		endforeach;
		
		return 'success';
	}
	
	
	public function lastPortion($id){
		
		$query = $this->db->query("SELECT parcela  FROM `".$this->table."`  where aluno_id = '".$id."' order by parcela DESC Limit 0,1 ");
		if ( ! $query ) {
		return array();
		}
		
		$data = $query->fetch();
		
	return $data[parcela];
		
		
		
	}
	
	public function getStatus($status){
		
		
	  if($status==1):
	  	return '<span class="label label-lg label-warning"><i class="ace-icon fa fa-clock-o bigger-120"></i> Pendente</span>';
	  elseif($status==2):
	  	return '<span class="label label-lg label-success"><i class="ace-icon fa fa-check bigger-120"></i> Pago</span>';
	   elseif($status==4):
	  	return '<span class="label label-lg label-danger"><i class="ace-icon fa fa-close bigger-120"></i> Vencido</span>';
	  else:
	  	return '<span class="label label-lg label-info"><i class="ace-icon fa fa-handshake-o bigger-120"></i> Acordo</span>';
	  endif;

		
	}
	
	public function getBillings($id, $pendentOnly){
		
		
		$query = $this->db->query("SELECT * FROM `".$this->table."` where aluno_id = '".$id."'   ".($pendentOnly?" and( status = '4' or status = '1') ":'')." Order by data_vencimento ");
		
		if ( ! $query ) {
		return array();
		}
		
		return $query->fetchAll();
		
		
	}
	
	public function getBilling($id){
		
		
		$query = $this->db->query("SELECT * FROM `".$this->table."` where aluno_id = '".$id."'  ORDER by ID DESC LIMIT 0,1 ");
		
		if ( ! $query ) {
		return array();
		}
		
		return $query->fetch();
		
		
	}
	
	public function geraBoleto($id, $link){
		
		return '<a target="_blank" href="'.HOME_URI.'financeiro/boleto/'.$this->Crypta($id).'">'.($link?HOME_URI.'financeiro/boleto/'.$this->Crypta($id):'Gerar Boleto').'</a>';
		
	}
	
	public function boletoInfo($id){
		
		
		$query = $this->db->query("SELECT a.*, a.ID as boleto_id,  b.* FROM `".$this->table."` a LEFT JOIN ".$this->tableStudent." b ON a.aluno_id = b.ID where a.ID = '".$id."'");
		
		if ( ! $query ) {
		return array();
		}
		
		return $query->fetch();
		
		
		
	}
	public function boletosInfo($id){
		
		
		
		$query = $this->db->query("SELECT a.*, a.ID as boleto_id,  b.* FROM `".$this->table."` a LEFT JOIN ".$this->tableStudent." b ON a.aluno_id = b.ID where a.aluno_id = '".$id."' order by parcela desc limit 0,3");
		
		if ( ! $query ) {
		return array();
		}
		
		return $query->fetchAll();
		
		
		
	}
	
	public function getBoletoRemessa(){
		
		
		$query = $this->db->query("SELECT a.*, a.ID as boleto_id,  b.* FROM `".$this->table."` a LEFT JOIN ".$this->tableStudent." b ON a.aluno_id = b.ID where a.registrado = '1' and forma_pagamento = '3' ");
		
		if ( ! $query ) {
		return array();
		}
		
		$fetch = $query->fetchAll();
		
		
		return $fetch;
		
	}
	
	public function mark($id){
		
		$this->db->update($this->table, 'ID', $id, array(
			
			'registrado' => 2 
		));
		
	}
	
	public function payment($id){
		
		$this->db->update($this->table, 'ID', ($id?$id:$_POST[id]), array(
			
			'status' => 2 
		));
		
		
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' marcou o boleto nº '.$_POST[id].' como pago.');
		
	}
	
	public function markPast(){
		
		
		$query = $this->db->query("select ID, aluno_id, tipo from wd_financeiro where datediff(data_vencimento, now()) = -1 and status = '1'");
		
		if ( ! $query ) {
		return array();
		}
		
		foreach($query->fetchAll() as $at){
			
			$this->db->update('wd_financeiro', 'ID', $at[ID], array(
			
			'status' => 4 
		));
			
		// Alerts
		
			
		switch($at[tipo]){
			
		case"1":
			
			MainController::alert($_SESSION[userdata][user_id], $at[aluno_id],  $at[ID],  3);
			
		break;
			
		case"2":
			
				echo 1;
			MainController::alert($_SESSION[userdata][user_id], $at[aluno_id], $at[ID], 4);
			
		break;
			
		case"4":
			
			MainController::alert($_SESSION[userdata][user_id],  $at[aluno_id], $at[ID], 7);
			
		break;
			
			
		case"5":
			
			MainController::alert($_SESSION[userdata][user_id], $at[aluno_id], $at[ID], 5);
			
		break;
			
		
			
	   }
			
			
		}
		
		
	}
	
	
	
}