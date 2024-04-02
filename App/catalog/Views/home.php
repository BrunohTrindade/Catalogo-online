<section id="home-section" class="hero">
  <div class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(App/Catalog/Views/Templates/images/28154905_7342621.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-12 ftco-animate text-center">
            <h1 class="mb-2">Transforme sua piscina em um oásis de diversão e relaxamento</h1>
            <h2 class="subheading mb-4">com nossa seleção de produtos premium para piscinas.</h2>
          </div>

        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url(App/Catalog/Views/Templates/images/2204_w017_n001_452b_p15_452.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-sm-12 ftco-animate text-center">
            <h1 class="mb-2">Descubra soluções inovadoras e acessórios essenciais</h1>
            <h2 class="subheading mb-4">para manter sua piscina impecável durante todas as estações do ano</h2>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<div id="ajax"></div>
<section class="ftco-section">
  <div class="container">
    <div class="row no-gutters ftco-services">
      <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-shipped"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Entrega Grátis <div id="ajax"></div>
              <div class="col-xs-1-12">

              </div>
            </h3>
            <span>Para Londrina, Cambé e Ibiporã</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-award"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Produtos de Qualidade</h3>
            <span>Garantia em todos os produtos</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-customer-service"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Suporte</h3>
            <span>Suporte antes e pós venda! </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Aproveite nossos descontos</span>
        <h2 class="mb-4">Maiores ofertas!!!</h2>
        <p>Para um desconto melhor em uma quantidade grande de produtos, entre em contato! </p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <?php foreach ($this->data as $value) { ?>
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="product">
            <a href="<?= URL . "product/item/" . $value['p_id'] . "/" . $value['name_link'] ?>" class="img-prod"><img class="img-fluid" src="<?= $value['path'] . "/" . $value['image_name'] ?>" alt="Imagem do produto!">
              <span class="status"><?= $value['discount'] ?>%</span>
              <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
              <h3><a href="<?= URL . "product/item/" . $value['p_id'] . "/" . $value['name_link'] ?>"><?= $value['product_name'] ?></a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price">
                    <span class="mr-2 price-dc">
                      R$
                      <span class="money">
                        <?= $value['price'] ?>
                      </span>
                    </span><br>
                    <span class="price-sale">

                      <strong>R$
                        <span class="money">
                          <?= $value['with_discount'] ?>
                        </span>
                      </strong>
                    </span>
                  </p>
                </div>
              </div>
              <div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                  <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" onclick="addProductCart(<?= $value['p_id'] ?>, <?= $value['with_discount'] ?> ); event.preventDefault();">
                    <span><i class="ion-ios-cart"></i></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/fetch_order.js"></script>