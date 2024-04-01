      <div class="col-lg-8 ftco-animate">
        <div class="row">
          <div class="col-md-10 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch d-md-flex">
              <form class="billing-form" id="formPass">
                <h3 class="mb-4 billing-heading text-center mx-auto">Minha conta <span class="">EP PISCINAS </span></h3>
                <div class="row align-items-end">

                  <div id="verifyPass" class="col-md-12">
                    <div class="form-group">
                      <label for="password">Para trocar a senha, informe a senha atual:</label>
                      <input type="hidden" id="email_" value="<?= $_SESSION['email'] ?>">
                      <input type="password" class="form-control required" id="password">
                    </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="text-center mx-auto">
                    <button id="verify" class="btn btn-primary py-3 px-4 cta cta-colored" onclick="verifyPass('formPass', event)">Verificar senha</button>
                  </div>
                </div>
              </form><!-- END -->
              <form class="billing-form d-none" id="formChangePass">

                <div class="row align-items-end">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="password">Nova senha:</label>
                      <input type="password" class="form-control required" id="pass" name="pass">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="password">Confirmar senha</label>
                      <input type="password" class="form-control required" id="confirmPass" name="confirmPass">
                    </div>
                  </div>

                  <div class="w-100"></div>
                  <div class="text-center mx-auto">
                    <button type="button" class="btn btn-primary py-3 px-4 cta cta-colored" onclick="changePass('<?= $_SESSION['id'] ?>', '<?= $_SESSION['email'] ?>', false, event, 'formChangePass')">Atualizar</button>
                  </div>
              </form>
            </div>
          </div>
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