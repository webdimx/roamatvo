<?php

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class cadastrosController extends MainController
{

	public $login_required = true;
	public $permission_required = 'cadastros';
	public $controller = 'cadastros';
	public $ignoreRequired = false;

	public function index()
	{

		$model = $this->load_model('usuarios/usuarios-model');

		$this->title = 'Gerenciar usuários';
		$this->menu = 'usuarios';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/usuarios/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	// Planos

	public function planos()
	{

		$this->subController = '/planos/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Planos';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/planos/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarplano()
	{

		$this->subController = '/planos/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Plano';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/planos';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
			array('anchor' => 'opcoes', 'icon' => 'fa-list', 'title' => 'Opções')
		);


		$this->view[] = ABSPATH . '/views/cadastros/planos/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarplano()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Plano';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/planos';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'planos');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
			array('anchor' => 'opcoes', 'icon' => 'fa-list', 'title' => 'Opções')
		);


		$this->view[] = ABSPATH . '/views/cadastros/planos/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// Fornecedores

	public function fornecedores()
	{


		$this->subController = '/fornecedores/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Fornecedores';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/fornecedores/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarFornecedores()
	{

		$this->subController = '/fornecedores/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Fornecedor';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/fornecedores';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/fornecedores/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarFornecedores()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Fornecedor';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/fornecedores';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'fornecedores');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/fornecedores/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}


	// Atendentes

	public function atendentes()
	{

		$this->subController = '/atendentes/';
		$model = $this->load_model('cadastros/cadastros-model');

		$this->title = 'Atendentes';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/atendentes/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarAtendente()
	{

		$this->subController = '/atendentes/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Atendente';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/atendentes';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/atendentes/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarAtendente()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Atendente';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/atendentes';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'atendentes');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/atendentes/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// Locais de Vendas

	public function localDeVenda()
	{



		$this->subController = '/local-de-venda';
		$model = $this->load_model('cadastros/cadastros-model');

		$this->title = 'Locais de Vendas';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/localdevenda/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarLocalDeVenda()
	{

		$this->subController = '/local-de-venda';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Local de Venda';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/localdevenda';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/localdevenda/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarLocalDeVenda()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Local de Venda';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/localdevenda';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'localdevenda');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/localdevenda/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// Local de Estoque

	public function localDeEstoque()
	{



		$this->subController = '/local-de-estoque';
		$model = $this->load_model('cadastros/cadastros-model');

		$this->title = 'Locais de Estoque';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/localdeestoque/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarLocalDeEstoque()
	{

		$this->subController = '/local-de-estoque';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Local de Estoque';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/localdeestoque';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/localdeestoque/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarLocalDeEstoque()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Local de Estoque';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/localdeestoque';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'localdeestoque');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/localdeestoque/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function adicionarContinente()
	{

		$this->subController = '/continente';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Continente';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/continente';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/continente/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarContinente()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Continente';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/conteinente';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'continente');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/continente/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}




	// Ponto de Vendas

	public function pontoDeVenda()
	{

		$this->subController = '/ponto-de-venda/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Ponto de Vendas';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/pontodevenda/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarPontoDeVenda()
	{

		$this->subController = '/ponto-de-venda/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Ponto de Venda';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/pontodevenda';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/pontodevenda/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarPontoDeVenda()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Ponto de Venda';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/pontodevenda';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'pontodevenda');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/pontodevenda/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// Locais de Uso

	public function localDeUso()
	{

		$this->subController = '/local-de-uso/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Locais de Uso';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/localdeuso/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarlocalDeUso()
	{

		$this->subController = '/local-de-uso/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Local';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/localdeuso';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/localdeuso/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarlocalDeUso()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Local';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/localdeuso';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'localdeuso');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/localdeuso/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	//  Formas de Pagamento

	public function formasDePagamento()
	{

		$this->subController = '/formas-de-pagamento/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Formas de Pagamento';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/formasdepagamento/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarFormasDePagamento()
	{

		$this->subController = '/formas-de-pagamento/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Forma de Pagamento';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/formasdepagamento';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/formasdepagamento/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarFormasDePagamento()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Plano';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/formasdepagamento';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'formasdepagamento');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/formasdepagamento/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// Moedas

	public function moedas()
	{

		$this->subController = '/moedas/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Moedas';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/moedas/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarMoedas()
	{


		$this->subController = '/moedas/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Moeda';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/moedas';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/moedas/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarMoedas()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Moeda';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/moedas';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'moedas');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/moedas/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// Status MDN

	public function statusMDN()
	{


		$this->subController = '/status-mdn/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Status MDN';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/statusmdn/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarStatusMDN()
	{

		$this->subController = '/status-mdn/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Status MDN';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/statusmdn';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/statusmdn/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarStatusMDN()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Status MDN';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/statusmdn';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'statusmdn');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/statusmdn/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}



	// Usuarios


	public function statusSimcard()
	{

		$this->subController = '/status-simcard';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Status SIMCARD';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/statussimcard/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarstatusSimcard()
	{

		$this->subController = '/status-simcard';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Status SIMCARD';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/statussimcard';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/statussimcard/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarstatusSimcard()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Status SIMCARD';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/statussimcard';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'statussimcard');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/statussimcard/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}


	// TIPO STATUS

	public function tipoDeUso()
	{

		$this->subController = '/tipo-de-uso/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Tipos de uso para MDN/SIMCARD';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/tiposuso/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarTipoDeUso()
	{

		$this->subController = '/tipo-de-uso/';

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Tipo de Uso para SIMCARD/MDN';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/tipodeuso';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/tiposuso/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarTipoDeUso()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Tipo de Uso para SIMCARD/MDN';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/tipodeuso';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'tipodeuso');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/tiposuso/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}


	//MDN


	public function MDN()
	{


		$this->subController = '/mdn/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'MDN';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/mdn/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarMDN()
	{

		$this->subController = '/mdn/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar MDN';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/mdn';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/mdn/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarMDN()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar MDN';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/mdn';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'mdn');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/mdn/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	// SIMCARD



	public function Simcard()
	{

		$this->subController = '/sim-card/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'SIMCARD';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/simcard/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}

	public function adicionarSimcard()
	{

		$this->subController = '/sim-card/';

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar SIMCARD';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/simcard';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/simcard/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editarSimcard()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar SIMCARD';
		$this->menu = 'cadastros';
		$this->form = 'cadastros/submit/simcard';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0], 'simcard');


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/cadastros/simcard/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}


	// Envio de SIMCARD



	public function enviosSimcard()
	{

		$this->subController = '/envios_simcard/';
		$model = $this->load_model('cadastros/cadastros-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');

		$this->title = 'Envio de SIMCARD para local de Vendas';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/enviosimcard/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}




	public function alertas()
	{

		$model = $this->load_model('cadastros/cadastros-model');

		$this->title = 'Alertas';
		$this->menu = 'cadastros';
		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->view = ABSPATH . '/views/cadastros/alertas-view.php';
		require ABSPATH . '/views/_includes/1-column.php';

	}


	public function detalhes()
	{

		$model = $this->load_model('usuarios/usuarios-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);

		$this->data = $model->getRegistry($parametros[0]);


		$this->title = 'Home';
		$this->menu = 'usuarios';
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);

		$this->view[] = ABSPATH . '/views/usuarios/view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';



	}

	public function adicionar()
	{

		$model = $this->load_model('usuarios/usuarios-model');

		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Adicionar Usuário';
		$this->menu = 'usuarios';
		$this->form = 'usuarios/_submit/';


		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/usuarios/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function editar()
	{

		$model = $this->load_model('usuarios/usuarios-model');


		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$this->title = 'Editar Usuário';
		$this->menu = 'usuarios';
		$this->form = 'usuarios/_submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);

		$this->sidebar = (object) array(
			array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		);


		$this->view[] = ABSPATH . '/views/usuarios/form-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';

	}

	public function submit()
	{

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$model = $this->load_model('cadastros/cadastros-model');
		$model->_submit($parametros[0], $parametros[1]);


	}


	function delRegistry()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		echo $model->del($_POST[ids], $_POST[table]);

	}

	public function getPlano()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		echo json_encode($model->getRegistry($_POST[ID], 'planos'));

	}

	public function getPonto()
	{

		$model = $this->load_model('cadastros/cadastros-model');
		echo json_encode($model->getPonto($_POST[ID]));

	}

	public function importer($tmp)
	{




		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		echo $file = ($parametros ? FILES . '/' . $parametros[0] . '/' : TEMP) . $_FILES[lote][name];
		move_uploaded_file($_FILES[lote][tmp_name], $file);




	}

	public function changeStatus($tmp)
	{


		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		echo $file = ($parametros ? FILES . '/' . $parametros[0] . '/' : TEMP) . $_FILES[lote][name];
		move_uploaded_file($_FILES[lote][tmp_name], $file);




	}

	public function changeStatusData($tmp)
	{


		$model = $this->load_model('configuracoes/configuracoes-model');
		$model2 = $this->load_model('cadastros/cadastros-model');

		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';

		$spreadsheet = IOFactory::load($_POST[file]);
		$file = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);



		if ($file):


			$i = 0;

			foreach ($file as $line):

				if ($i == 0):

				else:


					$model2->changeStatus($line[A], $_POST[status]);

				endif;

				$i++;

			endforeach;

		endif;








	}

	public function importerData()
	{

		$model = $this->load_model('configuracoes/configuracoes-model');
		$model2 = $this->load_model('cadastros/cadastros-model');

		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';

		$spreadsheet = IOFactory::load($_POST[file]);
		$file = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);


		if ($file):

			$error = 0;

			$mdn = array();
			$simcard = array();

			$i = 0;
			foreach ($file as $line):

				if ($i == 0):

				else:


					if (!$line[A] and !$line[B]):


					elseif ($model2->importExists(strtoupper(($_POST[tipo] == 1 ? $line[B] : $line[A])), $_POST[tipo])):

						$error = $error + 1;

						($line[A] ? array_push($simcard, $line[A]) : '');
						($line[B] ? array_push($mdn, $line[B]) : '');

					else:

						$model2->customImporter(strtoupper($line[A]), strtoupper($line[B]), $_POST[fornecedor_simcard], $_POST[fornecedor_mdn], $_POST[tipo_uso], $_POST[status_mdn], $_POST[status_simcard], $_POST[local_estoque], $_POST[lote], $_POST[tipo]);

					endif;



				endif;

				///if(($_POST[tipo]==1?$line[B]:$line[A])):

				$i++;

				//endif;

				/*if($i==0):



																													else:
																													?>


																												<tr role="row" class="odd">

																														 <input type="hidden" name="lote" value="1">
																														<?if($_POST[tipo]==2 || $_POST[tipo]==3):?>
																														<td ><input type="hidden" name="<?=$this->controller?>[simcard][]" value="<?=$line[A]?>"><?=$line[A]?></td>
																														<? endif;?>
																														<? if($_POST[tipo]==1 || $_POST[tipo]==3):?>
																														<td  ><input type="hidden" name="<?=$this->controller?>[mdn][]" value="<?=$line[B]?>"><?=$line[B]?></td>
																														<? endif;?>

																														<? if($_POST[tipo]==2 || $_POST[tipo]==3):?>
																														<td  ><input type="hidden" name="<?=$this->controller?>[fornecedor_simcard][]" value="<?=$_POST[fornecedor_simcard]?>" ><?=$model->getDetail('fornecedores', $_POST[fornecedor_simcard], 'nome')?></td>
																														<? endif;?>
																														<? if($_POST[tipo]==1 || $_POST[tipo]==3):?>
																														<td  ><input type="hidden" name="<?=$this->controller?>[fornecedor_mdn][]" value="<?=$_POST[fornecedor_mdn]?>" ><?=$model->getDetail('fornecedores', $_POST[fornecedor_mdn], 'nome')?></td>
																														<? endif;?>
																														<? if($_POST[tipo]==3):?>
																														<td  ><input type="hidden" name="<?=$this->controller?>[tipo_uso][]" value="<?=$_POST[tipo_uso]?>"><?=$model->getDetail('tipo_de_uso', $_POST[tipo_uso], 'apelido')?></td>
																														<? endif;?>
																														<? if($_POST[tipo]==1  || $_POST[tipo]==3):?>
																														<td ><input type="hidden" name="<?=$this->controller?>[status_mdn][]" value="<?=$_POST[status_mdn]?>"><?=$model->getDetail('status_mdn', $_POST[status_mdn], 'status')?></td>
																														<? endif;?>
																														<? if($_POST[tipo]==2 || $_POST[tipo]==3):?>
																														<td  ><input type="hidden" name="<?=$this->controller?>[status_simcard][]" value="<?=$_POST[status_simcard]?>"><?=$model->getDetail('status_simcard', $_POST[status_simcard], 'status')?></td>
																														<? endif;?>
																														<? if($_POST[tipo]==2 || $_POST[tipo]==3):?>
																														<td ><input type="hidden" name="<?=$this->controller?>[local_estoque][]" value="<?=$_POST[local_estoque]?>"><?=$model->getDetail('local_de_estoque', $_POST[local_estoque], 'local')?></td>
																														<? endif;?>
																														<td><input type="hidden" name="<?=$this->controller?>[lote][]" value="<?=$_POST[lote]?>"><?=$_POST[lote]?></td>
																												</tr>

																													<?

																													endif;


																													*/



			endforeach;

			//echo '</table></form> ';



			?>
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name">
						Total de registros
					</div>
					<div class="profile-info-value">
						<span>
							<?= $i - 1 ?>
						</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">
						Erros:
					</div>
					<div class="profile-info-value">
						<span>
							<?= $error ?>
						</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">
						Simcards duplicados:
					</div>
					<div class="profile-info-value">
						<span>
							<?= (count($simcard) ? implode(', ', $simcard) : '0') ?>
						</span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name">
						MDNs duplicados:
					</div>
					<div class="profile-info-value">
						<span>
							<?= (count($mdn) ? implode(', ', $mdn) : '0') ?>
						</span>
					</div>
				</div>
			</div>
			<?




		endif;






	}


	public function importerSend()
	{




		$model = $this->load_model('configuracoes/configuracoes-model');

		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';

		$spreadsheet = IOFactory::load($_POST[file]);
		$file = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

		$model = $this->load_model('cadastros/cadastros-model');
		$model->sendToLocal($file);


	}

	public function importerLocal()
	{


		$model = $this->load_model('cadastros/cadastros-model');
		$model->sendToLocal();



	}

	public function importerDataSell()
	{

		$model = $this->load_model('configuracoes/configuracoes-model');



		$file = fopen($_POST[file], 'r');

		echo
			'<form id="formLote" action="' . HOME_URI . $this->controller . '/submit/mdn/lote">
		 <table id="dynamic-table"  class="table table-striped table-bordered table-hover dataTableno-footer" role="grid" aria-describedby="dynamic-table_info">
		  <thead>
          <tr role="row">
          <th rowspan="1" colspan="1">SIMCARD</th>
		  <th rowspan="1" colspan="1">MDN</th>
		  <th rowspan="1" colspan="1">Fornecedor</th>
          <th rowspan="1" colspan="1">Status MDN</th>
		  <th rowspan="1" colspan="1">Status SIMCARD</th>
	      <th rowspan="1" colspan="1">Tipo de Uso</th>
          <th rowspan="1" colspan="1">Lote</th>
          </tr>
      	  </thead>';

		$i = 0;

		var_dump($line = fgetcsv($file));


		while (($line = fgetcsv($file)) !== false) {
			if ($i == 0):
			else:

				$line = explode(';', $line[0]);
				?>


				<tr role="row" class="odd">
					<td>
						<input type="hidden" name="lote" value="1">
						<input type="hidden" name="<?= $this->controller ?>[simcard][]" value="<?= $line[0] ?>">
						<?= $line[0] ?>
					</td>
					<td><input type="hidden" name="<?= $this->controller ?>[mdn][]" value="<?= $line[1] ?>">
						<?= $line[1] ?>
					</td>
					<td><input type="hidden" name="<?= $this->controller ?>[fornecedor][]" value="<?= $_POST[fornecedor] ?>">
						<?= $model->getDetail('fornecedores', $_POST[fornecedor], 'nome') ?>
					</td>
					<td><input type="hidden" name="<?= $this->controller ?>[status_mdn][]" value="<?= $_POST[status_mdn] ?>">
						<?= $model->getDetail('status_mdn', $_POST[status_mdn], 'status') ?>
					</td>
					<td><input type="hidden" name="<?= $this->controller ?>[status_simcard][]" value="<?= $_POST[status_simcard] ?>">
						<?= $model->getDetail('status_simcard', $_POST[status_simcard], 'status') ?>
					</td>
					<td><input type="hidden" name="<?= $this->controller ?>[tipo_uso][]" value="<?= $_POST[tipo_uso] ?>">
						<?= $model->getDetail('tipo_de_uso', $_POST[tipo_uso], 'apelido') ?>
					</td>
					<td><input type="hidden" name="<?= $this->controller ?>[lote][]" value="<?= $_POST[lote] ?>">
						<?= $_POST[lote] ?>
					</td>
				</tr>

				<?


			endif;
			$i++;
		}
		echo '</table></form> ';
		fclose($file);







	}

	public function getSearch()
	{


		$model = $this->load_model('cadastros/cadastros-model');
		$model->getSearch();

	}

	public function delSim()
	{


		$model = $this->load_model('cadastros/cadastros-model');
		$model->delSim();

	}


	public function export()
	{

		$type = $_GET[type];

		$model = $this->load_model('cadastros/cadastros-model');
		$data = $model->export();




		require ABSPATH . '/frameworks/phpspreadsheet/vendor/autoload.php';


		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Sistema RoamAtvo')
			->setLastModifiedBy('Sistema RoamAtvo')
			->setTitle('MDN/SIMCARD Export')
			->setSubject('MDN/SIMCARD Export')
			->setDescription('MDN/SIMCARD Export')
			->setKeywords('office 2007 openxml php')
			->setCategory('MDN/SIMCARD');

		$name = 'Simcards ' . date('d_m_Y') . '.xlsx';


		$a = 'A';
		$b = 'A';
		$c = 2;



		foreach ($data[0] as $key => $item):

			$spreadsheet->setActiveSheetIndex(0)->setCellValue($a . 1, $key);
			$a++;

		endforeach;


		foreach ($data as $itens) {


			foreach ($itens as $item):


				$spreadsheet->setActiveSheetIndex(0)->setCellValue($b . $c, '="' . $item . '"');

				$b++;

			endforeach;

			$b = 'A';

			$name = ($type == 'simcard' ? 'Simcards' : 'Mdns') . '_' . date('d_m_Y') . '.xlsx';


			$c++;



		} // End Last

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

}

