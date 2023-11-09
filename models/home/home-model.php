<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class HomeModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'wd_transacoes';
		$this->tableSIM = 'wd_simcards';
		$this->tableMdn = 'wd_mdns';
		
		if($_SESSION['userdata']['grupo']==8):
		    
		    echo '<script>window.location="transacoes"</script>';
		    
		    die();
		    
		endif;
		
		$notify = $this->load_model('relatorios/relatorios-model');
		$this->notify = $notify->checkNotify();
		
	}
	
	
	
	public function reportSells($int, $range){
		
		$date = explode('-', $range);
		
		$a = dateDBS(trim($date[0]));
		$b = dateDBS(trim($date[1]));
		
		$diff = diff(dateDBS(trim($date[0])), dateDBS(trim($date[1])));
		//var_dump(dateDBS(trim($date[0])), dateDBS(trim($date[1])));
		
		
		if($diff<=1):
		
			$per = 'hour';
			$gro = "concat(date_format(data_transacao, '%H'), ':00')";
		
		elseif($diff>1&&$diff<=14):
		
			$per = 'day';
			$gro = "date_format(data_transacao, '%d/%m')";
		
		elseif($diff>14&&$diff<=60):
		
			$per = 'week';
			$gro = "date_format(data_transacao, '%d/%m')";
		
		
		elseif($diff>60):
		
			$per = 'month';
			$gro = "date_format(data_transacao, '%m/%y')";
		
		endif;
		
		
		switch($int):
		
		case"canceled":
		
		$query = $this->db->query("select count(*) as qty, $gro as hora, month(data_cancelamento), (select count(*) from wd_transacoes where  date(data_cancelamento) between '$a' and '$b' and tipo = '3' ) as total from wd_transacoes where  date(data_cancelamento) between '$a' and '$b' and tipo = '3' group by $per(data_cancelamento) order by data_cancelamento ;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		case"extended":
	
		
		$query = $this->db->query("select count(*) as qty, $gro as hora, month(data_adiamento), (select count(*) from wd_transacoes where  date(data_adiamento) between '$a' and '$b' and adiar > 0 ) as total from wd_transacoes where  date(data_adiamento) between '$a' and '$b' and adiar > 0  group by $per(data_adiamento) order by data_adiamento;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
	
		default:
		
		
		$query = $this->db->query("select count(*) as qty, $gro as hora, month(data_transacao), (select count(*) from wd_transacoes where  date(data_transacao) between '$a' and '$b') as total from wd_transacoes where  date(data_transacao) between '$a' and '$b'  group by $per(data_transacao) order by data_transacao;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		endswitch;
		
	} 
	
	public function reportSwap($future){
		
		
		switch($future):
		
		case"true":
		
		$query = $this->db->query("select count(*) total , concat(\"'\",fornecedor_simcard,'-',fornecedor_mdn,\"'\") fornecedor, if(status=3,2,1) as tipo, concat((select nome from wd_fornecedores where ID = a.fornecedor_simcard) ,'/', (select nome from wd_fornecedores where ID = a.fornecedor_mdn)) fornecedor from wd_transacoes a where ((date(data_ativacao) >= date(now()) and date(data_ativacao) < date(now() + interval 7 day) )) and status in(1) group by concat(\"'\",fornecedor_simcard,'-',fornecedor_mdn,\"'\") order by status ");
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		break;
		
		default:
		
		
		
		$query = $this->db->query("select  SUM(qtd_lote) total,  fornecedor as fornecedor_, tipo, concat((select nome from wd_fornecedores where ID = SUBSTRING_INDEX(replace(a.fornecedor, \"'\",''), '-', 1)),'/', (select nome from wd_fornecedores where ID = SUBSTRING_INDEX(replace(a.fornecedor, \"'\",''), '-', -1))) fornecedor from wd_swap a where date(data) = date((now() - interval 2 day))    group by a.fornecedor, tipo order by a.fornecedor, tipo;");
		
		
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		break;
		
		endswitch;
		
	}
	
	public function reportMdn(){
		
		$query = $this->db->query("select  b.nome, if(a.fornecedor=6, count(*), count(*)) as total, (select count(*) from wd_mdns where status = 6 and fornecedor = a.fornecedor) as ativo, (select count(*) from wd_mdns where status = 1 and fornecedor = a.fornecedor) as estoque from wd_mdns a left join wd_fornecedores b on a.fornecedor = b.ID where fornecedor in(7,6, 42, 46) and dashboard is null  group by fornecedor;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
	public function reportSim($estoque, $show){
		
		if($_POST[show]):
		
			$show = '';
		
		else:
		
			$show = 'AND ((select count(*) from wd_simcards where status = 1 and fornecedor = a.fornecedor) > 0 or ((select count(*) from wd_simcards where status = 2 and fornecedor = a.fornecedor) > 0))';
		
		endif;
		
		switch($estoque):
		
		case"true":
		
		$query = $this->db->query("select count(*) total, b.`local` local, c.nome fornecedor from wd_simcards a left join wd_local_de_estoque b on a.local_estoque = b.ID left join wd_fornecedores c on a.fornecedor = c.ID where status = 1 and dashboard is null $show group by local_estoque, fornecedor order by b.ordem, b.ID");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		break;
		
		default:
		
		$query = $this->db->query("select b.nome, count(*) total,  b.nome, count(*), SUM(if(STATUS=2, 1, 0)) as ativo, SUM(if(STATUS=1, 1, 0)) as estoque   from wd_simcards a left join wd_fornecedores b on a.fornecedor = b.ID where dashboard is null $show group by fornecedor");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
		break;
		
		endswitch;
	}
	
	public function reportCanceled(){
		
		
		$query = $this->db->query("select count(*) dia, (select count(*) from wd_transacoes where tipo = 3 and data_transacao > (NOW() - INTERVAL 7 DAY)) as semana,  (select count(*) from wd_transacoes where tipo = 3 and data_transacao > (NOW() - INTERVAL 30 DAY)) as mes from wd_transacoes where tipo = 3 and data_transacao > (NOW() - INTERVAL 1 DAY)");
		return $query->fetchAll(PDO::FETCH_ASSOC);
		
	}

	
	
	
}