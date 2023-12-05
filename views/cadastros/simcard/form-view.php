<?
if ($this->action == 'edit'):
  $data = $this->data[0];



endif;


?>

<div class="widget-box  ui-sortable-handle page-box" id="cliente" style="opacity: 1;">
  <div class="widget-header widget-header-small">
    <h6 class="widget-title">Informações</h6>
  </div>

  <div class="widget-body">
    <div class="widget-main padding-20 scrollable " data-size="125" style="position: relative;">
      <div class="content">



        <div class="row">



          <div class="col-lg-12 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">SIMCARD:</label><br>
              <input type="text" name="<?= $this->controller ?>[simcard]" class="col-xs-12 col-sm-12 col-lg-12 required"
                value="<?= $data[simcard] ?>">
            </p>
          </div>
          <div class="col-lg-12 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Código:</label><br>
              <input type="text" name="<?= $this->controller ?>[codigo]" class="col-xs-12 col-sm-12 col-lg-12 required"
                value="<?= $data[codigo] ?>">
            </p>
          </div>
          <div class="col-lg-12 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1"> Fornecedor:</label><br>
              <select name="<?= $this->controller ?>[fornecedor_simcard]"
                class="col-xs-12 col-sm-12 col-lg-12 required">
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

          <div class="col-lg-12">
            <p>
              <label class="control-label no-padding-right" for="form-field-1"> Status Simcard:</label><br>
              <select name="<?= $this->controller ?>[status_simcard]" class="col-xs-12 col-sm-12 col-lg-12 required">
                <option value="">Selecione</option>
                <?
                foreach ($modelConfig->getOptions('status_simcard') as $option):
                  ?>
                  <option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[status] ? 'selected' : '') ?>>
                    <?= $option['status'] ?>
                  </option>
                  <?
                endforeach;
                ?>
              </select>
            </p>
          </div>


          <div class="col-lg-12">
            <p>
              <label class="control-label no-padding-right" for="form-field-1"> Local de Estoque:</label><br>
              <select name="<?= $this->controller ?>[local_estoque]" class="col-xs-12 col-sm-12 col-lg-12 required">
                <option value="">Selecione</option>
                <?
                foreach ($modelConfig->getOptions('local_de_estoque') as $option):
                  ?>
                  <option value="<?= $option['ID'] ?>" <?= ($option['ID'] == $data[local_estoque] ? 'selected' : '') ?>>
                    <?= $option[local] ?>
                  </option>
                  <?
                endforeach;
                ?>
              </select>
            </p>
          </div>

          <div class="col-lg-12 ">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Lote:</label><br>
              <input type="text" name="<?= $this->controller ?>[lote]" class="col-xs-12 col-sm-12 col-lg-12 required"
                value="<?= $data[lote] ?>">
            </p>
          </div>

          <div class="col-lg-12 col-xs-12">
            <p>
              <label class="control-label no-padding-right" for="form-field-1">Observações:</label><br>
              <textarea name="<?= $this->controller ?>[observacoes]" class="col-xs-12 col-sm-12 col-lg-12 "
                style="height:60px"><?= $data[observacoes] ?></textarea>
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
