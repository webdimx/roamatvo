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
              <label class="control-label no-padding-right" for="form-field-1">País:</label><br>
              <select name="<?= $this->controller ?>[pais]" class="col-xs-12 col-sm-12 col-lg-12 required">
                <option value="">Selecione</option>
                <?
                foreach ($modelConfig->getOptions('paises', true) as $option):
                  ?>
                  <option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data['pais'] ? 'selected' : '') ?>>
                    <?= $option['nome'] ?>
                  </option>
                  <?
                endforeach;
                ?>
              </select>
            </p>
          </div>



          <div class="col-lg-4">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Continente:</label><br>
              <select name="<?= $this->controller ?>[continente]" class="col-xs-12 col-sm-12 col-lg-12 required">
                <option value="">Selecione</option>
                <?
                foreach ($modelConfig->getOptions('continentes', true) as $option):
                  ?>
                  <option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data['continente'] ? 'selected' : '') ?>>
                    <?= $option['nome'] ?>
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

        <table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid"
          aria-describedby="dynamic-table_info">
          <thead>
            <tr role="row">
              <th class="center" rowspan="1" colspan="1" width="20"><label class="pos-rel"></th>
              <th rowspan="1" colspan="1">Nome</th>
              <th rowspan="1" colspan="1">Capacidade</th>
              <th rowspan="1" colspan="1">Código</th>
              <th rowspan="1" colspan="1">Descrição</th>
              <th rowspan="1" colspan="1">Fornecedor</th>
              <th rowspan="1" colspan="1"></th>
            </tr>
          </thead>

          <tbody class="item-list">

            <?

            $opcoes = ($opcoes ? $opcoes : [1]);
            foreach ($opcoes as $data):

              ?>
              <tr role="row" class="odd item">
                <td align="center" style="vertical-align: middle">
                  <input type="radio" value="1" name="<?= $this->controller ?>[preferencial][]" <?= ($data[preferencial] ? 'checked' : '') ?>>
                <td>
                  <input type="text" name="<?= $this->controller ?>[opcao_nome][]" class="col-xs-12 col-sm-12 col-lg-12 "
                    value="<?= $data[nome] ?>">
                </td>
                <td>
                  <input type="text" name="<?= $this->controller ?>[quantidade][]" class="col-xs-12 col-sm-12 col-lg-12 "
                    value="<?= $data[quantidade] ?>">
                </td>
                <td>
                  <input type="text" name="<?= $this->controller ?>[codigocmovel][]"
                    class="col-xs-12 col-sm-12 col-lg-12 " value="<?= $data[codigo] ?>">
                </td>
                <td>
                  <input type="text" name="<?= $this->controller ?>[descricao][]" class="col-xs-12 col-sm-12 col-lg-12 "
                    value="<?= $data[descricao] ?>">
                </td>
                <td align="center"><select name="<?= $this->controller ?>[fornecedor][]"
                    class="col-xs-12 col-sm-12 col-lg-12">
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
                  </select></td>
                <td align="center" style="vertical-align: middle">
                  <button type="button" class="add" style="border:none;border-radius:50%;background-color:#629B58;color:#fff;width: 25px;
    height: 25px;"><i class="fa fa-plus"></i></button>
                  <button type="button" class="remove" style="border:none;border-radius:50%;background-color:#D15B47;color:#fff;width: 25px;
    height: 25px;"><i class="fa fa-remove"></i></button>
                </td>
              </tr>
              <?
            endforeach;
            ?>
          </tbody>
        </table>


      </div>
    </div>
  </div>

</div>

<script>
  $(document).ready(function () {


    $('body').on('click', '.add', function () {
      let clone = $('.item:last-child').clone()
      clone.find('input[type=text]').val('')
      clone.find('input[type=radio]').prop('checked', false)
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
