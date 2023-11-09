<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class ConfiguracoesModel
{


	public $form_data;
	public $form_msg;
	public $db;
	

	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'users';
		$this->tableCategory = 'wd_categorias';
		$this->tableRoom = 'wd_salas';
		$this->tableModalidades = 'wd_modalidades';
		$this->tableNivel = 'wd_niveis';
		$this->tableFields = 'wd_campos_personalizados';
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
		
		
		$query = $this->db->update($this->table, 'user_id', chk_array( $this->form_data, 'ID'), array(
				
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
	
	
	
	
	public function del($ids, $table){
		
		foreach(explode(',',$ids) as $id):		
		$del = $this->db->delete($table, 'ID', $id);
		endforeach;
		
		

		
		
		return 'success';
	}
	
	public function getOptions($table, $status, $filter, $alias){
		
		
		$query = $this->db->query('SELECT a.*  FROM `wd_'.$table.'` a '.($status?"where situacao = '1' ".($filter?" and exibir_transacao = '2' ":'')." ":'').'  '.($table=='fornecedores'?'order by '.($filter?'apelido':'nome').' ASC':'').' '.($table=='local_de_uso'?'order by local ASC':'').' '.($table=='planos'?'order by nome ASC':'').' ');
		
		if ( ! $query ) {
			return array();
			
		}
		
		return  $query->fetchAll();
		
	}
	
	public function getDetail($table, $id, $field){
		
		$query = $this->db->query("SELECT a.*  FROM `wd_".$table."` a where ID = '".$id."'  ");
		
		if ( ! $query ) {
			return array();
			
		}
		
		$data = $query->fetch();
		
		return  $data[$field];
		
	}
	
	
	
	public function getListAssociate(){
		
		
		$query = $this->db->query("select concat(b.nome,'/',c.nome) as fornecedor, concat(a.fornecedor_simcard,',',a.fornecedor_mdn) as value from wd_mdn a LEFT JOIN wd_fornecedores b ON a.fornecedor_simcard = b.ID LEFT JOIN wd_fornecedores c ON a.fornecedor_mdn = c.ID where a.fornecedor_simcard != '' and a.fornecedor_mdn != '' group by a.fornecedor_simcard, a.fornecedor_mdn order by b.nome");
		
		
		if ( ! $query ) {
			return array();
			
		}
		
		$data = $query->fetchAll();
		
		return  $data;
	}
	
	
	
	
}