# Компонент оформления заказа

- пример подключения
```php
//подключения компонента
   $APPLICATION->IncludeComponent(
		'odva:order.make',
		'',
		[
			'filter' =>
			[
					'IBLOCK_ID' => 2//id инфоблока в котором хранятся товары
			]
		]
	);
```
- примерные шаблоны
	'' - актуальный шаблон