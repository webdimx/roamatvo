<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
/**
 * UserRegisterController - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class AjaxController extends MainController
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


	public function getCity(){

		echo $this->getCities($_POST[city]);

	}

	public function zipConsult(){


	    $zip = $_POST[zip];
		$url = "https://viacep.com.br/ws/$zip/json/";


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_URL, $url );

		$output = curl_exec($ch);

		echo $output;

		curl_close( $ch );

	}

	public function getOptionsRecharge(){

		$model = $this->load_model('ajax/ajax-model');
		$model->getOptionsRecharge();

	}

	public function sendEmail($subject, $email, $template){

		$modelEmail = $this->load_model('email/email-model');
		echo $modelEmail->_sendEmail($subject, $email, $template);

	}

	public function upload(){

		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		@mkdir(FILES.'/'.$parametros[0]);

		$uploaddir = FILES.'/'.$parametros[0].'/';

		foreach($_FILES as $file)
		{
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename(utf8_decode(buildSlug($file['name'])))))
		{
		$files[] = '/'.$parametros[0].'/'.buildSlug($file['name']);
		}

		}

		echo json_encode($files);

	}


	public function insertImage(){

		$uploaddir = FILES.'/emails/';

		if ($_FILES['file']['name']) {

            if (!$_FILES['file']['error']) {

				$name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = $uploaddir . $filename; //change this directory
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                echo HOME_URI.'/views/_files/emails/' . $filename;//change this URL
            }
            else
            {
              echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
        }


	}

	public function getAlerTotal(){

		$model = $this->load_model('ajax/ajax-model');
		echo $alerts = $model->getCountNotify();
	}


	public function getAlert(){

		$model = $this->load_model('ajax/ajax-model');

		$alerts = $model->getNotify();

		$txt = array(

			array('link' => 'javascript:;', 'text' => 'O aluno com matrícula nº {cod} faltou.'),
			array('link' => HOME_URI.'agendamento/editar/{target_id}', 'text' => 'O aluno com matrícula nº {cod} desmarcou a aula {nome}.'),
			array('link' => HOME_URI.'agendamento/editar/{target_id}', 'text' => 'Foi desmarcada a aula {nome} do aluno com matrícula nº {cod}.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'Sua fatura {cod} referente ao mensalidade venceu hoje.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'Sua fatura {cod} referente ao multa venceu hoje.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'Sua fatura {cod} referente a matricula venceu hoje.'),
			array('link' => 'javascript:;', 'text' => 'Foi gerada uma nova multa hora aula para o aluno com matricula nº {cod}.'),
			array('link' => HOME_URI.'financeiro/detalhes/{cod}', 'text' => 'Sua fatura {cod} referente a material venceu hoje.')

		);

		foreach($alerts as $alert):
		?>
		<li class="<?=($alert[status]==1?'':'read')?>" >
			<a href="<?=str_replace(array('{cod}', '{target_id}'), array($alert[codigo], $alert[target_id]), $txt[$alert[type]][link])?>" class="alertItem" data-id="<?=$alert[ID]?>">
				<div class="clearfix">
					<span class="pull-left">
						<?=str_replace(array('{cod}', '{nome}'), array($alert[codigo], $alert[nome]), $txt[$alert[type]][text])?>
					</span>

				</div>
			</a>
		</li>
		<?
		endforeach;


	}

	public function markAlert(){

		$model = $this->load_model('ajax/ajax-model');
		$model->_markAlert();
	}

	public function CheckSession(){

		if($this->logged_in!=1):

		$this->logout();

		endif;

		echo $this->logged_in;

	}


	public function xls(){


		require ABSPATH.'/frameworks/phpspreadsheet/vendor/autoload.php';


		$spreadsheet = IOFactory::load(ABSPATH.'/csv.csv');
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		var_dump($sheetData);




	}


	public function getDetailsSearch(){

		$model = $this->load_model('atribuidos/atribuidos-model');
		$modelSwap = $this->load_model('swap/swap-model');
		$_item = $model->getSearchDetails();

		if($_POST[tipo]=='venda'):

		?>

														<div class="">
															<div class="row">


																<div class="col-xs-12 col-sm-4">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[iccid]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor_simcard]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Lote SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[lote_simcard]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Estoque </div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_estoque]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[mdn]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor_mdn]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Lote MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[lote_mdn]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Plano </div>

																			<div class="profile-info-value">
																				<span><?=$_item[plano]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name"> Tipo</div>

																			<div class="profile-info-value">
																				<span><?=($_item[tipo]==1?'Venda':($_item[tipo]==2?'Desatvação':'Cancelamento'))?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> n</div>

																			<div class="profile-info-value">
																				<span><?=($_item[emitir_nota]==1?'s':'')?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Data da Transação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_transacao]?></span>
																			</div>
																		</div>









																	</div>
																</div>

																<div class="col-xs-12 col-sm-4">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">


																	<div class="profile-info-row">
																			<div class="profile-info-name"> Data da Ativação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_ativacao]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Data Off</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_off]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name"> Atendente</div>

																			<div class="profile-info-value">
																				<span><?=$_item[atendente]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local da Venda </div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_venda]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Ponto de Venda </div>

																			<div class="profile-info-value">
																				<span><?=$_item[ponto_venda]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Nome do Cliente </div>

																			<div class="profile-info-value">
																				<span><?=$_item[nome]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Celular</div>

																			<div class="profile-info-value">
																				<span><?=$_item[celular]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name"> E-mail</div>

																			<div class="profile-info-value">
																				<span><?=$_item[email]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name">Documento</div>

																			<div class="profile-info-value">
																				<span><?=$_item[documento]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name">Local de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_uso]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Dias de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[dias_uso]?></span>
																			</div>
																		</div>



																	</div>
																</div>

																<div class="col-xs-12 col-sm-4">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">

																	<div class="profile-info-row">
																			<div class="profile-info-name"> Valor do Plano</div>

																			<div class="profile-info-value">
																				<span><?=$_item[valor_plano]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Forma de Pagamento </div>

																			<div class="profile-info-value">
																				<span><?=$_item[forma_pagamento]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Moeda </div>

																			<div class="profile-info-value">
																				<span><?=$_item[moeda]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Desconto </div>

																			<div class="profile-info-value">
																				<span><?=$_item[desconto]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Valor Pago</div>

																			<div class="profile-info-value">
																				<span><?=$_item[valor_pago]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Status</div>

																			<div class="profile-info-value">
																				<span><?
				  switch($_item[status]):

					 case"1":
						echo 'Aguardando Swap de ativação';
					 break;

					 case"2":
						echo 'Ativo';
					 break;

					 case"3":
						echo 'Aguardando Swap de desativação';
					 break;

					 case"4":
						echo 'Desativado';
					 break;

		          endswitch;
				  ?></span>


																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name">Aparelho</div>

																			<div class="profile-info-value">
																				<span><?=$_item[aparelhos]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Países Informados</div>

																			<div class="profile-info-value">
																				<span><?=$_item[paises]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Lote Ativação</div>

																			<div class="profile-info-value">
																				<span><?=$modelSwap->getLoteAtivacao($_item[ID])?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Lote Desativação</div>

																			<div class="profile-info-value">
																				<span><?=$modelSwap->getLoteDesativacao($_item[ID])?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Observações</div>

																			<div class="profile-info-value">
																				<span><?=$_item[observacao]?></span>
																			</div>
																		</div>



																	</div>
																</div>




															</div>
														</div>

		<?
		elseif($_POST[tipo]=='simcard'):
		?>
		<div class="table-detail">
															<div class="row">


																<div class="col-xs-12 col-sm-6">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[simcard]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Status SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[status_simcard]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Lote SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[lote]?></span>
																			</div>
																		</div>
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor SIMCARD </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor]?></span>
																			</div>
																		</div>
																		<?
																		if($_item[mdn]):
																		?>
																		<div class="profile-info-row">
																			<div class="profile-info-name"> MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[mdn]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Lote MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[lote_mdn]?></span>
																			</div>
																		</div>
																		<?
																		endif;
																		?>

																			<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Estoque</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_estoque]?></span>
																			</div>
																		</div>



																		<div class="profile-info-row">
																			<div class="profile-info-name"> Plano </div>

																			<div class="profile-info-value">
																				<span><?=$_item[plano]?></span>
																			</div>
																		</div>




																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_uso]?></span>
																			</div>
																		</div>





																	</div>
																</div>

																<div class="col-xs-12 col-sm-6">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">



																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Venda</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_venda]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Nome</div>

																			<div class="profile-info-value">
																				<span><?=$_item[nome]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> E-mail</div>

																			<div class="profile-info-value">
																				<span><?=$_item[email]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Observação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[observacoes]?></span>
																			</div>
																		</div>




																		<div class="profile-info-row">
																			<div class="profile-info-name"> Dias</div>

																			<div class="profile-info-value">
																				<span><?=$_item[qtd_dias]?></span>
																			</div>
																		</div>






																		<div class="profile-info-row">
																			<div class="profile-info-name">Ponto de Venda</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_ativacao]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Celular</div>

																			<div class="profile-info-value">
																				<span><?=$_item[celular]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Documento</div>

																			<div class="profile-info-value">
																				<span><?=$_item[documento]?></span>
																			</div>
																		</div>

																	</div>
																</div>


															</div>
														</div>
		<?
		else:
		?>

<div class="table-detail">
															<div class="row">


																<div class="col-xs-12 col-sm-6">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[mdn]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Status MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[status]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Fornecedor MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[fornecedor]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Lote MDN </div>

																			<div class="profile-info-value">
																				<span><?=$_item[lote]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name"> Plano </div>

																			<div class="profile-info-value">
																				<span><?=$_item[plano]?></span>
																			</div>
																		</div>


																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Uso</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_uso]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Local de Venda</div>

																			<div class="profile-info-value">
																				<span><?=$_item[local_venda]?></span>
																			</div>
																		</div>






																	</div>
																</div>

																<div class="col-xs-12 col-sm-6">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">





																		<div class="profile-info-row">
																			<div class="profile-info-name"> E-mail</div>

																			<div class="profile-info-value">
																				<span><?=$_item[email]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Observação</div>

																			<div class="profile-info-value">
																				<span><?=$_item[observacoes]?></span>
																			</div>
																		</div>




																		<div class="profile-info-row">
																			<div class="profile-info-name"> Dias</div>

																			<div class="profile-info-value">
																				<span><?=$_item[qtd_dias]?></span>
																			</div>
																		</div>





																		<div class="profile-info-row">
																			<div class="profile-info-name">Ponto de Venda</div>

																			<div class="profile-info-value">
																				<span><?=$_item[data_ativacao]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Celular</div>

																			<div class="profile-info-value">
																				<span><?=$_item[celular]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Documento</div>

																			<div class="profile-info-value">
																				<span><?=$_item[documento]?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Nome</div>

																			<div class="profile-info-value">
																				<span><?=$_item[nome]?></span>
																			</div>
																		</div>

																	</div>
																</div>


															</div>
														</div>
		<?

		endif;

	}

	public function getDoctor(){



	    $curl = curl_init();

				curl_setopt_array($curl, array(
				CURLOPT_PORT => "8080",
				CURLOPT_URL => "https://ws.cfm.org.br:8080/WebServiceConsultaMedicos/ServicoConsultaMedicos?wsdl=",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30000,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "

				<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://servico.cfm.org.br/\">\n
				<soapenv:Header/>\n
				<soapenv:Body>\n
				<ser:Consultar>\n
				<crm>".$_REQUEST[crm]."</crm>\n
				<!--Optional:-->\n
				<uf>".$_REQUEST[crm_uf]."</uf>\n
				<!--Optional:-->\n
				<chave>3BX55VQ7</chave>\n
				</ser:Consultar>\n
				</soapenv:Body>\n</soapenv:Envelope>",


				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {

				echo json_encode(array('return' => false, 'messagem' => "cURL Error #:" . $err));


				} else {



				$xml = $response;
				$xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", '$1$2$3', $xml);
				$xml = simplexml_load_string($xml);
				$json = json_encode($xml);
				$responseArray = json_decode($json, true); // true to have an array, false for an object
				echo json_encode(array('return' => 'true', 'data' => $responseArray[soapBody][ns2ConsultarResponse][dadosMedico][nome])) ;

	}

	}


	public function testEmail(){

		$model = $this->load_model('transacoes/transacoes-model');
		$model->sendEmail();

	}

} // class home
