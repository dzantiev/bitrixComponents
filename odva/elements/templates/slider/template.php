<section class="help-section">
	<div class="container">
		<div class="row">
			<h2 class="help__h1">Полезная информация</h2>
			<div class="help__block clearfix"><?php
				foreach($arResult as $slide)
				{
					?><div class="help__item">
						<div class="help__item-picture">
							<a href="<?=$slide['DETAIL_PAGE_URL']?>"><img src="<?=$slide['PREVIEW_PICTURE']?>" alt="<?=$slide['NAME']?>"></a>
						</div>
						<div class="help__item-textarea"><?php
							if (!empty($slide['SECTION']))
							{
								?><div class="help__item-pretitle">
									<?=$slide['SECTION']['NAME']?>
								</div><?php
							}
							?><div class="help__item-title">
								<a href="<?=$slide['DETAIL_PAGE_URL']?>"><?=$slide['NAME']?></a>
							</div>
							<div class="help__item-text">
								<a href="<?=$slide['DETAIL_PAGE_URL']?>"><?=$slide['PREVIEW_TEXT']?></a>
							</div>
						</div>
					</div><?php
				}
			?></div>
		</div>
	</div>
</section>