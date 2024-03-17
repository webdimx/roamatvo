<?php


class ApiModel extends MainController
{

	public $data;
	public $db;

	public $response = [];

	public $transaction;

	public $registrations;


	public function __construct($db = false)
	{



		$this->db = new TutsupDB();
		$this->table = 'wd_client_rest';
		$this->tableTransacoes = 'wd_transacoes';
		$this->tableMdn = 'wd_mdns';

		$this->transaction = $this->load_model('transacoes/transacoes-model');
		$this->registrations = $this->load_model('cadastros/cadastros-model');


		self::checkCredentials();

		$this->data = json_decode(file_get_contents('php://input'));


	}

	public function checkCredentials()
	{

		$headers = apache_request_headers();
		$token = str_replace('Basic ', '', $headers['Authorization']);
		$credentials = explode(':', base64_decode($token));

		$query = $this->db->query("SELECT count(*) as auth  FROM `" . $this->table . "` where login = '" . $credentials[0] . "' and token = '" . $credentials[1] . "' ");

		if (!$query) {
			return array();
		}

		$result = $query->fetch();

		if (!$result['auth']) {

			header("HTTP/1.0 401 Unauthorized");
			$this->response["status"] = false;
			$this->response['error'] = 'Invalid credentials!';
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
			exit;

		}

	}

	public function setTransaction()
	{

		$this->validateTransaction();
		$transaction = $this->transaction->setTransaction($this->data);

		if ($transaction) {
			header("HTTP/1.0 201 Created");
			$this->response["status"] = true;
			$this->response["transaction_id"] = $transaction;
			$this->response["message"] = "Transaction created successfully!";
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
			exit();
		}

		$this->setBadRequest("Thistransaction cannot be created, please contact support!");

	}


	public function getCountries()
	{

		$this->validateTransaction();
		$country = $this->registrations->getCountries();

		header("HTTP/1.0 200 Ok");
		$this->response["status"] = true;
		$this->response["data"] = $country;
		echo json_encode($this->response, JSON_UNESCAPED_UNICODE);

	}

	public function validateTransaction()
	{

		$required = [
			'name',
			'simcard',
			'country',
			'country_origin',
			'activation_date',
			'days',
			'email',
			'code'
		];


		foreach ($this->data as $key => $data) {

			if (
				in_array($key, $required) &&
				!$data
			) {
				$this->setBadRequest("The field $key is required!");
			}

		}

		$simcard = $this->db->query("SELECT count(*) as total  FROM wd_simcards where simcard = '" . $this->data->simcard . "'  and status = 1 ");
		$simcardCount = $simcard->fetch();

		if (!$simcardCount[total]) {
			$this->setBadRequest("The simcard already use!");
		}


		if (
			!$this->validateSimcard($this->data->simcard)
		) {
			$this->setBadRequest("The simcard not exists!");
		}

		if (
			!$this->validateEmail($this->data->email)
		) {
			$this->setBadRequest("The field email is not valid!");
		}

		if (
			!$this->validateDate($this->data->activation_date)
		) {
			$this->setBadRequest("The date format is not valid!");
		}

		if (
			!$this->validatePlan($this->data->code)
		) {
			$this->setBadRequest("The code not exists!");
		}


	}

	public function validatePlan($plano)
	{

		$query = $this->db->query("SELECT count(*) as total  FROM wd_planos where codigo_plano = '$plano' ");
		$total = $query->fetch();

		return $total['total'];

	}

	public function validateSimcard($simcard)
	{

		$query = $this->db->query("SELECT count(*) as total  FROM wd_simcards where simcard = '$simcard' ");
		$total = $query->fetch();
		return $total['total'];

	}

	public function validateEmail($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function validateDate($date)
	{

		if (!is_numeric(str_replace('-', '', $date))) {
			return false;
		}

		$date = explode('-', $date);
		return checkdate($date[1], $date[2], $date[0]);

	}


	public function checkMethod($method)
	{

		if ($_SERVER['REQUEST_METHOD'] !== $method) {

			header("HTTP/1.0 405 Method Not Allowed");
			echo json_encode([
				"status" => false,
				"error" => "Method not allowed!"
			]);
			exit;
		}


	}

	public function setBadRequest($message)
	{

		header("HTTP/1.0 400 Bad Request");
		$this->response["status"] = false;
		$this->response["error"] = $message;
		echo json_encode($this->response);
		exit();

	}


}
