      <?php //extract($this->data[0]);  ?>
      <div class="col-lg-8 ftco-animate">
        <div class="row">
          <div class="col-md-10 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch d-md-flex">
              <form method="POST" class="billing-form" id="formAccount">
                <h3 class="mb-4 billing-heading text-center mx-auto">Meus cartões (em breve)</h3>
                <div class="row align-items-end">
                  <div class="col-md-12">
                  <select disabled name="select" id="select" class="form-control required" onchange="selectAddress('formAddress')">
                    <option selected value="new">Adicionar Novo Cartão</option>
                    <?php foreach($this->data['ids'] as $key => $value) { ?>
                      <option <?= $this->data[0]['address_id'] == $key ? "selected" : ""?> value="<?= $key ?>"><?= $value." ".$key ?> </option>
                      <?php }  ?>
                  </select>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Numero do cartão </label>
                      <input disabled type="number" class="form-control required numbercard" id="card_number" name="card_number" value="<?= $name ??  "" ?>">
                      <input type="hidden" name="id" id="id" value="<?= $id ?? "" ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="telefone">Validade <small>(mês/ano ex: 01/24)</small></label>
                      <input disabled type="text" class="form-control required datecard" id="validate" name="validate" value="<?= $validate ?? "" ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">CVV</label>
                      <input disabled type="text" class="form-control required" id="cvv" name="cvv" value="<?= $cvv ?? "" ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cpf">Nome que está no cartão</label>
                      <input disabled type="text" class="form-control required" id="card_name" name="card_name" value="<?= $card_name ?? "" ?>">
                    </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="text-center mx-auto">
                    <button class="btn btn-primary py-3 px-4 cta cta-colored" id="btnUpdate">Cadastrar</button>
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