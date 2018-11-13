<section class="recommended__block recommended__block__detail">
	<div class="container">
		<h2 class="recommended__block-title">
			С этими товаром так же покупают
		</h2>
		<div class="row">
			<div class="recommended__slick"><?php
				for ($arResult['OFFERS'] as $offer)
				{
					$product = $offer['PRODUCT'];
					?><div class="rec__product-col">
						<div class="rec__product-block"><?php
							if ($product['PREVIEW_PICTURE']['SIZES']['mini']['src'])
							{
								?><div class="rec__product-image">
									<a href="<?=$product['DETAIL_PAGE_URL']?>">
										<img src="<?=$product['PREVIEW_PICTURE']['SIZES']['mini']['src']?>" alt="<?=$product['NAME']?>"/>
									</a>
								</div><?php
							}
							?><div class="rec__product__content"><?php
								if ($product['SECTION'])
								{
									?><div class="rec__product-category"><?=$product['SECTION']['NAME']?></div><?php
								}
								?><div class="rec__product-name"><a href="<?=$product['DETAIL_PAGE_URL']?>"><?=$product['NAME']?></a></div>
								<div class="rec__product-price"><?=$offer['PRICE']['FORMAT_PRICE']?></div><div class="svg-rouble svg-rouble-dims product__slider-svg"></div>
								<div class="rec__product-space"><?=$offer["PROPERTIES"]["VALUME"]["VALUE"]?></div>
								<div class="rec__product-addtocart">
									<button
										class="t-button-text t-button-orangegradient rec-button-text"
										onclick="o2.product.addToCart(this,event)"
										data-id="<?=$offer['ID']?>"
										data-price="<?=$offer['PRICE']['INT_PRICE']?>"
									>
										<div class="rec__product-svg"><?php
											include '/html/inc/svg/cart.html';
										?></div>
										<span class="_inCartText">Добавить в корзину</span>
									</button>
								</div>
							</div>
						</div>
					</div><?php
				}
			?></div>
		</div>
	</div>
</section>
