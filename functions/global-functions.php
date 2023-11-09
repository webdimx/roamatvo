<?php



date_default_timezone_set('America/Sao_Paulo');

/**
 * Verifica chaves de arrays
 *
 * Verifica se a chave existe no array e se ela tem algum valor.
 * Obs.: Essa função está no escopo global, pois, vamos precisar muito da mesma.
 *
 * @param array  $array O array
 * @param string $key   A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array ( $array, $key ) {
	// Verifica se a chave existe no array
	if ( isset( $array[ $key ] ) && ! empty( $array[ $key ] ) ) {
		// Retorna o valor da chave
		return $array[ $key ];
	}

	// Retorna nulo por padrão
	return null;
} // chk_array

/**
 * Função para carregar automaticamente todas as classes padrão
 * Ver: http://php.net/manual/pt_BR/function.autoload.php.
 * Nossas classes estão na pasta classes/.
 * O nome do arquivo deverá ser class-NomeDaClasse.php.
 * Por exemplo: para a classe TutsupMVC, o arquivo vai chamar class-TutsupMVC.php
 */
function __autoload($class_name) {
	$file = ABSPATH . '/classes/class-' . $class_name . '.php';

	if ( ! file_exists( $file ) ) {
		require_once ABSPATH . '/includes/404.php';
		return;
	}

	// Inclui o arquivo da classe
    require_once $file;
} // __autoload



function getField($input, $code, $value, $array, $module){


	switch($input[type]):

		case"text":

			$val = unserialize($input[options]);
			$val = $val[0];

			return '
			<label class="control-label no-padding-right">'.$input[label].'</label><br>
			<input class=" '.($module?'col-xs-8':'col-xs-12').'  '.$input[code].' " '.($val?"data-default=".$val."":'').'   type="text" name="'.($module?$module:'product').'['.$code.']['.$input[code].']'.($array?'[]':'').'" value="'.($value?$value:$val).'">
			';

		break;

		case"phone":

			$val = unserialize($input[options]);
			$val = $val[0];

			return '
			<label class="control-label no-padding-right">'.$input[label].'</label><br>
			<input class="telefone  '.($module?'col-xs-8':'col-xs-12').' '.$input[code].' "  '.($val?"data-default=".$val."":'').'  type="text" name="'.($module?$module:'product').'['.$code.']['.$input[code].']'.($array?'[]':'').'"   value="'.($value?$value:$val).'">
			';

		break;

		case"money":

			$val = unserialize($input[options]);
			$val = $val[0];

			return '
			<label class="control-label no-padding-right">'.$input[label].'</label><br>
			<input class="money   '.($module?'col-xs-8':'col-xs-12').' '.$input[code].'"  '.($val?"data-default=".$val."":'').' type="text" name="'.($module?$module:'product').'['.$code.']['.$input[code].']'.($array?'[]':'').'"   value="'.($value?number_format($value, 2, ',', '.'):number_format($val, 2, ',', '.')).'">


			';

		break;


		case"date":

			$val = unserialize($input[options]);
			$val = $val[0];

			return '



			<label class="control-label no-padding-right">'.$input[label].'</label><br>
			<input class="date-picker '.$input[code].'  '.($module?'col-xs-8':'col-xs-12').'   id="id-date-picker-1" type="text" name="'.($module?$module:'product').'['.$code.']['.$input[code].']'.($array?'[]':'').'"  data-date-format="dd-mm-yyyy"  value="'.($value?$value:$val).'">
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>

			';

		break;


	endswitch;

}

function getWidget($title, $content){

	$widget =
	'
	<div class="widget-box widget-root ui-sortable-handle" id="widget-box-1">
    <div class="widget-header widget-header-small">
        <h5 class="widget-title">'.$title.'</h5>
        <div class="widget-toolbar">
            <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
			<a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
			<a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-main">
        '.$content.'
        </div>
    </div>
	</div>
	';

	return $widget;



}

function str_replace_first($a,$b,$s)
{
    $w=strpos($s,$a);
    if($w===false)return $s;
    return substr($s,0,$w).$b.substr($s,$w+strlen($a));
}



function formatDate($date, $hour){

	$_data = explode(' ', $date);
	$data = explode('-', $_data[0]);

	return $data[2].'/'.$data[1].'/'.$data[0].($hour?' - '.$_data[1]:'');

}

function formatMoney($money){

	$money  = str_replace_first('.','', $money);
	return str_replace(',','.', $money);


}



function money($money){


	return number_format($money , 2, ',', '.');


}

