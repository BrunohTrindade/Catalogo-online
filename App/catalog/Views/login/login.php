<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 mb-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3 ">
          <div class="text-center">
            <h3>L O G I N </h3>
        
            <p>Entre com seu e-mail e senha</p>
          </div>
          <form method="POST" action="" class="billing-form" id="formLogin">
            <div class="form-group">
              <label for="">E-mail</label>
              <input type="text" class="form-control text-left px-3 required" name="nome" id="nome" value="<?= isset($this->data['nome'])? $this->data['nome'] : ""?>">
            </div>
            <div class="form-group">
              <label for="">Senha</label>
              <input type="password" class="form-control text-left px-3 required" name="password" id="password">
            </div>
            <div class="text-center">
              <p><button type="submit"  onclick="validateForm('formLogin')" class="btn btn-primary py-3 px-4 cta cta-colored" name="login" value="enviar">Entrar</button></p>
              <p><a href="<?= URL ?>register">Cadastre-se</a> | <a href="<?= URL ?>recoverypassword">Equeceu a senha?</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
<script>
<?php if(isset($this->data['nome'])){ ?>
showMessage(ERROR, MSG_PASS_EMAIL_WRONG);
<?php } ?>
</script>
