<?php


class CmovelModel extends MainController
{


	public $db;
	private $wsse;
	private $host = 'http://159.138.158.42:39099/aep/';
	//private $host = 'http://gdschannel.cmlink.com:39043/aep/';
	private $appKey = 'de5fadb7f4ab4da0b8e4c941b81f7fb4';
	private $appSecret = '86751e2ace924a8188c0e903cfbf9c93';
	private $token;
	private $swap_id;




	public function __construct($db = false)
	{

		$this->db = $db;
		$this->table = 'wd_transacoes';
		$this->tablePlanos = 'wd_planos';


	}



	public function getToken()
	{

		$nonce = base64_encode(mt_rand());
		$date = $date = gmdate("Y-m-d\Th:i:s\Z");
		$digest = base64_encode(hash('SHA256', $nonce . $date . $this->appSecret, true));

		$this->wsse = 'UsernameToken Username="' . $this->appKey . '", PasswordDigest="' . $digest . '", Nonce="' . $nonce . '", Created="' . $date . '"';

		$data = array('id' => $this->appKey, 'type' => 106);
		$response = $this->request('APP_getAccessToken_SBO/v1', $data);

		$this->token = $response->accessToken;



	}

	public function active()
	{




		//$this->getToken();


		$query = $this->db->query("SELECT

		a.ID,
		iccid,
		c.codigo,

		if((fornecedor_simcard = 48 && fornecedor_mdn = 48) || LOCATE('eua', lower(b.nome)), 1, 0) AS exception

		FROM wd_transacoes a
		LEFT JOIN wd_planos b ON a.plano = b.codigo_plano
		LEFT JOIN wd_planos_opcoes c ON b.ID = c.id_plano

		WHERE  STATUS = '1' AND datediff(NOW(), data_ativacao) = 0 AND preferencial = '1'  ORDER BY a.ID DESC");

		$response = $query->fetchAll();

		$i = 0;

		foreach ($response as $contract):

			$data['accessToken'] = $this->token;
			$data['thirdOrderId'] = $contract['ID'];
			$data['includeCard'] = 0;
			$data['is_Refuel'] = 1;
			$data['quantity'] = 1;
			$data['dataBundleId'] = $contract['codigocmovel'];
			$data['ICCID'] = $contract['iccid'];


			$res = $this->request('APP_createOrder_SBO/v1', $data);


			if ($res->code == "0000000"):

				if ($i == 0):

					$this->db->insert("wd_swap", array("fornecedor" => "40-40", "tipo" => 1));
					$this->swap_id = $this->db->last_id;

				endif;

				$this->db->update($this->table, "ID", $contract["ID"], array('status' => 2, 'cmID' => $res->orderID, 'erro' => '', 'data_live' => ($contract['exception'] == 0 ? date('Y-m-d H:i:s') : date('Y-m-d 19:00:00'))));
				$this->db->update("wd_simcards", "simcard", $contract["iccid"], array('status' => 2));
				$this->db->insert("wd_swap_transacoes", array("id_swap" => $this->swap_id, "id_transacao" => $contract["ID"]));

				$i++;

			else:

				$this->db->update($this->table, "ID", $contract["ID"], array('erro' => "" . $res->code . "-" . $res->description));

			endif;

			$this->db->insert("wd_log_api", array("request" => json_encode($data), "response" => $res->code . "-" . $res->description));

		endforeach;


		$this->db->update("wd_swap", "ID", $this->swap_id, array('qtd_lote' => $i));



		//$response = $this->request('APP_getAccessToken_SBO/v1', $data);

	}

	public function getBalance()
	{

		//date_default_timezone_set('Asia/Shanghai');

		$this->getToken();

		$query = $this->db->query("SELECT ID, iccid,  date_format(date_add(data_ativacao, INTERVAL - 1 day),'%Y%m%d') beginTime FROM " . $this->table . "  WHERE (fornecedor_mdn = 40 AND fornecedor_simcard = 40) AND STATUS = '2'   ORDER BY ID DESC");
		$response = $query->fetchAll();



		foreach ($response as $contract):



			$data['iccid'] = $contract['iccid'];
			$data['beginTime'] = $contract['beginTime'];
			$data['endTime'] = date('Ymd');



			$res = $this->request('APP_getSubscriberAllQuota_SBO/v1', $data);

			var_dump($data, $res);

			if ($res->code == 0):


				$consumo_total = 0;

				foreach ($res->historyQuota as $day):

					if ($day->time == date('Ymd')) {

						$consumo = $day->qtaconsumption;


					}

					$consumo_total += $day->qtaconsumption;

				endforeach;


				$this->db->update($this->table, "ID", $contract["ID"], array('consumo' => ($consumo ? $consumo : 0), 'consumo_total' => ($consumo_total ? $consumo_total : 0)));

				unset($consumo, $consumo_total);

			endif;



		endforeach;

	}


	public function recharge()
	{

		$this->getToken();

		$query = $this->db->query("SELECT * FROM wd_recargas WHERE DATEDIFF(DATE(data), NOW()) = 0 and status = 1 ORDER BY ID DESC");
		$response = $query->fetchAll();

		$i = 0;

		foreach ($response as $contract):

			$data['accessToken'] = $this->token;
			$data['thirdOrderId'] = $contract['id_transacao'];
			$data['includeCard'] = 0;
			$data['is_Refuel'] = 1;
			$data['quantity'] = 1;
			$data['dataBundleId'] = $contract['codigo'];
			$data['ICCID'] = $contract['iccid'];


			$res = $this->request('APP_createOrder_SBO/v1', $data);


			var_dump($res);

			if ($res->code == "0000000"):

				$this->db->update('wd_recargas', "ID", $contract["ID"], array('status' => 1));

			else:

				$this->db->update('wd_recargas', "ID", $contract["ID"], array('status' => 3));

			endif;



		endforeach;

	}


	public function getCountry()
	{

		$this->getToken();

		$query = $this->db->query("SELECT a.ID, iccid, codigocmovel, paises_visitados FROM " . $this->table . " a LEFT JOIN " . $this->tablePlanos . " b ON a.plano = b.ID WHERE (fornecedor_mdn = 40 AND fornecedor_simcard = 40) AND STATUS = '2' ORDER BY a.ID DESC");
		$response = $query->fetchAll();

		foreach ($response as $contract):

			$paises = array();

			$data['accessToken'] = $this->token;
			$data['packageID'] = $contract['codigocmovel'];
			$data['iccid'] = $contract['iccid'];
			$data['language'] = 1;

			$res = $this->request('SBO_query_usingTrajectories/v1', $data);


			if ($res->code == 0):

				$countries = array_reverse($res->trajectoriesList);

				foreach ($countries as $country):

					array_push($paises, $country->country);

				endforeach;


				var_dump($countries);


				$this->db->update($this->table, "ID", $contract["ID"], array('pais' => $countries[0]->country, 'paises_visitados' => serialize($paises)));

			endif;


		endforeach;

	}


	public function request($endpoint, $data)
	{


		$curl = curl_init();


		curl_setopt_array(
			$curl,
			array(


				CURLOPT_URL => $this->host . $endpoint,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($data),
				CURLOPT_HTTPHEADER => array(

					'Authorization: WSSE realm="SDP", profile="UsernameToken", type="Appkey"',
					'X-WSSE: ' . $this->wsse . '',
					'Content-Type: application/json'
				),

			)
		);

		$response = curl_exec($curl);

		curl_close($curl);


		return json_decode($response);


	}


}
