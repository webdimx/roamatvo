<?php 

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


/**
 * UserRegisterController - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class debugController extends MainController
{
	

	
	

	/**
	 * $login_required
	 *
	 * Se a página precisa de login
	 *
	 * @access public
	 */
	public $login_required = true;

	/**
	 * $permission_required
	 *
	 * Permissão necessária
	 *
	 * @access public
	 */
	public $permission_required = 'user-register';

	/**
	 * Carrega a página "/views/user-register/index.php"
	 */
    
	
	public function getChange(){
		
		require ABSPATH.'/frameworks/phpspreadsheet/vendor/autoload.php';
		
		/*$spreadsheet = IOFactory::load(FILES.'/troca.xlsx');
		$file = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		
		*/
		
		$model = $this->load_model('debug/debug-model');
		
		$model->change($file);
		
	}
	
	
	public function associate(){
		
		
		$model = $this->load_model('debug/debug-model');
		$model->associate();
		
	}
	
	public function fixOrigin(){
		
		
		$model = $this->load_model('ajax/ajax-model');
		$model->getCorpFix();
		
	}
	
} // class home