function diff($data1, $data2){

	$datetime1 = new DateTime($data1);
	$datetime2 = new DateTime($data2);
	$interval = $datetime1->diff($datetime2);
	return $interval->format('%a');

}


function formatMoneyHtml($money){

	$money  = str_replace('.','', $money);
	return str_replace(',','.', $money);


}

function dateDB($date){

	$date = explode('/', $date);
	return $date[2].'-'.$date[1].'-'.$date[0].' 00:00:01';


}

function dateDBS($date){

	$date = explode('/', $date);
	return $date[2].'-'.$date[1].'-'.$date[0];


}

function dateAdd($type, $interval, $date) {

	$date = explode('-', $date);
	return date('Y-m-d', mktime(0,0,0, $date[1], $date[2] + (int)$interval, $date[0]));

}

function dateHDB($date){

	$date = explode('/', $date);
	return $date[2].'-'.$date[1].'-'.$date[0].' '.date('H:i:s');


}

function dateHDBF($date){

	$dat = explode(' ', $date);

	$date = explode('/', $dat[0]);

	return $date[2].'-'.$date[1].'-'.$date[0].' '.($dat[1]?$dat[1]:'00:00:00');


}

function timeDB($time){

	return $time.':00';

}

function buildSlug($text) {

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


function _sendEmail($subject, $email, $template){


		$mail = new PHPMailer;
		$mail->isSMTP();
		                                 // Set mailer to use SMTP
		$mail->Host = $this->server;  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $this->email;                 // SMTP username
		$mail->Password = $this->password;                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $this->port;                                    // TCP port to connect to

		$mail->setFrom($this->email, 'Original Redes de Proteção');
		$mail->addAddress('contato@webdim.com.br', 'Diego Mendes');     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Testing E-mail';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . PHPMailer::ErrorInfo;
		} else {
			echo 'Message has been sent';
	    }

	}


function buildTable($columns){


$table = '<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">';
$table .= '<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">';
$table .= '<thead>';
$table .= '<tr role="row">';
$table .= '<th class="sorting_disabled">Nome</th>';
$table .= '<th class="sorting_disabled">Endereço</th>';
$table .= '<th class="sorting_disabled">Diferencial</th>';
$table .= '<th class="sorting_disabled"></th>';
$table .= '</tr>';
$table .= '</thead>';
$table .= '<tbody>';

foreach($columns as $values):


$table .=  '<tr role="row" class="odd">';
$table .= '<td width="">'.$values[0].'</td>';
$table .= '<td  width="">'.$values[1].'</td>';
$table .= '<td  width="">'.$values[2].'</td>';
$table .= '<td  width="20">
<div class="action-buttons">
	<a href="'.$values[4].'" class="green bigger-140 show-details-btn" title="Show Details">
		<i class="ace-icon fa fa-angle-double-down"></i>
		<span class="sr-only">Details</span>
	</a>
</div></td>';

$table .= '</tr>';

$table .= '<tr class="detail-row">';
$table .= '<td colspan="4">';
$table .= '<div class="table-detail">';
$table .= '<div class="row">';
if($values[3]):
foreach($values[3] as $_product):
$table .= '<div class="col-xs-6">';
$table .= '<label>';
$table .= '<input name="product_id[]" value="'.$_product[product_id].'" type="checkbox" checked class="ace">';
$table .= '<span class="lbl"> '.$_product[product_name].'</span>';
$table .= '</label>';
$table .= '</div>';
endforeach;
else:
$table .= '<div class="col-xs-12">';
$table .= '<div class="header blue lighter less-margin">Nenhum produto cadastrado</div>';
$table .= '</div>';

endif;
$table .= '</div>';
$table .= '</div>';
$table .= '</td>';
$table .= '</tr>';
endforeach;



$table .= '</tbody>';
$table .= '</table>';
$table .= '<div class="row">';
$table .= '<input type="hidden" name="condominio_id">';
$table .= '</div>';
$table .= '</div>';

return $table;

}

function formatPayment($a){

	$a = explode(' ', $a);
	$a = str_replace('.','',$a[0]);
	return str_replace(array('US$', ',',), array('','.'), $a);

}

function getDataOff($data, $dias){


	$d = explode('/', $data);
	return date('Y-m-d', mktime(0,0,0, $d[1], $d[0]+($dias-1), $d[2]));

}


function formatCnpjCpf($value)


{


if($value=="Ao Consumidor"){
	return $value;
}

  $CPF_LENGTH = 11;
  $cnpj_cpf = preg_replace("/\D/", '', $value);

  if (strlen($cnpj_cpf) === $CPF_LENGTH) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
  }

  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

?>
