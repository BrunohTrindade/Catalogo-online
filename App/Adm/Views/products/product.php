<?php
isset($this->data[0]) ? extract($this->data[0]) : "";
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>
          <?php if (isset($this->data[0])) { ?>
            <?= $product_name ?>
          <?php } else { ?>
            Novo Produto
          <?php } ?>
        </h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Informações do item</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <input type="hidden" id="id" value="<?= $id_p ?? "" ?>">
        <form role="form" id="updateProduct">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">

                <!-- select -->
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="custom-select required" id="category">
                    <option value="<?= $category_id ?? "" ?>" selected><?= $category_name ?? "" ?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nome do item</label>
              <input type="text" class="form-control required" id="name" value="<?= $product_name ?? "" ?>">
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Preço</label>
                  <input type="text" class="form-control required" id="price" value="<?= $price ?? "" ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Desconto (em %)</label>
                  <input type="number" class="form-control " id="discount" value="<?= $discount ?? "" ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Unidade de medida</label>
                  <select class="custom-select required" id="measure">
                    <option value="<?= $measure ?? "" ?>" selected><?= $measure ?? "" ?></option>
                    <option value="Unidade">/ unidade</option>
                    <option value="ml">/ ml</option>
                    <option value="kg">/ kg</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group ">
                  <label>Quantidade em estoque</label>
                  <input type="text" class="form-control required" id="quantity" value="<?= $quantity ?? "" ?>">
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label>Modo de uso</label>
                <textarea class="form-control required" id="use_mode" rows="5"> <?= $use_mode ?? "" ?></textarea>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Descrição</label>
                <textarea class="form-control required" id="description" rows="5"><?= $description ?? "" ?></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="status" value="1" <?= isset($status) && $status == 0 ? "checked" : "" ?>>
                    <label for="status" class="custom-control-label">Ocultar produto</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="highlight" value="1" <?= isset($highlight) && $highlight == 1 ? "checked" : "" ?>>
                    <label for="highlight" class="custom-control-label">Manter na página principal como destaque</label>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <!-- /.card-body -->

        </form>
        <div class="card-footer">
          <button class="btn btn-primary" onclick="<?= isset($id_p) ? 'updateProduct' : 'createProduct' ?>('updateProduct')">Salvar</button>
        </div>
      </div>
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
      <!-- general form elements disabled -->
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Dimensões do produto</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" id="updateProductDelivery">
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Formato</label>
                  <input type="number" id="format" class="form-control" value="<?= $format ?? "" ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Largura</label>
                  <input type="number" id="width" class="form-control" value="<?= $width ?? "" ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Altura</label>
                  <input type="number" id="height" class="form-control" value="<?= $height ?? "" ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Comprimento</label>
                  <input type="number" id="length" class="form-control" value="<?= $length ?? "" ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Diamentro</label>
                  <input type="number" id="diameter" class="form-control" value="<?= $diameter ?? "" ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Peso</label>
                  <input type="number" id="weight" class="form-control" value="<?= $weight ?? "" ?>">
                </div>
              </div>
            </div>
          </form>
          <div class="card-footer">
            <button type="buttton" class="btn btn-primary" onclick="updateProduct('updateProductDelivery')">Salvar</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- /.card -->
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Imagens</h3>
        </div>
        <div class="col-12">

          <div class="card-body">
            <div class="row">
              <form method="post">
                <div class="row" id="imgList">
                  <?php if (isset($id_p)) :
                    foreach ($this->data[0]['img'] as $img) : ?>
                      <div class="col-sm-2" >
                        <div class="card">
                          <input type="checkbox" name="selected_images[]" value="<?= $img ?>" class="image-checkbox">
                          <img src="<?= URL . $this->data[0]['path'] . "/" . $img ?>" class="card-img-top" alt="white sample">
                        </div>
                      </div>
                  <?php endforeach;
                  endif; ?>
                </div>
              </form>
              <button class="btn btn-danger" onclick="confirmDeleteImg()">Excluir Imagens Selecionadas</button>

            </div>
          </div>

        </div>
      </div>
      <!-- general form elements disabled -->

      <!-- /.card -->
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Adicionar novas imagens</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="preview"></div>
          <div class="form-group">
            <div class="custom-file">
              <div id="preview"></div>
              <input type="file" name="file" class="custom-file-input" id="fileInput" accept="image/*" multiple
              enctype="multipart/form-data">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
          </form>
          <button class="btn btn-danger" onclick="uploadImages()">Salvar Imagens Selecionadas</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- general form elements disabled -->

      <!-- /.card -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</div>

<script src="<?= URL ?>app/adm/Resource/const.js"></script>
<script src="<?= URL ?>app/adm/Resource/messages.js"></script>
<script src="<?= URL ?>app/adm/Resource/product.js"></script>
<script src="<?= URL ?>app/adm/Resource/function.js"></script>

<script>
  loadCategory();
</script>