<div class="catalog__right-title">
	<?=$arResult['NAME']?>
</div>
<div class="catalog__right-text"><?php
	if ($arResult['UF_PREVIEW_TEXT'])
	{
		$arResult['UF_PREVIEW_TEXT'];
	}
	else
	{
		?>СОЖ — это многокомпонентные составы, главным назначением которых является охлаждение и смазка инструментов и обрабатываемых деталей из черных и цветных металлов и сплавов. Они уменьшают трение и защищают инструменты и заготовку от перегрева и коррозии, эффективно удаляют абразивную пыль и мелкую стружку из рабочей зоны, предотвращают быстрый износ основных элементов оборудования.<?php
	}
?></div>
<div class="catalog__right-configure">
	<div class="config__block clearfix">
		<div class="config__left">
			<div class="config__svg">
				<div class="svg-cells svg-cells-dims"></div>
			</div>
		</div>
		<div class="config__right">
			<a href="/configurator/">
				<div class="config__h1">Не знаете какой продукт выбрать? Попробуйте наш персональный конфигуратор</div>
			</a>
		</div>
	</div>
</div>