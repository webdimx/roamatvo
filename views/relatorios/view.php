<?
if($this->action=='view'):
$data = $this->data[0];
endif;


?>

<div class=" page-box" id="informacoes" style="opacity: 1;">

 <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Aluno </div>

                      <div class="profile-info-value">
                          <span><?=$data[nome]?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Valor </div>

                      <div class="profile-info-value">
                          <span>R$ <?=money($data[valor])?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Forma de Pagamento </div>

                      <div class="profile-info-value">
                          <span><?=formatDate($data[data_vencimento])?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Data de emissão </div>

                      <div class="profile-info-value">
                          <span><?=formatDate($data[data_lancamento])?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Data de Vencimento </div>

                      <div class="profile-info-value">
                          <span><span><?=formatDate($data[data_vencimento])?> </span> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Data de Pagamento </div>

                      <div class="profile-info-value">
                          <span><span><?=($data[data_pagamento]?formatDate($data[data_pagamento]):'Pagamento Pendente')?> </span> </span>
                      </div>
                  </div>
                  
                  
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Status </div>

                      <div class="profile-info-value">
                          <span><?=$model->getStatus($data[status])?> </span>
                      </div>
                  </div>
                  
                  <div class="profile-info-row">
                      <div class="profile-info-name"> Observações </div>

                      <div class="profile-info-value">
                          <span><?=$data[observacoes]?> </span>
                      </div>
                  </div>
                  
              </div>
</div>
        