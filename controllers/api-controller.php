<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

class ApiController extends MainController
{

	public $login_required = true;
	public $permission_required = 'transacoes';
	public $controller = 'transacoes';
	public $ignoreRequired = false;




    public function getMdn() {

		$model = $this->load_model('api/api-model');
		$model->getMdn();

    }

	 public function setStatus() {

		$model = $this->load_model('api/api-model');
		$model->setStatus();

    }

	public function getReportTransacion(){


		$model = $this->load_model('api/api-model');
		$model->getReportTransacion();


	}

	public function getTable(){

		$model = $this->load_model('api/api-model');
		$model->getTable();

	}

	public function getReportSells(){

		$model = $this->load_model('api/api-model');
		$model->getReportSells();

	}

	public function importTransaction(){




		$model = $this->load_model('api/api-model');
		$model->importTransaction(true);



	}


	public function exportReport(){


		$model = $this->load_model('api/api-model');
		$model->exportReport(true);




	}

	public function cancelVoucher(){


		$model = $this->load_model('api/api-model');
		$model->cancelVoucher();


	}

	public function cancelSell(){


		$model = $this->load_model('api/api-model');
		$model->cancelSell();


	}

	public function getNf(){
		$model = $this->load_model('api/api-model');
		$model->getNf();
	}

	public function getFaturas(){
		$model = $this->load_model('api/api-model');
		$model->getFaturas();
	}

	public function getNfReport(){


		$model = $this->load_model('api/api-model');
		$model->getNf();

	}

	public function geraNota(){


		$model = $this->load_model('api/api-model');
		$model->geraNota();

	}

	public function getOptions(){


		$model = $this->load_model('api/api-model');
		$model->getOptions();

	}

	public function emitirNota(){
		$model = $this->load_model('api/api-model');
		$model->emitirNota();
	}

	public function getFatura(){
		$model = $this->load_model('transacoes/transacoes-model');
		$model->gerFatura();

	}

	public function geraFatura(){
		$model = $this->load_model('transacoes/transacoes-model');
		$model->geraFatura();

	}


}
