<?php
// var_dump($this->data);
?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Categorias</h1>
      </div>
      <div class="col-sm-6">
       
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- /.row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Categorias</h3>
            <div class="card-tools">
              <div class="d-flex">
                <form action="<?= URL ?>category-list" method="get">
                  <div class="row">
                    <div class="col">
                      <div class="input-group input-group-sm">
                        <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="status" name="status" value="0" <?= isset($_GET['status']) && $_GET['status'] == 0 ? "checked" : "" ?>>
                            <label for="status" class="custom-control-label">Selecionar Inativos</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($this->data['category'] as $item) : ?>
                  <tr>

                    <td><?= $item['id'] ?></td>
                    <td><a href="<?= URL ?>category-detail/item/<?= $item['id'] ?>"><?= $item['name'] ?></a></td>
                    <td>
                      <?php if ($item['status'] == 1) { ?>
                        <p class="text-success"><strong>ATIVO</strong></p>
                      <?php } else { ?>
                        <p class="text-muted"><strong>INATIVO</strong></p>
                      <?php } ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <?= $this->data['pagination'] ?>
            </ul>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<script src="<?= URL ?>app/adm/Resource/category.js"></script>

<script>
  loadCategory();
</script>