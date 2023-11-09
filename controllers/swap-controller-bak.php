<?php


use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SwapController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'swap';
	public $controller = 'swap';

    public function index() {
		
		$model = $this->load_model('swap/swap-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		
		$this->title = 'Swaps Pendentes';
		$this->menu = 'swap';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/swap/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	public function detalhe() {
		
		$model = $this->load_model('swap/swap-model');
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		$this->data = $model->getRegistry($parametros[0]);
		
		
		$this->title = 'SWAP Lote: '.$this->data[0][ID].' - '.$model->getFornecedor(str_replace(array("'", '-'), array('', ','), $this->data[0][fornecedor])).' - '.$this->data[0][data].'_'.$this->data[0][hora] ;
		$this->menu = 'swap';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		
		
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
	
	
      	$this->view[]  = ABSPATH . '/views/swap/gerados/view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function gerados() {
		
		$this->subController = 'gerados';
		
		$model = $this->load_model('swap/swap-model');
		
		$this->title = 'Swaps Gerados';
		$this->menu = 'swap';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		
      	$this->view  = ABSPATH . '/views/swap/gerados/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	public function emails() {
		
		$this->subController = 'emails';
		
		$model = $this->load_model('swap/swap-model');
		
		$this->title = 'Swap E-mails';
		$this->menu = 'emails';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		
		$this->form = 'swap/emails/submit/';
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		array('anchor' => 'log', 'icon' => 'fa-history', 'title' => 'Log de E-mails'),
		);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		
      	$this->view[]  = ABSPATH . '/views/swap/emails/view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	
	public function adicionar() {
		
		$model = $this->load_model('swap/swap-model');
		$modelAlunos = $this->load_model('alunos/alunos-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Fatura';		
		$this->menu = 'swap';
		$this->form = 'swap/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		
		);
		
	
      	$this->view[]  = ABSPATH . '/views/swap/form-view.php';
		
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('swap/swap-model');
		$modelAlunos = $this->load_model('alunos/alunos-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar fatura';		
		$this->menu = 'swap';
		$this->form = 'swap/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/swap/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('swap/swap-model');
		$model->_submit();
		
		
    } 
	
	function delRegistry(){
		
		$model = $this->load_model('swap/swap-model');
		echo $model->del($_POST[ids]);
		
	}
	
	function getSwapPendent(){
		
		$model = $this->load_model('swap/swap-model');
		$model->getSwapPendent();
	}
	
	function getFornecedores(){
		
		$model = $this->load_model('swap/swap-model');
		$itens = $model->getFornecedores();
		
		if($itens):
		?>
			<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px"> 
			<label class="pos-rel"><input type="checkbox" class="ace checkAll" value=""><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
			<span><strong>SELECIONAR TODOS</strong></span>
			</div>
			</div>
		<?
		foreach($itens as $data):
		?>	
		<div class="profile-info-row">
			<div class="profile-info-name" style="width: 25px"> 
				<label class="pos-rel"><input type="checkbox" class="ace" value="'<?=$data[ID]?>'"><span class="lbl"></span></label>
			</div>
			<div class="profile-info-value">
				<span><?=$data[fornecedor]?></span>
			</div>
		</div>
			
		<?
		endforeach;
		?>
			</div>		
		<?
		else:
		?>
		<p></p><p class="text-center">Não existe Swap  de  <?=($_POST[tipo]==1?'ativação':'desativação')?> pendente para hoje!</p>	
		<?
		endif;
	}
	
	
	public function export(){
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		$model = $this->load_model('swap/swap-model');
		require ABSPATH.'/frameworks/phpspreadsheet/vendor/autoload.php';
		
		$data = $this->data = $model->getRegistry($parametros[0]);
		
		
		
		
		
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

// Add some data
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'MDN')
    ->setCellValue('B1', 'SIMCARD ANTIGO')
    ->setCellValue('C1', 'ÚLTIMO '.($data[0][tipo]==1?'ATIVAÇÃO ':'DESATIVAÇÃO ').'')
    ->setCellValue('D1', 'SIMCARD NOVO')
	->setCellValue('E1', 'NOME DO CLIENTE')
	->setCellValue('F1', 'DATA ATIVAÇÃO')
    ->setCellValue('G1', 'PLANO')
	->setCellValue('H1', 'DIAS')
	->setCellValue('I1', 'DATA DESATIVAÇÃO');

// Miscellaneous glyphs, UTF-8
		



$name = 'Lote '.$parametros[0].' '.$data[0][data].'.xlsx';
		
		
$_attributes = $model->getSwapItens($parametros[0]);
$letters = array('B', 'C', 'D', 'E', 'F');
$x=2;
foreach($_attributes as $_item):

$last = $model->getLastInfo(($_item[tipo]?$_item[da]:$_item[data_off]), $_item[mdn], $data[tipo]);
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A'. $x, '="'.$_item[mdn].'"')
	->setCellValue('B'. $x, '="'.$last[iccid].'"')
	->setCellValue('C'. $x ,$last[data_ativacao])
	->setCellValue('D'. $x, '="'.$_item[iccid].'"')
	->setCellValue('E'. $x, $_item[nome])
	->setCellValue('F'. $x, $_item[data_ativacao])
	->setCellValue('G'. $x, $_item[plano])
	->setCellValue('H'. $x, $_item[dias])
	->setCellValue('I'. $x, $_item[data_desativacao]);

$x++;
endforeach;

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle($name);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);
		
$nome = 'SWAP '.($data[0][tipo]==1?'Ativacao':'Desativacao').'_Lote'.$data[0][ID].' - '.$model->getFornecedor(str_replace(array("'", '-'), array('', ','), $data[0][fornecedor])).' '.$data[0][data].'_'.$data[0][hora];
		
		
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nome.'.xlsx"');
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
	
	
	function autoSwap(){
		
		$model = $this->load_model('swap/swap-model');
		$model->autoSwap();
	}
	
	
} 