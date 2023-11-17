<?
if ($this->action == 'edit'):

  $data = $this->data['plano'];
  $opcoes = $this->data['opcoes'];
endif;
?>



<div class="widget-box  ui-sortable-handle page-box" id="informacoes" style="opacity: 1;">
  <div class="widget-header widget-header-small">
    <h6 class="widget-title">Informações</h6>
  </div>

  <div class="widget-body">
    <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
      <div class="content">



        <div class="row">

          <div class="col-lg-4 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Nome:</label><br>
              <input type="text" name="<?= $this->controller ?>[nome]" class="col-xs-12 col-sm-12 col-lg-12 required"
                value="<?= $data[nome] ?>">
            </p>
          </div>

          <div class="col-lg-4 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Codigo Plano:</label><br>
              <input type="text" name="<?= $this->controller ?>[codigo_plano]"
                class="col-xs-12 col-sm-12 col-lg-12 required" value="<?= $data[codigo_plano] ?>">
            </p>
          </div>

          <div class="col-lg-4 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Valor:</label><br>
              <input type="text" name="<?= $this->controller ?>[valor]" class="col-xs-12 col-sm-12 col-lg-12  money "
                value="<?= money($data[valor]) ?>">
            </p>
          </div>

          <div class="col-xs-12 ">
            <p>


              <label class="control-label no-padding-right" for="form-field-1">Situação:</label><br>


              <label>
                <input name="<?= $this->controller ?>[situacao]" type="radio" class="ace" value="1"
                  <?= ($data[situacao] == 1 || !$data[situacao] ? 'checked' : '') ?>>
                <span class="lbl"> Ativo</span>
              </label>
              <label>
                <input name="<?= $this->controller ?>[situacao]" type="radio" class="ace" value="2"
                  <?= ($data[situacao] == 2 ? 'checked' : '') ?>>
                <span class="lbl"> Inativo</span>
              </label>

            </p>
          </div>

          <div class="col-xs-4 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Qtd de Dias:</label><br>
              <input type="text" name="<?= $this->controller ?>[qtd_dias]"
                class="col-xs-12 col-sm-12 col-lg-12 required" value="<?= $data[qtd_dias] ?>">
            </p>
          </div>

          <div class="col-lg-4">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Local de Uso:</label><br>
              <select name="<?= $this->controller ?>[local_uso]" class="col-xs-12 col-sm-12 col-lg-12 required">
                <option value="">Selecione</option>
                <?
                foreach ($modelConfig->getOptions('local_de_uso', true) as $option):
                  ?>
                  <option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[local_uso] ? 'selected' : '') ?>>
                    <?= $option[local] ?>
                  </option>
                  <?
                endforeach;
                ?>
              </select>
            </p>
          </div>






          <div class="col-lg-12">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Observação:</label><br>
              <input type="text" name="<?= $this->controller ?>[observacao]" class="col-xs-12 col-sm-12 col-lg-12"
                maxlength="50" value="<?= $data[observacao] ?>">
            </p>
          </div>






          <p>&nbsp;</p>
          <div class="col-xs-12">
            <?
            if ($this->action):
              ?>
              <input type="hidden" name="<?= $this->controller ?>[action]" value="<?= $this->action ?>">
              <input type="hidden" name="<?= $this->controller ?>[ID]" value="<?= $data[ID] ?>">
              <input type="hidden" name="<?= $this->controller ?>[add]" value="">
              <?
            endif;
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<div class="widget-box  ui-sortable-handle page-box" id="opcoes" style="opacity: 1;">
  <div class="widget-header widget-header-small">
    <h6 class="widget-title">Opções de plano</h6>
  </div>

  <div class="widget-body">
    <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
      <div class="content">



        <div class="row">
          <div class="col-lg-12 item-list">
            <?

            foreach ($opcoes as $data):
              ?>
              <div class="row item" style="display:flex;gap: 15px;">
                <div class="">
                  <label class="control-label no-padding-right" for="form-field-1">Preferêncial:</label><br>
                  <input type="radio" value="1" name="<?= $this->controller ?>[preferencial][]" <?= ($data[preferencial] ? 'checked' : '') ?>>
                </div>
                <div class="">
                  <p>
                    <label class="control-label no-padding-right" for="form-field-1">Quantidade:</label><br>
                    <input type="text" name="<?= $this->controller ?>[quantidade][]"
                      class="col-xs-12 col-sm-12 col-lg-12 " maxlength="2" value="<?= $data[quantidade] ?>">
                  </p>
                </div>

                <div class="">
                  <p>
                    <label class="control-label no-padding-right" for="form-field-1">Código:</label><br>
                    <input type="text" name="<?= $this->controller ?>[codigocmovel][]"
                      class="col-xs-12 col-sm-12 col-lg-12 " value="<?= $data[codigo] ?>">
                  </p>
                </div>
                <div class="col-lg-3">
                  <p>
                    <label class="control-label no-padding-right" for="form-field-1">Descrição:</label><br>
                    <input type="text" name="<?= $this->controller ?>[descricao][]" class="col-xs-12 col-sm-12 col-lg-12 "
                      value="<?= $data[descricao] ?>">
                  </p>
                </div>
                <div class="col">
                  <p>
                    <label class="control-label no-padding-right" for="form-field-1">Fornecedor:</label><br>
                    <select name="<?= $this->controller ?>[fornecedor][]" class="col-xs-12 col-sm-12 col-lg-12">
                      <option value="">Selecione</option>
                      <?
                      foreach ($modelConfig->getOptions('fornecedores', true) as $option):
                        ?>
                        <option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[fornecedor] ? 'selected' : '') ?>>
                          <?= $option[nome] ?>
                        </option>
                        <?
                      endforeach;
                      ?>
                    </select>
                  </p>
                </div>
                <div class="col">
                  <p>
                    <button type="button" class="add"><i class="fa fa-plus"></i></button>
                    <button type="button" class="remove"><i class="fa fa-remove"></i></button>
                  </p>
                </div>
              </div>
            <? endforeach; ?>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<script>
  $(document).ready(function () {


    $('body').on('click', '.add', function () {
      let clone = $('.item:last-child').clone()
      clone.find('input').val('')
      $('.item-list').append(clone)

    })

    $('body').on('click', '.remove', function () {
      $(this).parents('.item').remove()
    })


    /////



    $('.tipo').change(function () {



      if ($(this).val() != 1) {

        $('.venc').html('Vencimento:')

      }

      else {

        $('.venc').html('Data do Primeiro Vencimento:')


      }


      if ($(this).val() == 2) {

        $('.venc').html('Vencimento:')
        $('.ha').hide()
        $('.ha').find('select, input').val()
        $('.ha').find('select, input').removeClass('required')

      }
      else {

        $('.ha').show()
        $('.ha').find('select, input').val()
        //$('.ha').find('select, input').addClass('required')

      }





    })

    $('.fp').change(function () {


      if ($(this).val() == 2) {

        $('.venc').html('Vencimento:')
        $('.pd').hide()
        $('.pd').find('select, input').val()
        $('.pd').find('select, input').removeClass('required')
      }
      else {

        $('.venc').html('Data do Primeiro Vencimento:')
        $('.pd').show()
        $('.pd').find('select, input').val()
        $('.pd').find('select, input').addClass('required')

      }

    })



  })
</script>
