<?
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

class CronController extends MainController
{


public function index(){


}

public function getSells(){



	$model = MainController::load_model('ajax/ajax-model');
	$modelSwap = MainController::load_model('swap/swap-model');
	//$modelEmail = MainController::load_model('email/email-model');


	$model->getSells($modelSwap, '');

}


public function getMDN(){

	$model = MainController::load_model('transacoes/transacoes-model');
	$model->getMdn();

}


public function replicateTable(){

	$model = MainController::load_model('cron/cron-model');
	$model->replicateTable();


}

public function getPendentRescue(){

	$model = MainController::load_model('cron/cron-model');
	$model->getPendentRescue();


}

public function getPendentVoucher(){

	$model = MainController::load_model('cron/cron-model');
	$model->getPendentVoucher();


}

public function getStatus(){

	$model = MainController::load_model('cron/cron-model');
	$model->getStatus();


}



public function checkInfoVoucher(){

	$model = MainController::load_model('cron/cron-model');
	$model->getPendentRescue();
	$model->getPendentVoucher();
	$model->getStatus();

}


public function getPriceNet(){

	$model = MainController::load_model('cron/cron-model');
	$model->getPendentNet();

}

public function sync(){

	$model = MainController::load_model('cron/cron-model');
	$model->sync();

}

public function autoSwap(){

	$model = MainController::load_model('cron/cron-model');
	$model->autoSwap();

}

public function getBalance(){

	$model = MainController::load_model('cron/cron-model');
	$model->getBalance();

}


public function recharge(){

	$model = MainController::load_model('cron/cron-model');
	$model->recharge();

}

public function geraDataOffDayAfter(){

    $model = MainController::load_model('swap/swap-model');
    $model->geraDataOffDayAfter();
}

public function getCountry(){

	$model = MainController::load_model('cron/cron-model');
	$model->getCountry();

}

public function generateDailyReport(){
	$model = MainController::load_model('relatorios/relatorios-model');
	$model = MainController::load_model('cron/cron-model');
	$model->generateDailyReport();
}


}

?>
