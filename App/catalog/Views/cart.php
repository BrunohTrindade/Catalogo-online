<?php
// var_dump($this->data);
?>
<input type="hidden" value="<?= $_SESSION['id'] ?>" id="user_id">
<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>Item</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="cart-body">
              <!-- Os itens serão adicionados aqui via JavaScript -->
            </tbody>
          </table>
        </div>

      </div>
      <div class="col-lg-4 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Meu Carrinho de Compras EP</h3>
          <p class="d-flex">
            <span>Subtotal</span>
            <span id="subtotal-price-cart">R$ 0,00</span>
          </p>
          <p class="d-flex">
            <span>Frete</span>
            <span id="delivery">R$ 0,00</span>
          </p>
          <p class="d-flex">
            <span>Desconto</span>
            <span>R$ 0,00</span>
          </p>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span id="total">R$ 0,00/span>
          </p>
        </div>
        <p><a class="btn btn-primary py-3 px-4" id="btnWA" target="_blank">Continuar para Pagamento</a></p>
      </div>
    </div>
  </div>
</section>
<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/fetch_order.js"></script>
<script>
  cart();
</script>