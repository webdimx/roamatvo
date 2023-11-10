<?php

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TransacoesController extends MainController
{

	public $login_required = true;
	public $permission_required = 'transacoes';
	public $controller = 'transacoes';
	public $ignoreRequired = false;

	public function index()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$this->title = 'Gerenciar Transações';
		$this->menu = 'faturas';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$this->grupo = $_SESSION['userdata']['grupo'];


		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/transacoes/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}


	public function prorrogados()
	{

		$this->subController = 'prorrogados/';

		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Prorrogados';



		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view = ABSPATH . '/views/prorrogados/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}


	public function adicionar()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Nova Transação';
		$this->menu = 'transacoes';
		$this->form = 'transacoes/submit/';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/transacoes/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editar()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Transação';
		$this->menu = 'transacoes';
		$this->form = 'transacoes/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);

		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/transacoes/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function trintadias()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$this->title = 'Transações + de 30 dias';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$this->subController = '/trinta-dias/';

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/transacoes/trinta-list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function submit()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$model->_submit();


	}

	function delRegistry()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		echo $model->del($_POST[ids]);

	}

	function getSim()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		echo $model->getSim();

	}

	function getMdn()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		echo $model->getMdn();

	}

	function getInfoSim()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		echo $model->getMDN();

	}

	public function cancel()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$model->cancel();

	}


	public function importSell()
	{

		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';

		$spreadsheet = IOFactory::load(FILES . '/vendas_final_2.csv');
		$file = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);


		$model = $this->load_model('transacoes/transacoes-model');
		$model->importer($file, 2);

	}

	public function importSellOziel()
	{

		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';

		$spreadsheet = IOFactory::load(FILES . '/planilha_oziel.xlsx');
		$file = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);


		$model = $this->load_model('transacoes/transacoes-model');
		$model->importerOziel($file);

	}


	public function importTransaction()
	{

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		$model = $this->load_model('transacoes/transacoes-model');
		$data = $model->importTransaction($parametros[0]);



		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';


		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Sistema RoamAtvo')
			->setLastModifiedBy('Sistema RoamAtvo')
			->setTitle('Office 2007 XLSX Test Document')
			->setSubject('Office 2007 XLSX Test Document')
			->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Test result file');


		$a = 1;

		foreach ($data as $key => $item):


			$spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $a, $key);

			$a++;
		endforeach;


		$name = 'Transação - ' . $parametros[0] . ' ' . $data[0][data] . '.xlsx';



		$b = 1;
		foreach ($data as $key => $item):

			$spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $b, '="' . $item . '"');


			$b++;
		endforeach;

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle($name);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $name . '"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;



	}


	public function report()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$model->report();

		require ABSPATH . '/views/relatorios/vendas/list-view.php';


	}

	public function sendTo()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$model->sendTo();


	}

	public function getDetails()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$model->getDetailsAjax();

	}


	public function recharge()
	{

		$model = $this->load_model('transacoes/transacoes-model');
		$model->recharge();

	}



}
