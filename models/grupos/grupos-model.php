<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class GruposModel
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		$this->db = $db;
		$this->table = 'wd_grupo_de_acesso';
		
	}
	

	public function _submit(){
		
		$this->form_data = array();
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			foreach ($_POST['grupo-de-acesso']  as $key => $value ) {
			$this->form_data[$key] = $value;	
		}} 
		else 
		{
		return;
		}
		
		
		
		
		if(chk_array( $this->form_data, 'action')=='edit'):
		
				$query = $this->db->update($this->table, 'ID', chk_array( $this->form_data, 'ID'), array(
				
				'nome' => chk_array( $this->form_data, 'nome'),
				'permissoes' => (chk_array( $this->form_data, 'permissao')?serialize(chk_array( $this->form_data, 'permissao')):''),
				
				
		));
		
		
		if ( ! $query ) {
		  echo $this->form_msg = 'error_update';
		  return;
		} else {
		  echo $this->form_msg = 'success_update';
		  return;
		}
		
		else:
		
		$query = $this->db->insert($this->table, array(
		
				'nome' => chk_array( $this->form_data, 'nome'),
				'permissoes' => (chk_array( $this->form_data, 'permissao')?serialize(chk_array( $this->form_data, 'permissao')):''),
		));
		
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
			
			default:
			  $qs .= str_replace('|','.', $key)." like '%".$search."%' and ";
		  	break;
			
		  endswitch;
		  
		  }
		
		endforeach;
		
		$qs = ($qs)?'where '.substr($qs, 0, -4):'';
	

		$query = $this->db->query("SELECT * FROM ".$this->table." ORDER BY ID DESC ".($page?"LIMIT ".($page - 1) * 20 .",20":"")."");
		$count  = $this->db->query("SELECT * FROM ".$this->table."  ORDER BY ID DESC");
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);
	}
	
	public function getRegistry($id) {
		
		
		$query = $this->db->query("SELECT *  FROM `".$this->table."`  where ID = '".$id."'  ");
		if ( ! $query ) {
		return array();
		}
		
		
		return $query->fetchAll();
	} 
	
	public function del($ids){
		
		foreach(explode(',',$ids) as $id):		
		$del = $this->db->delete($this->table, 'ID', $id);
		endforeach;
		
		return 'success';
	}
	
	public function checkPer($array, $val, $edit){
		
		if($edit):

		return $check = (in_array($val, $array)?'checked':'');

		else:

		return $check = 'checked';;

		endif;
		
	}
	
}