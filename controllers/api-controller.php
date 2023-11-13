<?php



header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Content-Type: application/json");



class ApiController extends MainController
{

	public $login_required = true;
	public $permission_required = 'transacoes';
	public $controller = 'transacoes';
	public $ignoreRequired = false;
	private $api;



	public function __construct($parametros = array())
	{
		$this->api = $this->load_model('api/api-model');
	}


	public function transaction()
	{
		$this->api->checkMethod('POST');
		$this->api->setTransaction();
	}




}
