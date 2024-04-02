<footer class="ftco-footer ftco-section bg-light">
  <div class="container">
    <div class="row">
      <div class="mouse">
        <a href="#" class="mouse-icon">
          <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
        </a>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2"><?= PROJECT_NAME ?></h2>
          <p> Produtos para piscinas. Mantenha sua piscina sempre limpa com nossos produtos e utensilios.</p>
        </div>
      </div>

      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Tem alguma duvida?</h2>
          <div class="block-23 mb-3">
            <ul>
              <li><span class="icon icon-map-marker"></span><span class="text"><?= ADDRESS ?></span></li>
              <li><a href="https://wa.me/55<?= DDD_TEL . TELL_1 ?>?text=Olá,+vim+através+do+site+..."><span class="icon icon-phone"></span><span class="text">
              <?= NAME_TELL_1 ?> (<?= DDD_TEL ?>) <?= TELL_1 ?> | <?= NAME_TELL_2 ?> (<?= DDD_TEL ?>) <?= TELL_2 ?> </span></a></li>
              <li><a href="#"><span class="icon icon-envelope"></span><span class="text">eppiscinas@hotmail.com</span></a></li>
              <li><span class="icon icon-circle"></span><span class="text">CNPJ <?= CNPJ ?></span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">

        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Desenvolvido por <a href="https://instagram.com/brunoh_trindade" target="_blank">Bruno Trindade</a> | Template Colorlib</a>
          
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- loader
<div id="ftco-loader" class="show fullscreen">
  <svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
  </svg>
</div> -->


<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/popper.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/bootstrap.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery.easing.1.3.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery.waypoints.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery.stellar.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/owl.carousel.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery.magnific-popup.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/aos.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/jquery.animateNumber.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/bootstrap-datepicker.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/scrollax.min.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/main.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/mask/mask.js"></script>
<script src="<?= URL ?>app/Catalog/Views/Templates/js/mask/jquery.mask.min.js"></script>
</body>

</html>
<?php 
unset($_SESSION['msg']); ?>
