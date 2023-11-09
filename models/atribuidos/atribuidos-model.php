<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class AtribuidosModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'wd_transacoes';
		$this->tablePlanos = 'wd_planos';
		$this->tableAtendentes = 'wd_atendentes';
		$this->tableFornecedores = 'wd_fornecedores';
		$this->tableLocal = 'wd_local_de_venda';
		$this->tableMdn = 'wd_mdn';
		$this->tableStatusMdn = 'wd_status_mdn';
		$this->tableStatusSimcard = 'wd_status_simcard';
		$this->tableStatusLocalEstoque = 'wd_local_de_estoque';
		$this->tableStatusLocalUso = 'wd_local_de_uso';

	}
	
	public function getList($historico) {
		
		$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
		
		$transacao = $_GET[transacao];
		
		
		unset($_GET[path], $_GET[p],$_GET[transacao], $_GET[historico]);
		
		
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
			  
			case"simcard":
			  
			  	$qs .=  "simcard != '' and "; 
			  
			break;
			  
			case"mdn":
			  
			    $qs .= "a.mdn != '' and ";
			  
			break;
			
			case"data_ativacao":
			
				$search = explode('-', $search);
			   
			  	if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;
		  
		  	break;
			  
			 case"data_off":
			
				$search = explode('-', $search);
			   
			  	if($search[0] or $search[1]):
				$qs .=  "date(".$key.") between date('".dateDBS(trim($search[0]))."') and  date('".dateDBS(trim($search[1]))."')  and ";
		  		endif;
		  
		  	break; 
			
			case"status":
			
				$qs .=  $key." = '".$search."' and ";
		  
		  	break;
			  
			 case"fornecedor":
			
				$qs .=  "concat(a.fornecedor_simcard,',',a.fornecedor_mdn) = '$search'  and ";
		  
		  	break;
			
			default:
			  $qs .= str_replace('|','.', $key)." like '%".$search."%' and ";
		  	break;
			
		  endswitch;
		  
		  }
		
		endforeach;
		
		$qs = ($qs)?'where '.substr($qs, 0, -4):'';
		
		echo 'select a.*, e.observacao, date_format(data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(data_off, "%d/%m/%Y") as data_off, Concat("R$",format(valor, 2, "pt_BR")) as valor,  b.nome as plano, b.qtd_dias as qtd_dias, c.nome as atendente , d.local as local_venda, f.status as status_mdn,  g.status as status_simcard, h.local as local_estoque, e.nome, p.local as local_uso, e.celular, e.email, q.nome as fornecedor_mdn, r.nome as fornecedor_simcard, e.documento
			
			from  '.($historico?'wd_mdn_excluidos':'wd_mdn').' a 
			'.($transacao?'JOIN':'LEFT JOIN').' '.$this->table.' e  '.($historico?'ON e.ID =  a.id_transacao':'ON e.iccid =  a.simcard').'  
			LEFT JOIN '.$this->tablePlanos.' b ON e.plano = b.ID
			LEFT JOIN '.$this->tableAtendentes.' c ON e.atendente = c.ID
			LEFT JOIN '.$this->tableLocal.' d ON e.local_venda = d.ID
			
			LEFT JOIN '.$this->tableStatusMdn.' f ON a.status_mdn = f.ID
			LEFT JOIN '.$this->tableStatusSimcard.' g ON a.status_simcard = g.ID
			LEFT JOIN '.$this->tableStatusLocalEstoque.' h ON a.local_estoque = h.ID
			LEFT JOIN '.$this->tableStatusLocalUso.' p ON e.local_uso = p.ID
			LEFT JOIN '.$this->tableFornecedores.' q ON a.fornecedor_mdn = q.ID
			LEFT JOIN '.$this->tableFornecedores.' r ON a.fornecedor_simcard = r.ID
			
			'.$qs.' where e.iccid = \'8901260163767617576F\'
			
			
			'.($historico?'order by mdn DESC':'ORDER BY ID DESC').' '.($page?"LIMIT ".($page - 1) * 20 .",20":"").' ';
		
		die();
	  
		
		$query = $this->db->query(
			
			'select a.*, e.observacao, date_format(data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(data_off, "%d/%m/%Y") as data_off, Concat("R$",format(valor, 2, "pt_BR")) as valor,  b.nome as plano, b.qtd_dias as qtd_dias, c.nome as atendente , d.local as local_venda, f.status as status_mdn,  g.status as status_simcard, h.local as local_estoque, e.nome, p.local as local_uso, e.celular, e.email, q.nome as fornecedor_mdn, r.nome as fornecedor_simcard, e.documento
			
			from  '.($historico?'wd_mdn_excluidos':'wd_mdn').' a 
			'.($transacao?'JOIN':'LEFT JOIN').' '.$this->table.' e  '.($historico?'ON e.ID =  a.id_transacao':'ON e.iccid =  a.simcard').'  
			LEFT JOIN '.$this->tablePlanos.' b ON e.plano = b.ID
			LEFT JOIN '.$this->tableAtendentes.' c ON e.atendente = c.ID
			LEFT JOIN '.$this->tableLocal.' d ON e.local_venda = d.ID
			
			LEFT JOIN '.$this->tableStatusMdn.' f ON a.status_mdn = f.ID
			LEFT JOIN '.$this->tableStatusSimcard.' g ON a.status_simcard = g.ID
			LEFT JOIN '.$this->tableStatusLocalEstoque.' h ON a.local_estoque = h.ID
			LEFT JOIN '.$this->tableStatusLocalUso.' p ON e.local_uso = p.ID
			LEFT JOIN '.$this->tableFornecedores.' q ON a.fornecedor_mdn = q.ID
			LEFT JOIN '.$this->tableFornecedores.' r ON a.fornecedor_simcard = r.ID
			
			'.$qs.' where e.iccid = \'8901260163767617576F\'
			
			
			'.($historico?'order by mdn DESC':'ORDER BY ID DESC').' '.($page?"LIMIT ".($page - 1) * 20 .",20":"").' ');
		
	
		
		$count = $this->db->query('SELECT *   from  '.($historico?'wd_mdn_excluidos':'wd_mdn').' a 
			'.($transacao?'JOIN':'LEFT JOIN').' '.$this->table.' e  '.($historico?'ON e.ID =  a.id_transacao':'ON e.iccid =  a.simcard').'  
			LEFT JOIN '.$this->tablePlanos.' b ON e.plano = b.ID
			LEFT JOIN '.$this->tableAtendentes.' c ON e.atendente = c.ID
			LEFT JOIN '.$this->tableLocal.' d ON e.local_venda = d.ID
			
			LEFT JOIN '.$this->tableStatusMdn.' f ON a.status_mdn = f.ID
			LEFT JOIN '.$this->tableStatusSimcard.' g ON a.status_simcard = g.ID
			LEFT JOIN '.$this->tableStatusLocalEstoque.' h ON a.local_estoque = h.ID
			LEFT JOIN '.$this->tableStatusLocalUso.' p ON e.local_uso = p.ID
			LEFT JOIN '.$this->tableFornecedores.' q ON a.fornecedor_mdn = q.ID
			LEFT JOIN '.$this->tableFornecedores.' r ON a.fornecedor_simcard = r.ID
			
			'.$qs.'  ');
		
		
		if ( ! $query ) {
			return array();
		}
		
		$fetch = $query->fetchAll();
		
		//var_dump($fetch);
		return array('data' => $fetch, 'total' => count($count->fetchAll()), 'page' => $page);
	}
	
	public function getListImport(){
		
		
		
		$query = $this->db->query(
			
		    'SELECT a.iccid, a.mdn, a.lote as lote_simcard, x.lote as lote_mdn  f.status as status_mdn,  g.status as status_simcard,  a.local_venda,  date_format(data_ativacao, "%d/%m/%Y") as data_ativacao, b.nome as plano,  b.qtd_dias as qtd_dias, date_format(data_off, "%d/%m/%Y") as data_off, Concat("R$",format(valor, 2, "pt_BR")) as valor,  d.local as local_venda,   c.nome as atendente , a.observacao
			FROM '.$this->table.' a 
			LEFT JOIN '.$this->tablePlanos.' b ON a.plano = b.ID
			LEFT JOIN '.$this->tableAtendentes.' c ON a.atendente = c.ID
			LEFT JOIN '.$this->tableLocal.' d ON a.local_venda = d.ID
			LEFT JOIN '.$this->tableMdn.' e ON a.iccid = e.simcard
			LEFT JOIN '.$this->tableStatusMdn.' f ON e.status_mdn = f.ID
			LEFT JOIN '.$this->tableStatusSimcard.' g ON e.status_simcard = g.ID
			LEFT JOIN wd_simcards z on a.iccid = z.simcard
			LEFT JOIN wd_mdns x on z.simcard = x.ID
			
			ORDER BY a.ID DESC 
			
		');
		
		if ( ! $query ) {
			return array();
		}
		
		return $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
		
		
	}
	
	
	public function getSearchDetails(){
		
		if($_POST[tipo]=='simcard'):
			
		
		$query = $this->db->query(
			
			
			'select a.*, x.lote as lote_mdn, x.mdn as mdn, e.observacao, date_format(data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(data_off, "%d/%m/%Y") as data_off, Concat("R$",format(valor, 2, "pt_BR")) as valor,  b.nome as plano, b.qtd_dias as qtd_dias, c.nome as atendente , d.local as local_venda,   g.status as status_simcard, h.local as local_estoque, e.nome, p.local as local_uso, e.celular, e.email,  r.nome as fornecedor, e.documento
			
			from  wd_simcards a 
			'.($transacao?'JOIN':'LEFT JOIN').' '.$this->table.' e  '.($historico?'ON e.ID =  a.id_transacao':'ON e.iccid =  a.simcard').'  
			LEFT JOIN '.$this->tablePlanos.' b ON e.plano = b.ID
			LEFT JOIN '.$this->tableAtendentes.' c ON e.atendente = c.ID
			LEFT JOIN '.$this->tableLocal.' d ON e.local_venda = d.ID
			
			LEFT JOIN '.$this->tableStatusSimcard.' g ON a.status = g.ID
			LEFT JOIN '.$this->tableStatusLocalEstoque.' h ON a.local_estoque = h.ID
			LEFT JOIN '.$this->tableStatusLocalUso.' p ON e.local_uso = p.ID
			LEFT JOIN '.$this->tableFornecedores.' r ON e.fornecedor_simcard = r.ID
			LEFT JOIN  wd_mdns x ON x.ID = a.id_associacao
			
			where a.ID = \''.$_POST[id].'\'
			
			
			ORDER BY ID DESC '.($page?"LIMIT ".($page - 1) * 20 .",20":"").' ');
		
		elseif($_POST[tipo]=='mdn'):
		
		
		
		$query = $this->db->query(
			
			'select a.*, e.observacao, date_format(data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(data_off, "%d/%m/%Y") as data_off, Concat("R$",format(valor, 2, "pt_BR")) as valor,  b.nome as plano, b.qtd_dias as qtd_dias, c.nome as atendente , d.local as local_venda, f.status as status,   p.local as local_uso, e.celular, e.email, e.nome, q.nome as fornecedor,  e.documento
			
			from  wd_mdns a 
			LEFT JOIN wd_transacoes e ON e.mdn = a.mdn
			LEFT JOIN '.$this->tablePlanos.' b ON e.plano = b.ID
			LEFT JOIN '.$this->tableAtendentes.' c ON e.atendente = c.ID
			LEFT JOIN '.$this->tableLocal.' d ON e.local_venda = d.ID
			LEFT JOIN '.$this->tableStatusMdn.' f ON a.status = f.ID
			LEFT JOIN '.$this->tableStatusLocalUso.' p ON e.local_uso = p.ID
			LEFT JOIN '.$this->tableFornecedores.' q ON a.fornecedor = q.ID
			
			
			where a.ID = \''.$_POST[id].'\'
			
			
			ORDER BY ID DESC '.($page?"LIMIT ".($page - 1) * 20 .",20":"").' ');
		
		else:
		
		
		
		$query = $this->db->query('
		
		SELECT a.*, b.nome as plano, date_format(a.data_ativacao, "%d/%m/%Y") as data_ativacao, date_format(a.data_off, "%d/%m/%Y") as data_off, date_format(a.data_transacao, "%d/%m/%Y") as data_transacao,
		e.nome as fornecedor_simcard,
		f.nome as fornecedor_mdn,
		g.nome as atendente,
		h.`local` as local_venda,
		i.ponto as ponto_venda,
		j.local as local_uso,
		k.forma_pagamento as forma_pagamento,
		l.moeda as moeda,
		c.lote as lote_simcard,
		d.lote as lote_mdn,
		m.local as local_estoque
		
		
 
		FROM '.$this->table.' a 
		
		LEFT JOIN wd_planos b ON a.plano = b.ID 
		LEFT JOIN wd_simcards c ON  a.iccid = c.simcard 
		LEFT JOIN wd_mdns d ON a.mdn = d.mdn
		LEFT JOIN wd_fornecedores e ON a.fornecedor_simcard = e.ID
		LEFT JOIN wd_fornecedores f ON a.fornecedor_mdn = f.ID 
		LEFT JOIN wd_atendentes g ON a.atendente = g.ID
		LEFT JOIN wd_local_de_venda h on a.local_venda = h.ID
		LEFT JOIN wd_ponto_de_venda i ON a.ponto_venda = i.ID
		LEFT JOIN wd_local_de_uso j ON a.local_uso = j.ID
		LEFT JOIN wd_formas_pagamento k ON a.forma_pagamento = k.ID
		LEFT JOIN wd_moedas l on a.moeda = l.ID
		LEFT JOIN wd_local_de_estoque m on c.local_estoque = m.ID
		
		where a.ID = \''.$_POST[id].'\'
		
		');
		
		
		endif;
		
		
		if ( ! $query ) {
			return array();
		}
		
		return $fetch = $query->fetch();
		
	}
  
	
	
	
	
}