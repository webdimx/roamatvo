<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class UsuariosModel
{


	public $form_data;
	public $form_msg;
	public $db;
	

	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'users';
	}

	
	public function _submit(){
		
		
		$password_hash = new PasswordHash(8, FALSE); 
		
		$this->form_data = array();
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			
				foreach ($_POST[usuarios]  as $key => $value ) {
					
				$this->form_data[$key] = $value;	
			}
		
		} else {
			
		  return;
		  
		}
		
		
		if(chk_array( $this->form_data, 'action')=='edit'):
		
		
		if($_SESSION[userdata][type]==1):
		$query = $this->db->update($this->table, 'user_id', chk_array( $this->form_data, 'ID'), array(
				
				'name' => chk_array( $this->form_data, 'nome'), 
				'email' => chk_array( $this->form_data, 'email'),
				'grupo' => chk_array( $this->form_data, 'grupo'),
				
		));
		else:
		
		$query = true;
		
		endif;
		
		
		if(chk_array( $this->form_data, 'senha')):
		
		$this->db->update($this->table, 'user_id', chk_array( $this->form_data, 'ID'), array(
				'user_password' => $password_hash->HashPassword(chk_array( $this->form_data, 'senha')), 
		));
		
		endif;
		
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
		
				'name' => chk_array( $this->form_data, 'nome'), 
				'lastname' => chk_array( $this->form_data, 'sobrenome'),
				'user_password' => $password_hash->HashPassword(chk_array( $this->form_data, 'senha')),
				'user_session_id' => md5(time()), 
				'user_name' => chk_array( $this->form_data, 'login'), 
				'user' => chk_array( $this->form_data, 'senha'),
				'email' => chk_array( $this->form_data, 'email'),
				'grupo' => chk_array( $this->form_data, 'grupo'),
				'admin' => chk_array( $this->form_data, 'administrator'),
				'user_permissions' => (chk_array( $this->form_data, 'permissao')?serialize(chk_array( $this->form_data, 'permissao')):''),
				
				
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
	
	
	
	
	public function customFields(){
		
		
		$x=0;
		foreach($_POST[custom][type] as $input):
		
		
		if($_POST[custom][id][$x]):
		
			  if($_POST[custom][remove][$x]):
			  
			  $del = $this->db->delete($this->tableCustom, 'ID', $_POST[custom][id][$x]);
			  
			  else:
			  $query = $this->db->update($this->tableCustom, 'ID', $_POST[custom][id][$x], array(
			  
				  'label' => $_POST[custom][name][$x], 
				  'type' =>  $input, 
				  'order' =>  $_POST[custom][ordem][$x], 
				  'options' => ($_POST[custom][options][$x])?serialize(explode(PHP_EOL,$_POST[custom][options][$x])):''
			  
			  ));
			  endif;
		
		else:
		$query = $this->db->insert($this->tableCustom, array(
				
				'label' => $_POST[custom][name][$x], 
				'code' =>  buildSlug($_POST[custom][name][$x]), 
				'type' =>  $input, 
				'order' =>  $_POST[custom][ordem][$x], 
				'options' => ($_POST[custom][options][$x])?serialize(explode(PHP_EOL,$_POST[custom][options][$x])):''
		));
		
		endif;
		
		$x++;
		endforeach;
		
		
		if ( ! $query ) {
				echo $this->form_msg = 'error';
				// Termina
				return;
			} else {
				echo $this->form_msg = 'success';
				// Termina
				return;
			}
			
		
	}
	
	public function getCustomFields(){
		
		$query = $this->db->query('SELECT *  FROM `'.$this->tableCustom.'` ORDER BY `order` ASC');
		if ( ! $query ) {
		return array();
		}
		
		$fetch = $query->fetchAll();
		return $fetch;
		
	}
	
	public function getCustomInputs($id){
		
		$query = $this->db->query("SELECT * FROM `".$this->tableCustom."` ");
		foreach($query->fetchAll() as $input):
		$fields .= '<div class="col-xs-12">'.getField($input, 'custom',  self::getMetaValue($input[code], $id), '', 'cliente').'</div>';
		endforeach;	
		
		return $fields;
		
		
		
	}
	
	public function getMetaValue($meta, $id){
		
		$query = $this->db->query("SELECT *  FROM `$this->tableMeta` where meta_key = '$meta' and client_id = '$id' ");
		if ( ! $query ) {
		return array();
		}
		
		$fetch = $query->fetch();
		return $fetch[meta_value];
		
	}
	
	public function metaExists($meta, $client){
		
		
		$query = $this->db->query("SELECT *  FROM `$this->tableMeta` where meta_key = '$meta' and client_id = '$client' ");
		if ( ! $query ) {
		return array();
		}
		
		return $fetch = $query->fetch();
		
		
	}
	
	
	
	public function getList() {
	
	
		$query = $this->db->query('SELECT *  FROM `'.$this->table.'` ORDER BY user_id DESC');
		if ( ! $query ) {
		return array();
		}
		
		$fetch = $query->fetchAll();
		return array('data' => $fetch, 'total' => count($fetch));
		
		
	} 
	
	
	public function getRegistry($id) {
	
		$query = $this->db->query("SELECT *  FROM `".$this->table."` where user_id = '".$id."'");
		if ( ! $query ) {
		return array();
		}
		
		
		return $query->fetchAll();
	} 
	
	
	public function getStatus($status){
		
		if($status=='0'):
		
			return array('Desligado', 'danger');
		
		elseif($status=='1'):
		
			return array('Ativo', 'success');
		
		endif;
		
	}
	
	public function getInfo($type, $value){
		
		
		if($type==cpf):
		
		$query = "where $type = '$value'";
		
		elseif($type==telefone):
		
		$query = "where $type = '$value'";
		
		endif;
		
		$query = $this->db->query("SELECT *  FROM `".$this->table."` $query ");
		if ( ! $query ) {
		return array();
		}
		
		return $query->fetchAll();
		
		
	}
	
	
	
	public function del($ids){
		
		foreach(explode(',',$ids) as $id):		
		$del = $this->db->delete($this->table, 'user_id', $id);
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