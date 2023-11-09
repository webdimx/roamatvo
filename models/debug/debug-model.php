<?php 
/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class debugModel extends MainController
{

	public $form_data;
	public $form_msg;
	public $db;
	
	
	public function __construct( $db = false ) {
		
		$this->db = $db;
		$this->table = 'wd_transacoes';
		$this->tableSIM = 'wd_mdn';
		
	}

	public function change($file){
		
		
		$mysqli = new pdo('mysql:host=66.165.251.2;dbname=sistemas_skillsim;charset=utf8', 'sistemas_simcard', 'Jdh^do@fhhas');
		
		
		$res = $mysqli->query("Select  
		a.id as id_skillsim,
		data_venda,
		observacoes,
		b.nome as local_venda,
		upper(c.nome) as atendente,
		a.aparelho,
		a.paises,
		d.nome as aeroporto,
	    CONCAT(SUBSTR(data_venda, 7, 4),'-',SUBSTR(data_venda, 4, 2),'-',SUBSTR(data_venda, 1, 2),' ', if(horario_venda, SUBSTR(horario_venda, 1, 2), '00'),':', if(horario_venda, SUBSTR(horario_venda, 4, 2), '00'), ':00') as data_venda
		from vendas a LEFT JOIN quiosques b on a.id_quiosque = b.id LEFT JOIN aeroportos d on b.id_aeroporto = d.id left join usuarios c on a.id_vendedor = c.id where a.id > 418  order by a.id ASC");
		
		
		$itens = $res->fetchAll(PDO::FETCH_ASSOC);	
		
		foreach($itens as $item):
		
		$query2 = $this->db->query("SELECT * FROM `wd_ponto_de_venda` where ponto = '$item[local_venda]'");
		if ( $query2 ) {
		$data2 = $query2->fetch();
		}
		$query5 = $this->db->query("SELECT * FROM `wd_local_de_venda` where local = '$item[aeroporto]'");
		if ( $query5 ) {
		$data5 = $query5->fetch();
		}
		
		$query3 = $this->db->query("SELECT * FROM `wd_atendentes` where upper(nome) = '$item[atendente]'");
		if ( $query3 ) {
		$data3 = $query3->fetch();
		}
		
		$query = $this->db->update('wd_transacoes', 'id_skillsim', $item[id_skillsim], array(
		
				'id_skillsim' => $item[id_skillsim],
				'data_transacao' => $item[data_venda],
				'atendente' => ($data3[ID]?$data3[ID]:60),
				'local_venda' => $data5[ID],
				'ponto_venda' => $data2[ID],
				'observacao' => $item[observacoes],
				'aparelhos' => $item[aparelho],
				'paises' => $item[paises],
				
				
		));
		
		endforeach;
	
	}
	
	public function associate(){
		
		
		/*$query = $this->db->query("select * from wd_transacoes where status < 4 and iccid in ('8901260163702153943F','8901260933752818128F','8901260163767420757F ','8901260933752818011F','8901260163767420120F','8901260163767420120F','8901260163767412952F','8901260163767417787F','8901260163767417050F','8901260163767419635F','8901260163767419635F','8901260163767413653F','8901260163767416367F','8901260163767416359F','8901260163767415997F','8901260163767414446F','8901260163767620448F','8901260163767621123F') and LOCATE('F', iccid) > 0");
		
		foreach($query->fetchAll() as $data):
		
		$mdn = $data[mdn];
		$simcard = $data[iccid];
		
	
		
		if($mdn):
		
		
		
		
		$query = $this->db->query("SELECT *  FROM wd_mdn a where mdn = '$mdn' and simcard = '$simcard' ");
		
		if(!$query->fetch()):
		
		    $query = $this->db->query("SELECT * FROM wd_mdn a where simcard = '$simcard' ");
		    
		    $sim = $query->fetch();
		
		   
		
		  //var_dump($sim);
			
			
		    $del = $this->db->delete('wd_mdn', 'simcard', $simcard);
		
		
		
			$query = $this->db->update('wd_mdn', 'mdn', $mdn, array(
			
			'simcard' => $simcard,	
			'status_simcard' => ($data[status]==1?19:($data[status]==2?6:20)),
			'fornecedor_simcard' => $sim[fornecedor_simcard],
			'local_estoque' => $sim[local_estoque],
			'status_mdn' => ($data[status]==1?14:($data[status]==2?2:12)),
			
			
			
			
		    ));
		
		endif;
		endif;
		
		endforeach;
	}
	
	
	public function setRep(){*/
		
		
	$query = $this->db->query("select sum(dias_uso), DATE_SUB(date('2018-11-13 00:00:00'), Interval (45-  sum(dias_uso)) day) as rep, a.ID from wd_mdn a LEFT JOIN wd_transacoes b on a.mdn = b.mdn where b.fornecedor_mdn = 7  and a.ID not in('31679', '31630','31861','31747','31636','31646','31613','31919','31599','31642','31874','31744','31627','31660','31663','31925','31901','31779','31774','31890','31673','31733','31631','31888','31683','31667','31670','31682','31737','31701','31789','31600','3130','31777','31776','31884','31635','31625','31692','31620','31684','31666','31713','31739','31790','31904','31824','31820','31836','31864','31880','31603','31634','31602','31651','31763','31626','31749','31686','31621','31619','31677','31674','31606','31615','31703','31714','31736','31735','31719','31793','31931','31947','31905','31922','31799','31798','31834','31597','31639','31643','31783','31871','31885','31638','31754','31748','31688','31690','31661','31680','31676','31669','31656','31700','31914','31911','31913','31908','31807','31810','31808','31827','31831','31598','31640','31855','31860','31873','31875','31780','31879','31632','31883','31604','31637','31622','31624','31678','31618','31671','31652','31654','31612','31927','31921','31918','31705','31709','31717','31715','31724','31718','31929','31923','31920','31928','31942','31899','31817','31816','31814','31843','31837','31850','31788','31863','31866','31782','31648','31877','31844','31896','31753','31693','3167','31662','31675','31616','31607','31934','31704','31699','31712','31710','31738','31732','31727','31725','31948','31916','31932','31813','31797','31842','31838','31835','31829','31832')  group by a.mdn");
		
	$data = $query->fetchAll();
		
	foreach($data as $d):
		
		$this->db->update('wd_mdn', 'id', $d[ID], array('repatriado' => $d[rep])  );
		
	endforeach;
		
	var_dump($data);
		
		
	}
	
	
}