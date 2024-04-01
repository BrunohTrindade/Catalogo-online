<section class="ftco-section ftco-degree-bg ">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 sidebar ftco-animate d-none d-md-block">
        <div class="sidebar-box ftco-animate">
          <h3 class="heading">Menu</h3>
          <div class="tagcloud">
            <!-- <a href="#" class="tag-cloud-link">Minhas Compras</a><br> -->
            <a href="<?= URL . "Account/account" ?>" class="tag-cloud-link">Meus Dados</a><br>
            <a href="<?= URL . "Account/address" ?>" class="tag-cloud-link">Meus Endereços</a><br>
            <a href="<?= URL . "Account/cards" ?>" class="tag-cloud-link">Formas de pagamentos</a><br>
            <a href="<?= URL . "Account/password" ?>" class="tag-cloud-link">Trocar Senha</a>
          </div>
        </div>
      </div>
      <div class="container mt-5 text-center d-block d-md-none ftco-section">
        <div class="dropdown mx-auto">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            M I N H A  C O N T A 
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <!-- <a class="dropdown-item" href="#">Minhas Compras</a> -->
            <a class="dropdown-item" href="<?= URL . "Account/account" ?>">Meus Dados</a>
            <a class="dropdown-item" href="<?= URL . "Account/address" ?>">Meus Endereços</a>
            <a class="dropdown-item" href="<?= URL . "Account/cards" ?>">Formas de pagamentos</a>
            <a class="dropdown-item" href="<?= URL . "Account/password" ?>">Trocar senha</a>
          </div>
        </div>
      </div>