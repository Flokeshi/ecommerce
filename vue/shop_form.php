<?php foreach ($products as $product) { ?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
	<div class="cadre rounded bg-white p-3">
		<div>
			<img src="<?php echo $product['picture_url']; ?>">
		</div>
		<div>
			<h4><?php echo $product['product_name']; ?></h4>
			<p style="height: 170px;"><?php echo $product['product_description']; ?></p>
			<br>
			<h5><?php echo $product['product_price']; ?> €</h5>
			<div class="cart-product-quantity row text-center">
                <div class="quantity col-9 m-auto">
                    <button type="button" class="shopAdd btn btn-light" value="-1" id="btn-minus-<?= $product['product_id']?>"><i class="fas fa-minus"></i></button>
                    <input type="text" class="qty" value="<?= ($product['cart_quantity']?$product['cart_quantity']:1)?>" id="input-<?= $product['product_id']?>" style="width: 50px; text-align: center;">
                    <input type="hidden" class="stock" value="<?= $product['product_stock']?>" id="stock-<?= $product['product_id']?>" style="width: 50px; text-align: center;">
                    <button type="button" class="shopAdd btn btn-light" value="+1" id="btn-plus-<?= $product['product_id']?>"><i class="fas fa-plus"></i></button>
                    <button class="input-group-text black lighten-2 cart m-3 shopSubmit" id="btn-submit-<?= $product['product_id']?>" type="submit"><i class="fas fa-shopping-cart"><br></i></button>
                </div>
            </div>
		</div>
	</div>
</div>
<?php } ?>