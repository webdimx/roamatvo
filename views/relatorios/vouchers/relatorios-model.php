<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class RelatoriosModel extends MainController
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

	
	
	public function SellReport(){
		
		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		
		unset($_GET[path], $_GET[p]);
		
		if($_GET[sedex]=='0'):
		
			$qs .= str_replace('|','.', 'sedex')." = '".$_GET[sedex]."' and ";
		
		endif;
		
		foreach($_GET as $key => $search):
		
		  if($search){
			  
		  switch($key):
			  
		  
		  	case"ID":
		  	  $qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  	break;
			
			case"email":
			
				$qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  
		  	break;
			
			case"valor_total":
			
				$qs .=  $key." = '".formatMoney($search)."' and ";
		  
		  	break;
			
			 case"data_compra":
				
			  	$search = explode('-', $search);
			  
			    if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;
		  
		  	break;
			  
			case"data_retirada":
				
			  	$search = explode('-', $search);
			  
			    if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;
		  
		  	break;
			  
			case"valor_base":
			
				$qs .=  $key." = '".formatMoney($search)."' and ";
		  
		  	break;
			  
			case"a|valor_dolar":
			
				$qs .=  str_replace('|','.', $key)." = '".formatMoney($search)."' and ";
		  
		  	break;
			  
			case"valor_total":
			
				$qs .=  $key." = '".formatMoney($search)."' and ";
		  
		  	break;
			  
			  
			
			case"status_compra":
			
				$qs .=  $key." = '".$search."' and ";
		  
		  	break;
			
			case"resgatado":
			
				$qs .=  $key." = '".$search."' and ";
		  
		  	break;
			
			default:
			  $qs .= str_replace('|','.', $key)." like '%".trim($search)."%' and ";
		  	break;
			
		  endswitch;
		  
		  }
		
		endforeach;
		
		$qs = ($qs)?'where '.substr($qs, 0, -4):'';
		
		
		$query = $this->db->query("SELECT a.*, b.nome AS plano, c.`ponto` AS ponto_venda, if(sedex=1, 'Sedex', 'Retirada no Quiosque') as retirada,  date_format(a.data_compra, \"%d/%m/%Y %h:%i:%s\") as data_compra, date_format(a.data_retirada, \"%d/%m/%Y\") as data_retirada, CONCAT('R$', format(valor_base,2,'pt_BR')) AS valor_base, CONCAT('R$', FORMAT(a.valor_dolar,2,'pt_BR')) AS valor_dolar, CONCAT('R$', format(valor_total,2,'pt_BR')) AS valor_total FROM wd_vouchers a LEFT JOIN wd_planos b ON a.plano = b.ID LEFT JOIN wd_ponto_de_venda c ON a.ponto_entrega = c.ID ".$qs." ORDER BY ID DESC ".($page?"LIMIT ".($page - 1) * 20 .",20":"")." ");	
		
		$fetch = $query->fetchAll();
		
		$count = $this->db->query("select * from wd_vouchers a LEFT JOIN wd_planos b ON a.plano = b.ID LEFT JOIN wd_local_de_venda c ON a.ponto_entrega = c.ID ".$qs." ");
	
		
		$queryFP = $this->db->query("select forma_pagamento from wd_vouchers group by forma_pagamento ");
		$fetchFP = $queryFP->fetchAll();
		
		
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page, 'fp' => $fetchFP);
		
		
		return $res->fetchAll();
		
		
		
	}
	
	public function getVoucherSeller($a){
		
		$mysqli2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
		$query = $mysqli2->query("select  * from usuarios where id = '$a' ");
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetch();
		
		
		
		return $fetch[empresa];
	}
	
	
	public function getVoucher($a){
		
		$mysqli2 = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
		$query = $mysqli2->query("select  voucher from purchases where id = '$a' ");
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetch();
		
		
		
		return $fetch[voucher];
	}
	
	
	public function getHelperData($a){
		
		
		$query = $this->db->query("
		
		select  
		
		b.nome as plano, 
		h.`local` as local_venda,
		i.ponto as ponto_venda
		
		from wd_transacoes  a left join wd_planos b on a.plano = b.ID LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID where a.id_skillsim = '$a' ");
		
		$fetch = $query->fetch();
		
		
		return $fetch;
	}
	
	
	public function importTransactionVoucher($id){
		
		
		
		/*$mysqli = new pdo('mysql:host=66.165.251.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');
		
		
		
		$query = $mysqli->query("select  a.*, a.id,  date_format(Concat(SUBSTR(data_venda, 7, 4),'-', SUBSTR(data_venda, 4, 2),'-', SUBSTR(data_venda, 1, 2) , ' ' , SUBSTR(horario_venda, 1, 2),':', SUBSTR(horario_venda, 4, 2), ':00'), '%d/%m/%Y %H:%iHs') as data_compra, date_format(Concat(SUBSTR(voucher_data_retirada, 7, 4),'-', SUBSTR(voucher_data_retirada, 4, 2),'-', SUBSTR(voucher_data_retirada, 1, 2)), '%d/%m/%Y ') as data_retirada, voucher_cod_referencia, voucher_forma_pagamento, if(voucher_sedex=1, 'Sedex', 'Retirada no Quiosque') as retirada,  voucher_nome_cliente, voucher_email, voucher_cupom,  voucher_status_compra, concat('R$', format(voucher_valor_total,2,'pt_BR')) as valor_total from  vendas a WHERE id_quiosque = 9999 AND id >= 41180 ".$qs." ORDER BY voucher_id_purchase DESC ".($page?"LIMIT ".($page - 1) * 20 .",20":"")."");
		
		
		
		
		
		$fetch = $query->fetchAll();
		
		
		
		$query = $mysqli->query("SELECT 
      
      	date_format(Concat(SUBSTR(data_compra, 7, 4),'-', SUBSTR(data_compra, 4, 2),'-', SUBSTR(data_compra, 1, 2) , ' ' ,  SUBSTR(data_compra, 12, 2),':', SUBSTR(trim(data_compra), 15, 2)), '%d/%m/%Y %H:%iHs') as 'Data da Compra',
		cod_referencia as 'Cod. Referência',
		forma_pagamento as 'Meio de Pagamento',
		b.empresa as 'Vendedor',
		if(sedex=1, 'Sedex', 'Retirada no Quiosque') as 'Opção de Retirada',
		 
		voucher as 'Voucher',
		nome as 'Nome Cliente',
		a.email as 'E-mail',
	    a.cupom as 'Cupom Utilizado',
	    concat('R$', format(valor_total,2,'pt_BR')) as 'Valor Total',
		if(status_compra=1, 'Aguardando Pagamento', if(status_compra=2, 'Em análise',  if(status_compra=3, 'Paga',  if(status_compra=6, 'Devolvida',  if(status_compra=7, 'Cancelada',  if(status_compra=10, 'Compra Faturada', if(status_compra=4, 'Disponível',  '') )))))) as 'Status do Pagamento'
	
		
		
		from purchases a LEFT JOIN usuarios b on a.id_vendedor = b.id where a.id = '$id' ");*/
		
		
		$count = $this->db->query("SELECT 
		
		 
		date_format(a.data_compra, \"%d/%m/%Y %h:%i:%s\") as 'Data da Compra',
		cod_referencia  as 'Código de Referência',
		forma_pagamento as 'Forma de Pagamento',
		IF(vendedor, vendedor, 'Site') as 'Vendedor',
		if(sedex=1, 'Sedex', 'Retirada no Quiosque') as 'Opção de Retirada',
		voucher as Voucher,
		nome as 'Nome do Cliente',
		email as 'E-mail',
		cupom as 'Cupom Utilizado',
		a.*, b.nome AS Plano, 
		CONCAT('R$', format(valor_base,2,'pt_BR')) AS 'Valor Base', 
		CONCAT('R$', FORMAT(a.valor_dolar,2,'pt_BR')) AS 'Cotação', 
		CONCAT('R$', format(valor_total,2,'pt_BR')) AS 'Valor Total' 
		if(status_compra=1, 'Aguardando Pagamento', if(status_compra=2, 'Em análise',  if(status_compra=3, 'Paga',  if(status_compra=6, 'Devolvida',  if(status_compra=7, 'Cancelada',  if(status_compra=10, 'Compra Faturada', if(status_compra=4, 'Disponível',  '') )))))) as 'Status do Pagamento',
		simcard as Simcard,
		date_format(a.data_retirada, \"%d/%m/%Y\") as 'Data de Retirada', 
		c.`ponto` AS 'Ponto de Entrega', 
		if(resgatado=1, 'Não', 'Sim') as 'Resgatado'
		
		FROM wd_vouchers a 
		LEFT JOIN wd_planos b ON a.plano = b.ID 
		LEFT JOIN wd_ponto_de_venda c ON a.ponto_entrega = c.ID  where a.ID = '$id'  ");
		
		
		
		
		if ( ! $query ) {
			
			return array();
		}
		
		
		return $query->fetch(PDO::FETCH_ASSOC);
		
		
	}
	
	public function exportReportVoucher($id){
		
		unset($_GET[path], $_GET[p]);
		
		foreach($_GET as $key => $search):
		
		  if($search){
			  
		  switch($key):
			  
			  case"IDS":
			
				$qs .=  "a.id  in(".implode(',', explode('|', $search)).") and ";
		  
		  	break;
		  
		  	case"ID":
		  	  $qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  	break;
			
			case"email":
			
				$qs .= str_replace('|','.', $key)." = '".$search."' and ";
		  
		  	break;
			
			case"valor_total":
			
				$qs .=  $key." = '".formatMoney($search)."' and ";
		  
		  	break;
			
			  case"data_compra":
			    
			    $search = explode('-', $search);
			   
			  	if($search[0] or $search[1]):
				$qs .=  "Concat(SUBSTR(data_compra, 7, 4),'-', SUBSTR(data_compra, 4, 2),'-', SUBSTR(data_compra, 1, 2)) between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;
			  
		  	break;
			  
			
			case"status_compra":
			
				$qs .=  $key." = '".$search."' and ";
		  
		  	break;
			
			
			
			default:
			  $qs .= str_replace('|','.', $key)." like '%".trim($search)."%' and ";
		  	break;
			
		  endswitch;
		  
		  }
		
		endforeach;
		
		$qs = ($qs)?'where '.substr($qs, 0, -4):'';
		
		
        $mysqli = new pdo('mysql:host=mysql.skillsim.com;dbname=skillsim02;charset=utf8', 'skillsim02', 'nas9duh198je');
		
		
		
		$query = $mysqli->query("SELECT 
      
      	date_format(Concat(SUBSTR(data_compra, 7, 4),'-', SUBSTR(data_compra, 4, 2),'-', SUBSTR(data_compra, 1, 2) , ' ' ,  SUBSTR(data_compra, 12, 2),':', SUBSTR(trim(data_compra), 15, 2)), '%d/%m/%Y %H:%iHs') as 'Data da Compra',
		cod_referencia as 'Cod. Referência',
		forma_pagamento as 'Meio de Pagamento',
		b.empresa as 'Vendedor',
		if(sedex=1, 'Sedex', 'Retirada no Quiosque') as 'Opção de Retirada',
		voucher as 'Voucher',
		nome as 'Nome Cliente',
		a.email as 'E-mail',
	    a.cupom as 'Cupom Utilizado',
	    concat('R$', format(valor_total,2,'pt_BR')) as 'Valor Total',
		if(status_compra=1, 'Aguardando Pagamento', if(status_compra=2, 'Em análise',  if(status_compra=3, 'Paga',  if(status_compra=6, 'Devolvida',  if(status_compra=7, 'Cancelada',  if(status_compra=10, 'Compra Faturada', if(status_compra=4, 'Disponível',  '') ))))))  as 'Status do Pagamento'
		
 
		from purchases a LEFT JOIN usuarios b on a.id_vendedor = b.id ".$qs." ");
		
		
		
		if ( ! $query ) {
			
			return array();
		}
		
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		
	}
	
	
	
}