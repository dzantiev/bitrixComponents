<section class="recommended__block">
	<div class="container">
		<div class="row">
			<div class="recommended__slick"><?php
				foreach ($arResult['PRODUCTS'] as $product)
				{
					?><div class="rec__product-col">
						<div class="rec__product-block"><?php
							if (!empty($product['PREVIEW_PICTURE']['SIZES']['mini']['src']))
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
								<div class="rec__product-price"><?=$product['PRICE']['FORMAT_PRICE']?></div><div class="svg-rouble svg-rouble-dims product__slider-svg"></div>
								<div class="rec__product-space"><?=$product["PROPERTIES"]["LITERS"]["VALUE"]?></div>
								<div class="rec__product-addtocart">
									<button class="t-button-text t-button-orangegradient">
										<div class="rec__product-svg"><?php
											include $_SERVER["DOCUMENT_ROOT"] . '/html/inc/svg/cart.html';
										?></div>
										Добавить в корзину
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