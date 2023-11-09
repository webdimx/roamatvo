<?php
/**
 * MainController - Todos os controllers deverão estender essa classe
 *
 * @package TutsupMVC
 * @since 0.1
 */
class MainController extends UserLogin 

{

	/**
	 * $db
	 *
	 * Nossa conexão com a base de dados. Manterá o objeto PDO
	 *
	 * @access public
	 */
	public $db;

	/**
	 * $phpass
	 *
	 * Classe phpass 
	 *
	 * @see http://www.openwall.com/phpass/
	 * @access public
	 */
	public $phpass;

	/**
	 * $title
	 *
	 * Título das páginas 
	 *
	 * @access public
	 */
	public $title;

	/**
	 * $login_required
	 *
	 * Se a página precisa de login
	 *
	 * @access public
	 */
	public $login_required = false;

	/**
	 * $permission_required
	 *
	 * Permissão necessária
	 *
	 * @access public
	 */
	public $permission_required = 'any';

	/**
	 * $parametros
	 *
	 * @access public
	 */
	public $parametros = array();
	
	/**
	 * Construtor da classe
	 *
	 * Configura as propriedades e métodos da classe.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function __construct ( $parametros = array() ) {
	
		// Instancia do DB
		$this->db = new TutsupDB();
		
		// Phpass
		$this->phpass = new PasswordHash(8, false);
		
		// Parâmetros
		$this->parametros = $parametros;
		
		// Verifica o login
		$this->check_userlogin();
		
		$modelSwap = MainController::load_model('swap/swap-model');
		$modelCron = MainController::load_model('cron/cron-model');
		$model = MainController::load_model('ajax/ajax-model');
		//$model->getSells();
		$modelSwap->geraDataOff();
		//$modelCron->replicateTable();
		
		//$modelCron->replicateTable();
		
	} // __construct
	
	/**
	 * Load model
	 *
	 * Carrega os modelos presentes na pasta /models/.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function load_model( $model_name = false ) {
	
		// Um arquivo deverá ser enviado
		if ( ! $model_name ) return;
		
		// Garante que o nome do modelo tenha letras minúsculas
		$model_name =  strtolower( $model_name );
		
		// Inclui o arquivo
		$model_path = ABSPATH . '/models/' . $model_name . '.php';
		
		// Verifica se o arquivo existe
		if ( file_exists( $model_path ) ) {
		
			// Inclui o arquivo
			require_once $model_path;
			
			// Remove os caminhos do arquivo (se tiver algum)
			$model_name = explode('/', $model_name);
			
			// Pega só o nome final do caminho
			$model_name = end( $model_name );
			
			// Remove caracteres inválidos do nome do arquivo
			$model_name = preg_replace( '/[^a-zA-Z0-9]/is', '', $model_name );
			
			// Verifica se a classe existe
			if ( class_exists( $model_name ) ) {
			
				// Retorna um objeto da classe
				return new $model_name( $this->db, $this );
			
			}
			
			// The end :)
			return;
			
		} // load_model
		
	} // load_model
	
	
	
	public function buildSlug($text) {

    $replace = [
        '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
        '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä'=> 'Ae',
        '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
        'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
        'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
        'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
        'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
        'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
        'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
        'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
        'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
        'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
        'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
        'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
        'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
        '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
        'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
        'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
        'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
        'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
        'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
        'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
        'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
        'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
        'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
        'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
        'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
        'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
        '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
        'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
        'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
        'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
        'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
        'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
        'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
        'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
        'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
        'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
        'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
        'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
        'ю' => 'yu', 'я' => 'ya'
    ];

    // make a human readable string
    $text = strtr($text, $replace);

    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // remove unwanted characters
    $text = preg_replace('~[^-\w.]+~', '', $text);

    $text = strtolower($text);

    return $text;
}

public function sendEmail($subject, $email, $template){
	
	
	
}

public function getConfig(){
	
	    $query = $this->db->query("SELECT *  FROM `so_config` where ID = '1' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
		
		 ;
		return $query->fetch();
	
}

public function getTemplateEmail($code){
	
	    $query = $this->db->query("SELECT *  FROM `so_emails` where ID = '$code' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
	
		$return = $query->fetch();
		return  array('subject' => $return[assunto], 'content' => $return[mensagem]);
	
}

public function isLogged(){
	
	
	if ( ! $this->logged_in ){
		
		$this->logout();
		$this->goto_login();
		return;
	
}
	
	
}

public function checkPermission($permission){
	    
		if (!$this->check_permissions($permission, $this->userdata['user_permissions'])) {
			echo 'Você não tem permissões para acessar essa página.';
			
		}
}


public function getUserInfo(){
	
		$query = $this->db->query("SELECT *  FROM  ".($_SESSION['userdata']['type']==2?'wd_alunos':'wd_colaboradores')." where ID = '".$_SESSION['userdata']['entity_id']."' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
	
		return $query->fetch();	
	
}

public function Crypta($Valor){
			
	global $Chave;
	
	$Cipher = new AES(AES::AES256);
	
	$content 	= $Cipher->stringToHex( $Valor );
	$content 	= $Cipher->encrypt( $content, $Chave );
	
	return $content;
	
    }	

    public function Decrypta($Valor){
		
	global $Chave;
	
	$Cipher = new AES(AES::AES256);
	
	$content 	= $Cipher->decrypt( $Valor, $Chave );
	$content 	= $Cipher->hexToString( $content );
	
	return $content;
	

}	

public function pagi($total, $page){
	
	$pagination = (new Pagination());
    $pagination->setCurrent($page);
    $pagination->setTotal($total);
	
	return $pagination->parse();
	
}

public function getNotify(){
	
		
	
}

public function ReadNotity(){
	
	
	
}
	

public function getBanners($id) {
	
		$query = $this->db->query("SELECT *  FROM `wd_aulas_banner` where ID = '1' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
		
		return $query->fetch();
} 
	
public function _codfy($val){
	
	return $this->Crypta($val);
	
}
	
public function geTlogInfo($table, $id, $cel){
	
	$db = new TutsupDB();
	
	$query = $db->query("SELECT *  FROM `$table` where ID = '$id' ORDER BY ID DESC");
		if ( ! $query ) {
		return array();
		}
		
	$data = $query->fetch();
	
	return $data[$cel];
	
}	
	
	
public function log($user, $action){
	
	$db = new TutsupDB();
	
	$query = $db->insert('wd_logs', array(
		
				'id_user' => $user,
				'action' => $action,
				
		));
	
}
	
	
public function getAlertMessage($user, $sid, $msg){
	
	switch($msg){
			
		
		case"falta": 
			
		return array(
			
			'admin' => 'O aluno com número de matricula '.$sid.' faltou',
			'aluno' => 'Você esta tem uma nova falta'
		);
			
		break;
			
			
			
	}
	
	
}
	
	
public function alert($user, $aluno_id, $sid, $msg, $nome = 0, $tid = 0){
	
	$db = new TutsupDB();

	$query = $db->insert('wd_alertas', array('user_id' => $user, 'aluno_id' => $aluno_id, 'codigo' => $sid, 'type' => $msg, 'nome' => $nome, 'target_id' => $tid));
	
	
	
}
	
public function callApi($request, $data = array(), $tipo = 1, $requestType = 1){
	    
		if($tipo==1):
	    
		$url = YESURL;
		$credentials[customer] = YESCUSTOMER;
		$credentials[token] = YESKEY;
	
		endif;
	
		
	
		$data = http_build_query(array_merge($credentials, $data));
		
	
	
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url.$request.($requestType==1?'?'.$data:'') );
	   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, ($requestType==1?'GET':'POST'));
		curl_setopt( $ch, CURLOPT_POSTFIELDS, array_merge($data, $credentials) );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
		$response = curl_exec( $ch );
	
		curl_close( $ch );
	
				
		return json_decode($response);
}
	
	
} // class MainController