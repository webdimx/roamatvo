<?php

class FaturaController extends MainController
{
	
	public $login_required = true;
	public $controller = 'fatura';

    public function gerar() {
		
		$model = $this->load_model('transacoes/transacoes-model');
		$this->isLogged();
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		$model->gerFatura($parametros[0]);
	
    } 
	
} 