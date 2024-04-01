<?php
 !empty($this->data) ? extract($this->data['form']) : "";
?>
<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-7 ftco-animate">
        <form action="<?= URL ?>register" class="billing-form" method="POST" id="formRegister" onsubmit="return validateFormUser(event)">
          <h3 class="mb-4 billing-heading text-center mx-auto">Minha conta <span class="">EP PISCINAS </span></h3>
          <span id="flash_msg"></span>

          <div class="row align-items-end">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Nome e Sobrenome</label>
                <input type="text" class="form-control required" id="name" name="name" value="<?= $name ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Telefone</label>
                <input type="text" class="form-control cel required" id="cell" name="cell" value="<?= $cell ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control required" id="email" name="email" value="<?= $email ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Confirmar E-mail</label>
                <input type="email" class="form-control required" id="confirmEmail" name="confirmEmail" value="<?= $email ?? "" ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control required" id="pass" name="pass">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Confirmar senha</label>
                <input type="password" class="form-control required" id="confirmPass" name="confirmPass">
              </div>
            </div>
            <div class="w-100"></div>
            <div class="text-center mx-auto">
              <button type="submit" class="btn btn-primary py-3 px-4 cta cta-colored" value="Cadastrar" name="register" onclick="validateForm('formRegister'); validatePassEmail(event)">
                Cadastrar
              </button>
            </div>
          </div>
        </form>
        <!-- END -->
      </div>
    </div>
  </div>
</section>
<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>