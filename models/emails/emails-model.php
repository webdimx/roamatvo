<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class EmailsModel
{


	public $form_data;
	public $form_msg;
	public $db;
	

	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'so_emails';
	}
	

	
	public function insert(){
		
		
		$this->form_data = array();
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			
			
			
				foreach ($_POST[emails]  as $key => $value ) {
					
				$this->form_data[$key] = $value;	
			}
		
		} else {
			return;
		}
		
		
		if(chk_array( $this->form_data, 'action')=='edit'):
		
		
		$query = $this->db->update($this->table, 'ID', chk_array( $this->form_data, 'ID'), array(
				'nome' => chk_array( $this->form_data, 'nome'), 
				'assunto' => chk_array( $this->form_data, 'assunto'),
				'mensagem' => chk_array( $this->form_data, 'mensagem'),
				'onlyImage' => chk_array( $this->form_data, 'onlyImage'),
				
				
		));
		if ( ! $query ) {
				echo $this->form_msg = 'error_update';
				// Termina
				return;
			} else {
				echo $this->form_msg = 'success_update';
				// Termina
				return;
		}
		
			
		
		else:
		
		$query = $this->db->insert($this->table, array(
		
				'nome' => chk_array( $this->form_data, 'nome'), 
				'assunto' => chk_array( $this->form_data, 'assunto'),
				'mensagem' => chk_array( $this->form_data, 'mensagem'),
				'onlyImage' => chk_array( $this->form_data, 'onlyImage'),
				
		));
		
		if ( ! $query ) {
				echo $this->form_msg = 'error';
				// Termina
				return;
			} else {
				echo $this->form_msg = 'success';
				// Termina
				return;
			}
		
		endif;
		
		
			
		return $this->form_msg;
		
	}
	
	public function getList() {
		
		
		
		unset($_GET[path]);
		
		foreach($_GET as $key => $search):
		
		  if($search){
			  
		  switch($key):
		  
		  	case"ID":
		  	  $qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  	break;
			
			
			
			default:
			  $qs .= str_replace('|','.', $key)." like '%".$search."%' and ";
		  	break;
			
		  endswitch;
		  
		  }
		
		endforeach;
		
		$qs = ($qs)?'where '.substr($qs, 0, -4):'';
	

		$query = $this->db->query('SELECT * FROM '.$this->table.' '.$qs.' ORDER BY ID DESC');
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($fetch));
	}
	
	public function getRegistry($id) {
	
		$query = $this->db->query("SELECT *  FROM `".$this->table."` where ID = '".$id."' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
		
		 ;
		return ( $query->fetchAll());
	} 
	
	function del($ids, $table){
		
		foreach(explode(',',$ids) as $id):		
		$del = $this->db->delete(($table?$table:$this->table), 'ID', $id);
		endforeach;
		return 'success';	
		
	}

	
	
}