<?php
extract($this->data['product'][0]);
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?= URL ?>App/Catalog/Views/Templates/images/28154905_7342621.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated">
				<p class="breadcrumbs"><span class="mr-2"><a href="<?= URL ?>home">Inicio</a></span> <span class="mr-2"><a href="<?= URL ?>shop">Shop</a></span></p>
				<h1 class="mb-0 bread"><?= $category_name ?></h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">

				<div class="gallery">
					<?php
					if (isset($this->data['product'][0]['images'])) {
						for ($i = 0; $i < count($this->data['product'][0]['images']['path']); $i++) { ?>

							<input type="radio" checked="checked" name="select" id="img-tab-<?= $i ?>">
							<label for="img-tab-<?= $i ?>" style="background-image: url(<?= URL . $this->data['product'][0]['images']['path'][$i] . "/" . $this->data['product'][0]['images']['img_name'][$i]  ?>);"></label>
							<img src="<?= URL . $this->data['product'][0]['images']['path'][$i]  . "/" .  $this->data['product'][0]['images']['img_name'][$i]  ?>" border="0" class="img-fluid">
						<?php }
					} else { ?>
						<!-- <label for="img-tab-<?= $i++ ?>" style="background-image: url(<?= $product ?>);"></label> -->
					<?php } ?>
				</div>

			</div>

			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3><?= $product_name ?></h3>

				<?php if (!empty($discount)) { ?>
					R$ <span class="mr-2 price-dc money"> <?= $price ?></span></p>
					<p class="price price-dc">
						<span class="mr-2 price-dc">
							R$
							<span class="money"><?= $with_discount ?>
							</span>
					</p>
				<?php } else { ?>
					<p class="price price-dc">
						<span class="mr-2 price-dc">
							R$
							<span class="money"><?= $price ?>
							</span>
					</p>
				<?php } ?>
				<p>
					<?= $description ?>
				</p>
				<div class="row mt-4">
					<div class="col-md-6">
					</div>
					<div class="w-100"></div>
					<div class="input-group col-md-6 d-flex mb-3">
						<span class="input-group-btn mr-2">
							<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
								<i class="ion-ios-remove"></i>
							</button>
						</span>
						<input type="text" id="qty" name="qty" class="form-control input-number" value="1" min="1" max="100">
						<input type="hidden" id="price" value="<?= !empty($discount) ? $with_discount : $price ?>">
						<input type="hidden" id="product_id" value="<?= $id_p ?>">
						<span class="input-group-btn ml-2">
							<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
								<i class="ion-ios-add"></i>
							</button>
						</span>
					</div>
					<div class="w-100"></div>
					<div class="col-md-12">
						<p style="color: #000;"><?= $quantity ?> UN disponiveis</p>
					</div>
				</div>
				<p>
					<a href="#" id="btn_cart" class="add-to-cart btn btn-primary py-3 px-5" onclick="addProductCart(); event.preventDefault();">
						Adicionar ao Carrinho
						<span id="icon_btn" class="ion-ios-cart"></span>
					</a>
				</p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Procurando por outro modelo de</span>
				<h2 class="mb-4"><?= $category_name . "?" ?></h2>
				<p>Se ainda não encontrou, entre em contato que coseguiremos o modelo que procura!</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php
			foreach ($this->data['related'] as $product) { ?>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="<?= URL . "product/item/" . $product['id_p'] . "/" . $product['name_link'] ?>" class="img-prod">
							<img class="img-fluid" src="<?= URL . $product['path'] . "/" .  $product['img_name'] ?>" alt="">
							<?php if (!empty($product['discount'])) { ?>
								<span class="status "><?= $product['discount'] ?>%</span>
							<?php } ?>
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="<?= URL . "product/item/" . $product['id_p'] . "/" . $product['name_link'] ?>"><?= $product['product_name'] ?></a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price">
										<?php if (isset($product['with_discount'])) { ?>
											<span class="mr-2 price-dc">
												R$ <?= $product['price']  ?>
											</span><br>
											<span class="price-sale">
												<strong>
													R$ <?= $product['with_discount'] ?>
												</strong>
											</span>
										<?php } else { ?>
											<span class="price-sale">
												<strong>R$
													<span class="money">
														<?= $product['price'] ?>
													</span>
												</strong>
											</span>
										<?php } ?>
									</p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" onclick="addProductCart( <?= $product['id_p'] ?>, <?= $product['with_discount'] ?? $product['price'] ?>); event.preventDefault();">
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

<section class="ftco-animate">
	<div class="container-fluid"> <!-- Substituí "container" por "container-fluid" -->
		<div class="row">
			<div class="col-lg-8 ftco-animate mx-auto">
				<div class="pt-5 mt-5">
					<h3 class="mb-5">
						<span id="n_comments">
							<?= $this->data['comment'][0]['total_comment'] ?? "0" ?>
						</span>
						Comentário(s)
					</h3>
					<ul class="comment-list">
						<?php
						foreach ($this->data['comment'] as $comment) {
						?>
							<li class="comment">
								<div class="vcard bio">
									<img src="images/person_1.jpg" alt="Image placeholder">
								</div>
								<div class="comment-body">
									<h3 id="name"><?= $comment['name'] ?></h3>
									<div class="meta" id="date"><?= $comment['created'] ?></div>
									<p id="commentList"><?= $comment['comment'] ?></p>
								</div>
							</li>
						<?php }
						?>
					</ul>
					<div class="comment-form-wrap pt-5">
						<form class="p-5 bg-light" id="commentForm">

							<div class="rating d-flex">
								<p class="text-left mr-4">
									<a href="#" id="rating"> <?= $this->data['average'][0]['average_stars'] ?? "0.0" ?></a>
									<a class="star-link" href="#" data-value="1"><span class="ion-ios-star-outline"></span></a>
									<a class="star-link" href="#" data-value="2"><span class="ion-ios-star-outline"></span></a>
									<a class="star-link" href="#" data-value="3"><span class="ion-ios-star-outline"></span></a>
									<a class="star-link" href="#" data-value="4"><span class="ion-ios-star-outline"></span></a>
									<a class="star-link" href="#" data-value="5"><span class="ion-ios-star-outline"></span></a>
								</p>
								<p class="text-left mr-4">
									<!-- <a href="#" class="mr-2" style="color: #000;"><?= $this->data['comment'][0]['total_comment'] ?? "0" ?> <span style="color: #bbb;">Avaliações</span></a> -->
								</p>
							</div>
							<?php if (isset($_SESSION['type'])) : ?>
								<div class="form-group">
									<label for="comment">Deixe seu comentário! </label>
									<input type="hidden" value="<?= $this->data['product'][0]['id_p'] ?>" id="product_id">
									<textarea name="comment" id="comment" cols="30" rows="3" class="form-control required"></textarea>
								</div>
								<div class="form-group">
									<input type="button" value="Comentar" onclick="addComment('commentForm')" class="btn py-3 px-4 btn-primary">
								</div>
							<?php else : ?>
								<div class="form-group">
									<label for="comment">Para comentar, realize o </label>
									<a href="<?= URL ?>login" class="mr-2" style="color: #000;">Login</a>
								</div>
							<?php endif; ?>
						</form>
					</div>
					<!-- END leave comment -->

				</div>
			</div>
		</div>
	</div>
</section><br>
<script src="<?= URL ?>app/Catalog/Resource/js/functions.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/ajax.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/fetch_order.js"></script>
<script src="<?= URL ?>app/Catalog/Resource/js/messages.js"></script>
<script>
	fillStars(<?= $this->data['average'][0]['average_stars'] ?>);

	selectComments();

	document.addEventListener('DOMContentLoaded', function() {
		const quantityInput = document.getElementById('qty');

		document.querySelectorAll('.quantity-right-plus').forEach(function(button) {
			button.addEventListener('click', function(e) {
				e.preventDefault();
				let quantity = parseInt(quantityInput.value);
				quantity = isNaN(quantity) ? 0 : quantity;
				quantityInput.value = quantity + 1;
			});
		});

		document.querySelectorAll('.quantity-left-minus').forEach(function(button) {
			button.addEventListener('click', function(e) {
				e.preventDefault();
				let quantity = parseInt(quantityInput.value);
				quantity = isNaN(quantity) ? 0 : quantity;
				if (quantity > 0) {
					quantityInput.value = quantity - 1;
				}
			});
		});
	});
</script>