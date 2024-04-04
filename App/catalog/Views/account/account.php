      <?php
      extract($this->data[0]);
      ?>
      <div class="col-lg-8 ftco-animate">
        <div class="row">
          <div class="col-md-10 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch d-md-flex">
              <form method="POST" class="billing-form" id="formAccount">
                <h3 class="mb-4 billing-heading text-center mx-auto">Minha conta <span class=""><?= PROJECT_NAME ?></span></h3>
                <div class="row align-items-end">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Nome e Sobrenome</label>
                      <input type="text" class="form-control required" id="name" name="name" value="<?= isset($name) ? $name : "" ?>">
                      <input type="hidden" name="id" id="id" value="<?= $id ?? $id ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="telefone">Telefone</label>
                      <input type="text" class="form-control required cel" id="cell" name="cell" value="<?= isset($cell) ? $cell : "" ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">email</label>
                      <input disabled type="text" class="form-control required" id="email" name="email" value="<?= isset($email) ? $email : "" ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cpf">CPF</label>
                      <input type="text" onchange="validateCpf(this.value)" class="form-control required cpf" id="cpf" name="cpf" value="<?= isset($cpf) ? $cpf : "" ?>">
                    </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="text-center mx-auto">
                    <button class="btn btn-primary py-3 px-4 cta cta-colored" id="btnUpdate" onclick="update('formAccount', event)">Atualizar</button>
                  </div>
                </div>
              </form><!-- END -->
            </div>
          </div>
        </div>
      </div> <!-- .col-md-8 -->
      </div>
      </div>
      </section> <!-- .section -->
      <script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
      <script src="<?= URL ?>app/Catalog/Resource/js/ajax.js"></script>
      <script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
      <script>
        countProductCart();
      </script>