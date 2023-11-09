<?php

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class vendasExternasController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'transacoes';
	public $controller = 'vendas-externas';
	public $ignoreRequired = false;
	

    public function index() {
		
		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		
		$this->title = 'Vendas Externas Yes Control';
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/vendas-externas/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	
	
	public function importTransaction(){
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$json = MainController::CallApi('importTransaction', array('ID' => $parametros[0]));
		$data = $json->info;
		
		
		
		
		require ABSPATH.'/frameworks/phpspreadsheet/vendor/autoload.php';
		
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Sistema VoiceWay')
		->setLastModifiedBy('Sistema VoiceWay')
		->setTitle('Office 2007 XLSX Test Document')
		->setSubject('Office 2007 XLSX Test Document')
		->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
		->setKeywords('office 2007 openxml php')
		->setCategory('Test result file');

		
		$a = 1;
		
		foreach($data as $key => $item):
		
		
		$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$a, $key);
	
		$a++;
		endforeach;


		$name = 'Transação - '.$parametros[0].' - '.$data->data.'.xlsx';


		
		$b = 1;
		foreach($data as $key => $item ):

		$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$b, '="'.$item.'"');
		

		$b++;
		endforeach;

		// Rename worksheet
		//$spreadsheet->getActiveSheet()->setTitle($name);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);
        
		
		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$name.'"');
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
	
	
	public function exportReport(){
		
		
		
		$model = $this->load_model('transacoes/transacoes-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$data = $model->exportReport();
		
		$json = MainController::CallApi('exportReport', array('IDS' => $_GET[IDS]));
		$data = $json->info;
		
	
		
		require ABSPATH.'/frameworks/phpspreadsheet/vendor/autoload.php';
		
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Sistema VoiceWay')
		->setLastModifiedBy('Sistema VoiceWay')
		->setTitle('Office 2007 XLSX Test Document')
		->setSubject('Office 2007 XLSX Test Document')
		->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
		->setKeywords('office 2007 openxml php')
		->setCategory('Test result file');
		
		$nome = 'Relatório de Transações '.date("d-m-Y H:i").'.xlsx';
		
		$t = 'A';
		
		foreach($data[0] as $key => $item):
		
		
		$spreadsheet->setActiveSheetIndex(0)->setCellValue($t. 1, $key);
		
		
	
		$t++;
		
		
		
		//break;
		
		endforeach;
		
		
		$t = 2;
		
		foreach($data as $item ):
		
		  $b = 'A';
		  foreach($item as $_item):
				
				$spreadsheet->setActiveSheetIndex(0)->setCellValue($b.$t, '="'.$_item.'"');
		  
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
		header('Content-Disposition: attachment;filename="'.$nome.'"');
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
	
	
} 