<?php
isset($this->data[0]) ? extract($this->data[0]) : "";
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>
          <?php if (isset($this->data[0])) { ?>
            Categoria: <?= $name ?>
          <?php } else { ?>
            Nova Categoria
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
          <h3 class="card-title">Informações da categoria</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <input type="hidden" id="id" value="<?= $id ?? "" ?>">
        <form role="form" id="createCategory">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nome da categoria</label>
              <input type="text" class="form-control required" id="name" value="<?= $name ?? "" ?>">
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

                  <div class="col-sm-12">
                    <!-- radio -->
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="radio1" name="radio" <?= isset($status) && $status == 1 ? "checked" : ""?> value="1">
                        <label class="form-check-label">Ativar categoria</label>
                      </div>
                      <div class="form-check">
                        <input  class="form-check-input" type="radio" id="radio1" name="radio" <?= isset($status) && $status == 0 ? "checked" : ""?> value="0">
                        <label class="form-check-label">Desativar categoria</label>
                      </div>

                    </div>
                  </div>



                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </form>
        <div class="card-footer">
          <button class="btn btn-primary" onclick="<?= isset($id) ? 'updateCategory' : 'createCategory' ?>('createCategory')">Salvar</button>
        </div>
      </div>
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</div>

<script src="<?= URL ?>app/adm/Resource/const.js"></script>
<script src="<?= URL ?>app/adm/Resource/messages.js"></script>
<script src="<?= URL ?>app/adm/Resource/category.js"></script>
<script src="<?= URL ?>app/adm/Resource/function.js"></script>

<script>
  loadCategory();
</script>