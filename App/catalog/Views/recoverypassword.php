<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 mb-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3 ">
          <div class="text-center">
            <h3>Recuperar Senha</h3>
        
            <p>Para recuperar sua senha, digite o email cadastrado</p>
          </div>
          <form method="POST" action="" class="billing-form" id="formRecovery">
            <div class="form-group">
              <label for="">E-mail</label>
              <input type="text" class="form-control text-left px-3 required" id="email">
            </div>
            <div class="text-center">
              <p><button type="button"  onclick="recoveryPass('formRecovery')" class="btn btn-primary py-3 px-4 cta cta-colored">Recuperar</button></p>
              <p><a href="<?= URL ?>login">Login</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/ajax.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
