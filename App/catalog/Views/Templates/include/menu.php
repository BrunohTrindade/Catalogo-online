<?php
// var_dump($this->dataMenu) 
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="<?= URL ?>"><?= PROJECT_NAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>


    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="<?= URL ?>" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="<?= URL ?>shop" class="nav-link">Shop</a></li>
        <?php if ($_SESSION['type'] ?? null === USER_COMMON) { ?>
          <li class="nav-item cta">
            <a href="<?= URL ?>cart" class="nav-link">
              <span class="icon-shopping_cart"></span>
              <span id="totalItemsCart">
                [<?= $this->dataMenu['numberItemsCart'][0]['total'] ?? "0" ?>]
              </span>
            </a>
          </li>
        <?php } ?>
        <?php
        // var_dump($_SESSION['type']);
        if (!isset($_SESSION['type'])) { ?>
          <li class="nav-item">
            <a href="<?= URL ?>login" class="nav-link"><span class="ion-ios-person"></span>Login</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a href="<?= $_SESSION['type'] == USER_COMMON ? URL . "account" : URL . "product-list"  ?>" class="nav-link"><span class="ion-ios-person"></span>Minha conta (<?= $_SESSION['name'] ?>)</a>
          </li>
          <li class="nav-item">
            <a href="<?= URL ?>logout" class="nav-link"><span class="ion-ios-close"></span> Sair</a>
          </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</nav>
<div class="container mt-3">
  <div class="row justify-content-center">
    <!-- Botão Dropdown -->
    <div class="col-md-6 d-flex align-items-center">
      <div class="btn-group subscribe-form">
        <div class="form-group">
          <div class="dropdown">
            <button class="sidebar-box btn btn-primary btn-category submit px-3 dropbtn">C A T E G O R I A S</button>
            <div class="dropdown-content">
              <?php
              for ($i = 0; $i < count($this->dataMenu['category']); $i++) {
              ?>
                <a href="<?= URL . "shop/index/" . $this->dataMenu['category'][$i]['id_c'] . "/" . $this->dataMenu['category'][$i]['name_link'] ?>"><?= $this->dataMenu['category'][$i]['name'] ?></a>
              <?php } ?>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Campo de entrada e botão -->
    <div class="col-md-6 align-items-center">
      <div class="input-group">
        <form action="<?= URL ?>shop/search/" class="subscribe-form" method="GET">
          <div class="form-group d-flex">
            <input type="text" class="form-control" name="name" placeholder="O que precisa está aqui! ...">
            <input type="submit" value="Buscar" class="submit px-3">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>