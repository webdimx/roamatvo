<?php


class ApiModel extends MainController
{

	public $data;
	public $db;

	public $response = [];


	public function __construct($db = false)
	{



		$this->db = new TutsupDB();
		$this->table = 'wd_client_rest';
		$this->tableTransacoes = 'wd_transacoes';
		$this->tableMdn = 'wd_mdns';

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

		header("HTTP/1.0 201 Created");
		$this->response["status"] = true;
		$this->response["message"] = "Transaction created successfully!";
		echo json_encode($this->response, JSON_UNESCAPED_UNICODE);


	}

	public function validateTransaction()
	{

		$required = [
			'name',
			'simcard',
			'country',
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

				header("HTTP/1.0 400 Bad Request");
				$this->response["status"] = false;
				$this->response["error"] = "The field $key is required!";
				echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
				exit();

			}

		}

		if (
			!$this->validaPhone($this->data->phone)
		) {
			header("HTTP/1.0 400 Bad Request");
			$this->response["status"] = false;
			$this->response["error"] = "The field phone is invalid!";
			exit();
		}

		if (
			!$this->validateEmail($this->data->email)
		) {
			header("HTTP/1.0 400 Bad Request");
			$this->response["status"] = false;
			$this->response["error"] = "The field email is not valid!";
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
			exit();
		}

		if (
			!$this->validateDate($this->data->activation_date)
		) {
			header("HTTP/1.0 400 Bad Request");
			$this->response["status"] = false;
			$this->response["error"] = "The date format is not valid!";
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
			exit();
		}


	}

	public function validaPhone($phone)
	{
		$phone = str_replace('55', '', $phone);
		return preg_match("/^([14689][0-9]|2[12478]|3([1-5]|[7-8])|5([13-5])|7[193-7])9[0-9]{8}$/", $phone);
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


}
