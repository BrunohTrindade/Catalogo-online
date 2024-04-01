  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Produtos</h1>
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
              <h3 class="card-title">Lista de Produtos </h3>
              <div class="card-tools">
                <div class="d-flex">
                  <form action="<?= URL ?>product-list" method="get">
                    <div class="row">
                      <div class="input-group input-group-sm" style="width: 25%; display: inline-block;">
                        <div class="form-group">
                          <select class="custom-select" id="category" name="category_id">
                            <option disabled selected>Categoria</option>
                          </select>
                        </div>
                      </div>
                      <div class="input-group input-group-sm" style="width: 25%; display: inline-block;">
                        <div class="form-group">
                          <select class="custom-select" name="status">
                            <option value="" selected disabled>Ativos</option>
                            <option value="1">Ativos</option>
                            <option value="0">Desativados</option>
                          </select>
                        </div>
                      </div>
                      <div class="input-group input-group-sm" style="width: 25%; display: inline-block;">
                        <div class="form-group" style="display: inline-block;">
                          <select class="custom-select" style="display: inline-block;" name="highlight">
                            <option value="" selected disabled>Destaques</option>
                            <option value="1">Destaque</option>
                            <option value="0">Sem Destaque</option>
                          </select>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-default" style="display: inline-block;"><i class="fas fa-search"></i></button>
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
                    <th>Preço </br><small>sem desconto</small></th>
                    <th>Desconto (%)</th>
                    <th>Categoria</th>
                    <th>Destaque</th>
                    <th>Ativo</th>
                  </tr>
                </thead>
                <tbody>
                
                  <?php foreach ($this->data['products'] as $item) : ?>
                    <tr>
                    
                      <td><?= $item['id_p'] ?></td>
                      <td><a href="<?= URL ?>product-detail/item/<?= $item['id_p'] ?>"><?= $item['product_name'] ?></a></td>
                      <td style="width: 12%"><?= $item['price'] ?></td>
                      <td style="width: 12%"><span class="tag tag-success"><?= $item['discount'] ?></span></td>
                      <td><span class="badge bg-success"><?= $item['category_name'] ?></span></td>
                      <td>

                        <div style="width: 55%">

                          <div class="custom-control custom-switch custom-switch-<?= $item['highlight'] == 1 ? 'on' : 'off' ?>-Secondary custom-switch-<?= $item['highlight'] == 1 ? 'off' : 'on' ?>-success disabled">
                            <input onclick="AltrarStatus('<?= $item['id_p'] ?>','<?= $item['highlight'] ?>')" type="checkbox" class="custom-control-input" id="customSwitch<?= $item['id_p'] ?>">
                            <label class="custom-control-label" for="customSwitch<?= $item['id_p'] ?>">
                            </label>
                          </div>

                        </div>

                      </td>
                      <td>
                        <div class="custom-control custom-switch custom-switch-<?= $item['status'] == 1 ? 'on' : 'off' ?>-Secondary custom-switch-<?= $item['status'] == 1 ? 'off' : 'on' ?>-success">
                          <input onclick="AltrarStatus('<?= $item['id_p'] ?>','<?= $item['status'] ?>')" type="checkbox" class="custom-control-input" id="customSwitch2<?= $item['id_p'] ?>">
                          <label class="custom-control-label" for="customSwitch2<?= $item['id_p'] ?>">
                          </label>
                        </div>
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
  <script src="<?= URL ?>app/adm/Resource/product.js"></script>

  <script>
    loadCategory();
  </script>