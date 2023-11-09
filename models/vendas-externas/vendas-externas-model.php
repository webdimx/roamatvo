<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class VendasExternasModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'wd_transacoes';
		$this->tableSIM = 'wd_simcards';
		$this->tableMdn = 'wd_mdns';
		
	}
	
	

	
	
	
	
	
	
	
	
	
	
}