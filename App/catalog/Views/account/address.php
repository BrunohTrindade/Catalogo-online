<?php 
if(!empty($this->data[0]))
 extract($this->data[0]); 
?>
<div class="col-lg-8 ftco-animate">
  <div class="row">
    <div class="col-md-10 d-flex ftco-animate">
      <div class="blog-entry align-self-stretch d-md-flex">
        <form method="POST" class="billing-form" id="formAddress">
          <h3 class="mb-4 billing-heading text-center mx-auto">Meu Endereço</h3>
          <div class="row align-items-end">
            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="country">Selecione o endereço</label>
                
                <div class="select-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  <select name="select" id="select" class="form-control required" onchange="selectAddress('formAddress'); showButtonAddress()">
                    <option selected value="new">Novo endereço</option>
                    <?php foreach($this->data['ids'] as $key => $value) { ?>
                      <option <?= $this->data[0]['address_id'] == $key ? "selected" : ""?> value="<?= $key ?>"><?= $value." ".$key ?> </option>
                      <?php }  ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Nome do endereço (casa, trabalho ...)</label>
                <input type="text" class="form-control required" name="name" id="name" value="<?= $name ?? "" ?>">
                <input type="hidden" name="id" id="id" value="<?= $_SESSION['id'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">CEP</label>
                <input type="text" class="form-control required" name="cep" id="cep" onchange="pesquisaCep(this.value)" value="<?= $cep ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Rua</label>
                <input type="text" class="form-control required" name="street" id="street" value="<?= $street ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Número</label>
                <input type="text" class="form-control required" name="number" id="number" value="<?= $number ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Bairro</label>
                <input type="text" class="form-control required" name="neighborhood" id="neighborhood" value="<?= $neighborhood ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="towncity">Cidade</label>
                <input type="text" disabled class="form-control required" name="city" id="city" value="<?= $city ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="postcodezip">Estado</label>
                <input type="text" disabled class="form-control required" name="state" id="state" value="<?= $state ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="postcodezip">Complemento</label>
                <input type="text"  class="form-control required" name="complement" id="complement" value="<?= $complement ?? "" ?>">
              </div>
            </div>
            <div class="w-100"></div>
            <div class="text-center mx-auto">
              <button class="btn btn-primary py-3 px-4 cta cta-colored" onclick="createAddress('formAddress')" id="create">Cadastrar</button>
              <button class="btn btn-primary py-3 px-4 cta cta-colored" onclick="updateAddress('formAddress')" id="update">Atualizar</button>
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
<script src="<?= URL ?>app/Catalog/Resource/js/search_cep.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script> 
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Chamar a função showButtonAddress() quando a página é carregada
  showButtonAddress();
});
</script>