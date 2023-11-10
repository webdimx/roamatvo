<?php

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RelatoriosController extends MainController
{

	public $login_required = true;
	public $permission_required = 'relatorios';
	public $controller = 'relatorios';

	public function index()
	{

		$model = $this->load_model('relatorios/relatorios-model');

		$this->title = 'Gerenciar Relatórios';
		$this->menu = 'faturas';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/relatorios/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}


	public function vendas()
	{

		$this->subController = 'vendas/';

		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Relatório de Vendas';



		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view = ABSPATH . '/views/relatorios/vendas-list-view.php';
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

		$this->title = 'Relatório de Prorrogados';



		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view = ABSPATH . '/views/prorrogados/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function vendasAERO()
	{

		$this->subController = 'vendasAero/';

		$model = $this->load_model('transacoes/transacoes-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Relatório de Vendas  Aero';

		$this->filter = '3';

		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view = ABSPATH . '/views/relatorios/vendas-list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function vendasHD()
	{

		$this->subController = 'vendasHD/';

		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Relatório de Vendas HD';

		$this->filter = '1, 5';

		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view = ABSPATH . '/views/relatorios/vendas-list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

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

	public function importTransactionVoucher()
	{

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		$model = $this->load_model('relatorios/relatorios-model');
		$data = $model->importTransactionVoucher($parametros[0]);



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


	public function exportReport()
	{



		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$data = $model->exportReport();

		//var_dump($data);

		//die();

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

		$nome = 'Relatório de Transações ' . date("d-m-Y H:i") . '.xlsx';

		$t = 'A';

		foreach ($data[0] as $key => $item):


			$spreadsheet->setActiveSheetIndex(0)->setCellValue($t . 1, $key);



			$t++;



			//break;

		endforeach;


		$t = 2;

		foreach ($data as $item):

			$b = 'A';
			foreach ($item as $key => $_item):



				if ($key == 'Valor do Plano' || $key == 'Desconto do Plano' || $key == 'Valor Final do Plano' || $key == 'Valor Pago'):

					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, (float) $_item);

				else:

					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, '="' . $_item . '"');

				endif;

				$b++;
			endforeach;



			//$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$b, '="'.$item.'"');


			$t++;
		endforeach;

		// Rename worksheet
		//$spreadsheet->getActiveSheet()->setTitle($name);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $nome . '"');
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

	public function exportProrrogados()
	{



		$model = $this->load_model('relatorios/relatorios-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$data = $model->exportProrrogados();



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

		$nome = 'Relatório de Transações ' . date("d-m-Y H:i") . '.xlsx';

		$t = 'A';

		foreach ($data[0] as $key => $item):


			$spreadsheet->setActiveSheetIndex(0)->setCellValue($t . 1, $key);



			$t++;



			//break;

		endforeach;


		$t = 2;

		foreach ($data as $item):

			$b = 'A';
			foreach ($item as $key => $_item):



				if ($key == 'Valor do Plano' || $key == 'Desconto do Plano' || $key == 'Valor Final do Plano' || $key == 'Valor Pago'):

					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, (float) $_item);

				else:

					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, '="' . $_item . '"');

				endif;

				$b++;
			endforeach;



			//$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$b, '="'.$item.'"');


			$t++;
		endforeach;

		// Rename worksheet
		//$spreadsheet->getActiveSheet()->setTitle($name);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $nome . '"');
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

	public function exportReportVouchers()
	{

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		$this->tipo = $parametros[0];

		$model = $this->load_model('relatorios/relatorios-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$data = $model->exportReportVoucher('', $this->tipo);

		//var_dump(count($data));

		//die();

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

		$nome = 'Relatório de Transações ' . date("d-m-Y H:i") . '.xlsx';

		$t = 'A';

		foreach ($data[0] as $key => $item):


			$spreadsheet->setActiveSheetIndex(0)->setCellValue($t . 1, $key);



			$t++;



			//break;

		endforeach;


		$t = 2;

		foreach ($data as $item):

			$b = 'A';
			foreach ($item as $key => $_item):


				if ($key == 'Simcard'):

					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, '="' . $_item . '"');


				elseif ($key == 'Valor Original' || $key == 'Valor Base U$' || $key == 'Valor Base R$' || $key == 'Cotação' || $key == 'Valor Total R$' || $key == 'Valor Total U$' || $key == 'Valor Frete' || $key == 'Valor Venda R$' || $key == 'Valor Venda U$' || $key == 'Valor a Receber' || $key == 'Valor de Repasse'):


					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, (float) $_item);



				else:

					$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $t, $_item);

				endif;

				$b++;
			endforeach;

			//$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$b, '="'.$item.'"');


			$t++;
		endforeach;



		// Rename worksheet
		//$spreadsheet->getActiveSheet()->setTitle($name);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);



		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $nome . '"');
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

	public function vouchers()
	{

		$this->isLogged();

		$this->permission_required = ($this->tipo == 'site' ? 'vouchers_site' : 'vouchers_corp');

		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		$this->tipo = $parametros[0];

		$this->subController = 'vouchers/' . $this->tipo;

		$model = $this->load_model('relatorios/relatorios-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');


		$this->title = 'Relatório de Vendas (Vouchers ' . ucfirst($this->tipo) . ')';

		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->tipo = $parametros[0];


		$this->view = ABSPATH . '/views/relatorios/vouchers/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function ocorrencias()
	{


		$this->isLogged();

		$this->subController = 'ocorrencias/';

		$model = $this->load_model('relatorios/relatorios-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->notify = $model->checkNotify();

		$this->title = 'Ocorrências';

		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view = ABSPATH . '/views/relatorios/ocorrencias/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';


	}

	public function changeSim()
	{


		$model = $this->load_model('relatorios/relatorios-model');
		$model->changeSim();



	}



	public function getSellersByDay()
	{


		$model = $this->load_model('relatorios/relatorios-model');
		$reports = $model->getSellersByDay(TRUE);

		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';


	}



}
