<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class CronModel 
{
	
	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		
		
		
		echo 1;
		
	}
	
	
	private function sendSmsAlert(){
		
		$query = $this->db->query("Select * from so_orders where type = '1' ");
			
		if(!$query):
		return array();
		endif;
		
		foreach($query->fetchAll() as $_item):
		
			echo $_item[0];
		
		endforeach;
		
		
		
	}	
	
	private function sendSurvey(){
		
		$query = $this->db->update($this->table, 'ID', $id, array('tipo' => 2));
			
		if($query):
		return 'success';
		endif;
		
	}	
	
	public function run(){
		
		$this->sendSmsAlert();
		$this->sendSurvey();
		
		
	}
	
	
	
	

	
}