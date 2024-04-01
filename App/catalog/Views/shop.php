<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-3 ftco-animate d-none d-md-block">
        <h3 class="mb-4 billing-heading">Categorias</h3>
        <div class="cart-detail cart-total p-3 p-md-4 ">
          <?php foreach ($this->data['category'] as $category) { ?>
            <p class="d-flex">
              <span><a href="<?= URL . "shop/index/" . $category['id'] . "/" . $this->util->slugUrlName($category['category_name']) ?>"><?= $category['category_name'] ?></a></span>
            </p>
          <?php } ?>
        </div>
      </div> <!-- .col-md-8 -->
      <div class="col-xl-9 ftco-animate">
        <h3 class="mb-4 billing-heading">
          <?php
          if (isset($this->data['products'][0]['category_name'])) { ?>
            <?php echo $this->data['products'][0]['category_name']; ?>
          <?php } elseif (empty($this->data['products'][0])) { 
           $this->data['search'] ?? '"';
           } elseif (isset($this->data['search'])) {
            echo 'Procurando por: "' . $this->data['search'] . '"';
          ?>

          <?php } else { ?>
            EP Produtos para Piscinas!
          <?php } ?>
        </h3>
        <div class="row align-items-end">
          <div class="row">
            <?php foreach ($this->data['products'] as $item) : ?>
              <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                  <a href="<?= URL . "product/item/" . $item['p_id'] . "/" . $item['name_link']; ?>" class="img-prod">
                    <img class="img-fluid" src="<?= URL . $item['path'] . "/" . $item['img_name'] ?>" alt="<?= $item['img_name'] ?>">
                    <?php if (isset($item['with_discount'])) { ?>
                      <span class="status"><?= $item['discount'] ?>% </span>
                    <?php } ?>
                    <div class="overlay"></div>
                  </a>
                  <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="<?= URL . "product/item/" . $item['p_id'] . "/" . $item['name_link'];; ?>"><?= $item['name'] ?></a></h3>
                    <div class="d-flex">
                      <div class="pricing">
                        <p class="price">
                          <?php if (isset($item['discount'])) { ?>
                            <span class="mr-2 price-dc">
                              R$ <?= $item['price'] ?>
                            </span><br>
                            <span class="price-sale">
                              <strong>R$ <?= $item['with_discount'] ?></strong>
                            </span>
                          <?php } else { ?>
                            <span class="price-sale">
                              <strong>R$ <?= $item['price'] ?></strong>
                            </span>
                          <?php } ?>
                        </p>
                      </div>
                    </div>
                    <div class="bottom-area d-flex px-3">
                      <div class="m-auto d-flex">
                        <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" onclick="addProductCart( <?= $item['p_id'] ?>, <?= $item['with_discount'] ?? $item['price']?>); event.preventDefault();">
                          <span><i class="ion-ios-cart"></i></span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach ?>

          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="row mt-5">
    <div class="col text-center">
      <div class="block-27">
       <?= $this->data['paginate'] ?>
      </div>
    </div>
  </div>
</section> <!-- .section -->

<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/fetch_order.js"></script>