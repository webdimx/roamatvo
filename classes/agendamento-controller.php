<?php

class AgendamentoController extends MainController
{
	
	public $login_required = true;
	public $permission_required = 'agendamento';
	public $controller = 'agendamento';

    public function index() {
		
		$model = $this->load_model('agendamento/agendamento-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$this->title = 'Gerenciar Agenda';
		$this->menu = 'agendamento';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/agendamento/list-view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
    } 
	
	
	
	public function calendario() {
		
		$model = $this->load_model('agendamento/agendamento-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$this->title = 'Calendário';
		$this->menu = 'agendamento';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
      	$this->view  = ABSPATH . '/views/agendamento/view.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
		
    } 
	
	public function aulas() {
		
		
		$this->permission_required = 'aluno';
		
		$model = $this->load_model('agendamento/agendamento-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$this->title = 'Aulas Agendadas';
		$this->menu = 'agendamento';
		$this->isLogged();
		$this->checkPermission($this->permission_required);
				
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$user = $this->getUserInfo();
		
		$this->user_id = $user[ID];
		
		
		
		
	
      	$this->view  = ABSPATH . '/views/agendamento/view-month.php';
		require ABSPATH . '/views/_includes/1-column.php';
		
		
		
    } 
	
	public function adicionar() {
		
		$model = $this->load_model('agendamento/agendamento-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$modelStudent = $this->load_model('alunos/alunos-model');
		$modelColaboradores = $this->load_model('colaboradores/colaboradores-model');
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Adicionar Agendamento';		
		$this->menu = 'agendamento';
		$this->form = 'agendamento/submit/';
		
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		array('anchor' => 'alunos', 'icon' => 'fa-graduation-cap', 'title' => 'Alunos'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/agendamento/form-view.php';
		$this->view[]  = ABSPATH . '/views/agendamento/alunos-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function editar() {
		
		$model = $this->load_model('agendamento/agendamento-model');
		$modelConfig = $this->load_model('configuracoes/configuracoes-model');
		$modelColaboradores = $this->load_model('colaboradores/colaboradores-model');
		
		
		$this->isLogged();
		$this->checkPermission($this->permission_required);
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
		$this->title = 'Editar Agendamento';		
		$this->menu = 'agendamento';
		$this->form = 'agendamento/submit/';
		$this->action = 'edit';
		$this->data = $model->getRegistry($parametros[0]);
		
		$this->sidebar = (object) array(
		array('anchor' => 'informacoes', 'icon' => '', 'title' => 'Informações'),
		array('anchor' => 'alunos', 'icon' => 'fa-graduation-cap', 'title' => 'Alunos'),
		);
		
	
      	$this->view[]  = ABSPATH . '/views/agendamento/form-view.php';
		$this->view[]  = ABSPATH . '/views/agendamento/alunos-view.php';
		require ABSPATH . '/views/_includes/2-columns-left.php';
		
    } 
	
	public function submit() {
		
		$model = $this->load_model('agendamento/agendamento-model');
		$model->_submit();
		
		
    } 
	
	public function getStudents(){
		
		$modelStudent = $this->load_model('alunos/alunos-model');
		$Students = $modelStudent->getList();
		echo $_GET[callback].'('.json_encode($Students[data]).')';		
		
	}
	
	
	
	function delRegistry(){
		
		$model = $this->load_model('agendamento/agendamento-model');
		echo $model->del($_POST[ids]);
		
	}
	
	public function getDetails(){
	
	$model = $this->load_model('agendamento/agendamento-model');
	$data = $model->getRegistry($_POST[id]);
	$data = $data[0];
	
		
	?>			
	
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                 <a href="http://localhost/doors/sistema/agendamento/duplicar/<?=$data[ID]?>" class="btn btn-xs btn-info pull-right" style="margin-right: 20px">
					<i class="ace-icon fa fa-files-o"></i>
				  <span class="bigger-110">Duplicar</span>
			  </a>
                <h4 class="blue sm"><?=formatDate($data[data])?></h4>
                
            </div>

            <div class="modal-body">
            
            	
              	 <div class="profile-user-info profile-user-info-striped">
                 
                 
                  <div class="profile-info-row">
                      <div class="profile-info-name" style="width:120px"> Sala </div>

                      <div class="profile-info-value">
                          <span><?=$data[nome_sala]?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name" style="width:120px"> Horário </div>

                      <div class="profile-info-value">
                          <span><?=$data[horario_inicial]?> - <?=$data[horario_termino]?> </span>
                      </div>
                  </div>
                  
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name" style="width:120px"> Modalidade </div>

                      <div class="profile-info-value">
                          <span><?=$data[nome_modalidade]?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name" style="width:120px"> Responsável </div>

                      <div class="profile-info-value">
                          <span><a href="<?=HOME_URI?>colaboradores/editar/<?=$data[id_responsavel]?>"><?=$data[nome_responsavel]?></a> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name" style="width:120px"> Pauta </div>

                      <div class="profile-info-value">
                          <span><?=$data[pauta]?> </span>
                      </div>
                  </div>
            </div>
            
            <?
			
            if(($_SESSION[userdata][type]!=2) and $model->getStudentList($_POST[id])):
			?>
            <hr>
            
            <div class="profile-user-info profile-user-info-striped">
            <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
            <div class="row">
            &nbsp;&nbsp;<i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i> Lista de Alunos
            
           
            </div>
            
            <table id="dynamic-table" class="table table-students table-striped table-bordered table-hover dataTable no-footer feed-grid" role="grid" aria-describedby="dynamic-table_info">
            
            
            <tbody>
            
            <tr>
                	<td colspan="5">
                	<div class="ui-widget">
                    		<input type="text" name="nome"  class="col-xs-6 col-sm-6 col-lg-6 auto-complete" placeholder="Pesquisar por Nome, Matrícula ou CPF">
                            <div class="ui-widget-content"></div>
                            </div>
                	</td>	
				</tr>
             <?
			 
			 $alunos = $model->getStudentList($_POST[id]);
             if($alunos):
			 	foreach($alunos as $aluno):
				?>
                <tr>
                  <td rowspan="1" colspan="1" width="50"><?=$aluno[matricula]?></td>
                  <td rowspan="1" colspan="1"><a href="<?=HOME_URI.'alunos/detalhes/'.$aluno[aluno_id]?>"><?=$aluno[nome]?></a></td>
                  <td rowspan="1" colspan="1" width="80"><?=($aluno[status]==3?'<sapn class="btn btn-minier btn-danger">Cancelado</span>':'<button class="btn cancel-schedule btn-minier btn-info" data-id="'.$this->Crypta($aluno[aluno_id]).'" data-eventid="'.$_POST[id].'" data-admin="true">Desmarcar</button>')?></td>
                  <td rowspan="1" colspan="1" width="50"><a href="<?=$aluno[ID]?>" class="btn btn-minier btn-danger l-del"><i class="ace-icon fa fa-trash-o bigger-120"></i></a></td>
                  <td rowspan="1" colspan="1" width="30">
                  <div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div></td>
                </tr>
                <tr class="detail-row">
                	<td colspan="4">
                	<div class="table-detail row">
                	<div class="row">
                		<form id="afterLesson">
                		<div class="col-xs-12"><strong>Presença:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                		
                		<label>
								<input name="presenca" type="radio" class="ace" value="1" <?=($aluno[presenca]==1?'checked':'')?>>
								<span class="lbl">Sim &nbsp;&nbsp;</span>
							</label>
							
							<label>
								<input name="presenca" type="radio" class="ace" value="2" <?=($aluno[presenca]==2?'checked':'')?>>
								<span class="lbl">Não &nbsp;&nbsp;</span>
							</label>
                		</div>
                		<div class="col-xs-12 dsp"><strong>Desempenho: </strong>&nbsp;&nbsp;
							<label class="hide">
								<input name="desempenho" type="radio" class="ace" value="0" <?=($aluno[desempenho]==0?'checked':'')?>>
								<span class="lbl">None &nbsp;&nbsp;</span>
							</label>
							
							<label>
								<input name="desempenho" type="radio" class="ace" value="1" <?=($aluno[desempenho]==1?'checked':'')?>>
								<span class="lbl">Bad &nbsp;&nbsp;</span>
							</label>
							
							<label>
								<input name="desempenho" type="radio" class="ace" value="2" <?=($aluno[desempenho]==2?'checked':'')?>>
								<span class="lbl">Regular &nbsp;&nbsp;</span>
							</label>
							
							<label>
								<input name="desempenho" type="radio" class="ace" value="3" <?=($aluno[desempenho]==3?'checked':'')?>>
								<span class="lbl">Good </span>
							</label>
						</div>
						
						<div class="col-xs-12">
						<br><br>
							<button class="btn btn-minier btn-info">Atualizar</button>							
						</div>
						<input type="hidden" value="<?=$aluno[ID]?>" name="id">
						</form>
						</div>
               	</div>
                	</td>	
				</tr>
				<?
				endforeach;
			 endif;
			 ?>
            </tbody>
            </table>
  
            
            </div>
            </div>
            
            <?
			else:
			
			if($_SESSION[userdata][type]==2):
		
			$lesson = $model->getStudentList($_POST[id]);
			
			endif;
			endif;
           
			?>
            
            
            
			</div>
            <div class="modal-footer">
              <div class="schedule-feed pull-left">
              	
              </div>
              <?
			  /*$date = explode('/', formatDate($data[data]));
              $hour = explode(':', $data[horario_inicial]);
			  
			  $data_evento = mktime($hour[0]+4, $hour[1], '00', $date[1], $date[0], $date[2]);
			  
			  $date  = new DateTime($data[data].' '.$data[horario_inicial],':00');
			  $date2 = new DateTime(date("Y-m-d H:i:s"));
			  
			  var_dump($date->diff($date2));*/
			  
			  ?>
              
              
               <? if($_SESSION[userdata][type]==2 and $data[horas]>=4):?>
               
             
               <span class="btn btn-danger cancel-schedule btn-sm pull-right" data-id="<?=$this->Crypta( $this->getUserInfo()[ID])?>" data-eventId="<?=$_POST[id]?>"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar agendamento</span>
               <? endif;?>
            </div>
            
            
      
	<?	
	}
	
	
	public function cancelarAgendamento(){
		
		$model = $this->load_model('agendamento/agendamento-model');
		$model->cancelSchedule($this->Decrypta($_POST[id]));
		
	}
	
	public function duplicar(){
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		$model = $this->load_model('agendamento/agendamento-model');
		$model->duplicate($parametros[0]);
		
	}
	
	public function afterLesson(){
		
		$model = $this->load_model('agendamento/agendamento-model');
		$model->_afterLesson();
	
	}
	
	public function insertStudent(){
		
		$model = $this->load_model('agendamento/agendamento-model');
		$id = $model->_insertStudent();
		
		echo  $this->Crypta($_POST[aluno]).'--'.$id;
	}
	
	public function delSchedule(){
		
		$model = $this->load_model('agendamento/agendamento-model');
		 $model->_delSchedule();
		
	}
	
} 