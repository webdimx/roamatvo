<?php if (!defined('ABSPATH'))
	exit; ?>

<?php if ($this->login_required && !$this->logged_in)
	return; ?>

<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state">
	<script type="text/javascript">
		try { ace.settings.loadState('sidebar') } catch (e) { }


	</script>
	<style>

	</style>

	<ul class="nav nav-list">

		<? if ($this->userdata['grupo'] != 8): ?>

			<li class="hover home">
				<a href="<?php echo HOME_URI; ?>">
					<i class="menu-icon fa fa-home"></i>
					<span class="menu-text"> Página Inicial </span>
				</a>


			</li>


			<?
		endif;
		?>

		<?
		if ($this->check_permissions('transacoes', $this->userdata['user_permissions'])):
			?>


			<li class="hover produtos">
				<a href="<?php echo HOME_URI; ?>transacoes/">
					<i class="fa fa-usd menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Transações
					</span>
				</a>

			</li>

			<?
		endif;
		?>

		<?
		if ($this->check_permissions('transacao', $this->userdata['user_permissions'])):
			?>
			<li class="hover produtos">
				<a href="<?php echo HOME_URI; ?>transacoes/adicionar">
					<i class="fa fa-usd menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Transação
					</span>
				</a>

			</li>
			<?
		endif;
		?>


		<?
		if ($this->check_permissions('transacoes', $this->userdata['user_permissions'])):
			?>
			<li class="hover produtos">
				<a href="<?php echo HOME_URI; ?>transacoes/trinta-dias">
					<i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Transações + de 30 dias
					</span>
				</a>

			</li>
			<?
		endif;
		?>



		<?
		if ($this->check_permissions('swap', $this->userdata['user_permissions'])):
			?>
			<li class="hover produtos">
				<a href="#" class="dropdown-toggle">
					<i class="fa fa-refresh menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Swap
					</span>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li><a href="<?php echo HOME_URI; ?>swap">Swap Pendentes</a></li>
					<li><a href="<?php echo HOME_URI; ?>swap/gerados">Swap Gerados</a></li>

				</ul>
			</li>
			<?
		endif;
		?>
		<?
		if ($this->check_permissions('transacoes', $this->userdata['user_permissions'])):
			?>
			<li class="hover produtos">
				<a href="<?php echo HOME_URI; ?>transacoes/prorrogados">
					<i class="fa fa-expand menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Prorrogados
					</span>
				</a>

			</li>
			<?
		endif;
		?>
		<!--
					<?
					if ($this->check_permissions('atribuidos', $this->userdata['user_permissions'])):
						?>
					<li class="hover produtos">
						<a href="<?php echo HOME_URI; ?>atribuidos">
							<i class="fa fa-file-o menu-icon" aria-hidden="true"></i>
							<span class="menu-text">
								Atribuidos
							</span>
						</a>
						<b class="arrow"></b>
												<ul class="submenu">
												 <li><a href="<?php echo HOME_URI; ?>atribuidos/historico">Histórico</a></li>


												</ul>
					</li>
										<?
					endif;
					?>
									 -->

		<?
		if ($this->check_permissions('helpdesk', $this->userdata['user_permissions'])):
			?>
			<li class="hover produtos">
				<a href="<?php echo HOME_URI; ?>helpdesk">
					<i class="fa fa-life-ring menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Help Desk
					</span>
				</a>

			</li>
			<?
		endif;
		?>


		<?
		if ($this->check_permissions('helpdesk', $this->userdata['user_permissions'])):
			?>
			<li class="hover produtos">
				<a href="<?php echo HOME_URI; ?>reembolso">
					<i class="fa fa-exchange menu-icon" aria-hidden="true"></i>
					<span class="menu-text">
						Reembolso
					</span>
				</a>

			</li>
			<?
		endif;
		?>

		<? if ($this->userdata['grupo'] == 8):
			?>
			<li class="hover produtos"><a href="<?php echo HOME_URI; ?>relatorios/ocorrencias">
					<i class="fa fa-exclamation-circle menu-icon" aria-hidden="true"></i>

					<span class="menu-text">
						Ocorrências
					</span>
				</a>
			</li>
		<? endif; ?>



		<?
		if ($this->userdata['grupo'] == 8):
			?>
			<li class="hover">
				<a href="#" class="dropdown-toggle">
					<i class="fa fa-file-text-o menu-icon" aria-hidden="true"></i>
					Simcards
					<b class="arrow fa fa-angle-right"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu can-scroll">

					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>

							Status
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu can-scroll">
							<li><a href="<?php echo HOME_URI; ?>cadastros/simcard">Cadastrar SIMCARD</a></li>
						</ul>
					</li>

					<?
		endif;
		?>


				<?
				if ($this->check_permissions('helpdesk', $this->userdata['user_permissions'])):
					?>
					<!--<li class="hover produtos">

						<a href="<?php echo HOME_URI; ?>controle">
							<i class="fa fa-book menu-icon" aria-hidden="true"></i>
							<span class="menu-text">
								Controle
							</span>
						</a>

					</li>-->
					<?
				endif;
				?>
				<?
				if ($this->check_permissions('relatorios', $this->userdata['user_permissions'])):
					?>
					<li class="hover produtos">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-pie-chart menu-icon" aria-hidden="true"></i>
							<span class="menu-text">
								Relatórios
							</span>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<?
							if ($this->check_permissions('relatorios_vendas', $this->userdata['user_permissions'])):
								?>
								<li><a href="<?php echo HOME_URI; ?>relatorios/vendas">Vendas</a></li>
								<?
							endif;



							if ($this->check_permissions('relatorios_vendas', $this->userdata['user_permissions'])):
								?>
								<li><a href="<?php echo HOME_URI; ?>relatorios/prorrogados">Prorrogados</a></li>
								<?
							endif;


							if ($this->check_permissions('relatorios_ocorrencias', $this->userdata['user_permissions'])):
								?>
								<li><a href="<?php echo HOME_URI; ?>relatorios/ocorrencias">Ocorrências</a></li>
							<? endif; ?>
						</ul>
					</li>
					<?
				endif;
				?>





				<?
				if ($this->check_permissions('cadastros', $this->userdata['user_permissions'])):

					if ($this->userdata['grupo'] != 8):
						?>
						<li class="hover produtos">
							<a href="#" class="dropdown-toggle">
								<i class="fa fa-file-text-o menu-icon" aria-hidden="true"></i>
								<span class="menu-text">
									Cadastros
								</span>
							</a>
							<b class="arrow"></b>
							<ul class="submenu">
								<li><a href="<?php echo HOME_URI; ?>cadastros/planos">Planos</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/fornecedores">Fornecedores</a></li>


								<li class="hover">
									<a href="#" class="dropdown-toggle">
										<i class="menu-icon fa fa-caret-right"></i>

										MDN/SIMCARD
										<b class="arrow fa fa-angle-right"></b>
									</a>

									<b class="arrow"></b>

									<ul class="submenu can-scroll">

										<li class="hover">
											<a href="#" class="dropdown-toggle">
												<i class="menu-icon fa fa-caret-right"></i>

												Status
												<b class="arrow fa fa-angle-down"></b>
											</a>

											<b class="arrow"></b>

											<ul class="submenu can-scroll">
												<li><a href="<?php echo HOME_URI; ?>cadastros/status-mdn">Status MDN</a></li>
												<li><a href="<?php echo HOME_URI; ?>cadastros/status-simcard">Status SIMCARD</a></li>
											</ul>
										</li>

										<li class="hover">
											<a href="#" class="dropdown-toggle">
												<i class="menu-icon fa fa-caret-right"></i>

												Cadastro
												<b class="arrow fa fa-angle-down"></b>
											</a>

											<b class="arrow"></b>

											<ul class="submenu can-scroll">
												<li><a href="<?php echo HOME_URI; ?>cadastros/mdn">Cadastrar MDN</a></li>
												<li><a href="<?php echo HOME_URI; ?>cadastros/simcard">Cadastrar SIMCARD</a></li>
												<li><a href="#modal-import-lote" class="ic" data-toggle="modal" data-type="3">Cadastrar
														MDN/SIMCARD</a></li>

											</ul>
										</li>

										<li><a href="<?php echo HOME_URI; ?>cadastros/tipo-de-uso">Tipo de uso para (MDN/SIMCARD)</a></li>

									</ul>
								</li>


								<li><a href="<?php echo HOME_URI; ?>cadastros/atendentes">Atendentes</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/local-de-venda">Locais de Vendas</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/ponto-de-venda">Ponto de Vendas</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/local-de-uso">Locais de Uso</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/local-de-estoque">Local de Estoque</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/formas-de-pagamento">Formas de Pagamento</a></li>
								<li><a href="<?php echo HOME_URI; ?>cadastros/moedas">Moedas</a></li>
								<li><a href="<?php echo HOME_URI; ?>colaboradores">Usuarios</a></li>


							</ul>
						</li>
						<?
					endif;
				endif;
				?>



			</ul><!-- /.nav-list -->
</div>
