<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class ColaboradoresModel
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		$this->db = $db;
		$this->table = 'wd_colaboradores';
		$this->tableCategory = 'wd_categorias';
		$this->tableUser = 'users';
	}

	public function _submit(){
		
		$password_hash = new PasswordHash(8, FALSE);
		
		$this->form_data = array();
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			foreach ($_POST[colaboradores]  as $key => $value ) {
			$this->form_data[$key] = $value;	
		}} 
		else 
		{
		return;
		}
		
		
		if(chk_array( $this->form_data, 'action')=='edit'):
		
						
		$query = $this->db->update($this->table, 'ID', chk_array( $this->form_data, 'ID'), array(
				
				
				'nome' => chk_array( $this->form_data, 'nome'),
			    'celular' => chk_array( $this->form_data, 'celular'),
				'email' => chk_array( $this->form_data, 'email'),
				'status' => chk_array( $this->form_data, 'status'),
			    'observacao' => chk_array( $this->form_data, 'observacao'),
				
		));
		
		
		$query = $this->db->update($this->tableUser, 'entity_id', chk_array( $this->form_data, 'ID'), array(
				
				
				'email' => chk_array( $this->form_data, 'email'),
			    'grupo' => chk_array( $this->form_data, 'grupo'),
			    'status' => chk_array( $this->form_data, 'situacao'),
			    
				
		));
		
		
		
		
		if(chk_array( $this->form_data, 'senha')):
		$this->db->custom("update $this->tableUser set  user_password = '".$password_hash->HashPassword(chk_array( $this->form_data, 'senha'))."' where entity_id = '".chk_array( $this->form_data, 'ID')."' and type = '3' ");
		endif;
		
		
		
		
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
			    'celular' => chk_array( $this->form_data, 'celular'),
				'email' => chk_array( $this->form_data, 'email'),
			    'observacao' => chk_array( $this->form_data, 'observacao'),
		));
		
		$last_id = $this->db->last_id;
		
		if($last_id):
		
		$this->db->insert($this->tableUser, array(
		
			'entity_id' => $last_id,
			'email' => chk_array( $this->form_data, 'email'),
			'user_password' => $password_hash->HashPassword(chk_array( $this->form_data, 'senha')),
			'user_session_id' => md5(time()), 
			'type' => 3,
			'status' => chk_array( $this->form_data, 'situacao'),
			'grupo' => chk_array( $this->form_data, 'grupo'),
			
				
		));
		
		endif;
		
		
		
		
		
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
		
		

		$query = $this->db->query('SELECT a.*, b.status as status FROM '.$this->table.' a LEFT JOIN `'.$this->tableUser.'` b ON a.ID = b.entity_id  '.$qs.'   ORDER BY ID DESC '.($page?"LIMIT ".($page - 1) * 20 .",20":"").'');
		$count = $this->db->query('SELECT a.* FROM '.$this->table.' a  LEFT JOIN `'.$this->tableUser.'` b ON a.ID = b.entity_id  '.$qs.'   ORDER BY ID DESC');
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);
	}
	
	public function getRegistry($id) {
	
		$query = $this->db->query("SELECT a.*, b.grupo, b.status as situacao  FROM `".$this->table."` a LEFT JOIN `".$this->tableUser."` b ON a.ID = b.entity_id where ID = '".$id."' and b.type = '3' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
		
		
		return $query->fetchAll();
	} 
	
	public function del($ids){
		
		foreach(explode(',',$ids) as $id):		
		
		MainController::log($_SESSION[userdata][user_id], 'O colaborador '.$_SESSION[userdata][name].' deletou o colaborador '.MainController::geTlogInfo($this->table, $id, 'nome').'.');
		
		$del = $this->db->delete($this->table, 'ID', $id);
		$del = $this->db->delete('users', 'entity_id', $id);
		endforeach;
		
		return 'success';
	}
	
}