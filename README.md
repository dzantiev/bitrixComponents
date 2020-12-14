# Список элементов

Компонент работает на основе метода [CIBlockElement::GetList](https://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getlist.php).


## Принимаемые параметры

Можно передать некоторые стандартные параметры ```CIBlockElement::GetList```:

- ***sort***   - параметр **arOrder** для метода ```CIBlockElement::GetList```
- ***filter*** - параметр **arFilter** для метода ```CIBlockElement::GetList```

Так же можно передать параметры:

- ***props***          - массив символьных кодов свойств, которые надо достать для элементов.
- ***page***           - текущая страница пагинации [Подробнее](#настройка-пагинации)
- ***count***          - количество элементов на странице [Подробнее](#настройка-пагинации)
- ***pagn_id***        - название шаблона для пагинации (для компонента bitrix:main.pagenavigation). [Подробнее](#настройка-пагинации)
- ***show_all***       - если true, подгрузятся все элементы (если нет других параметров, см. [настройки пагинации](#настройка-пагинации))
- ***load_section***   - если true, то для элементов будет подгружаться информация о родительской секции элемента (в том числе пользовательские поля)
- ***images***         - массив [настроек для обработки изображений](#настройка-обработки-изображений).
- ***price_ids***      - массив ID цен ([правила работы с ценой](#работа-с-ценами)).
- ***load_discounts*** - если true, то для указанных в ***price_ids*** цен будут подгружаться скидки ([правила работы с ценой](#работа-с-ценами)).

<ins>***Поддержка работы с торговыми предложениями***</ins>

Если нужно достать торговые предложения, то все параметры, указанные выше (**кроме images**) заполняются для инфоблока торгового предложения.
Для инфоблока товаров можно передать дополнительный параметр ***product***:

```
[
	'product' => [
		'filter' => [
			'NAME' => '',
			'PROPERTY_TEST' => ''
		],
		'props' => ['PROPERTY_MORE_PHOTO', 'NAME']
	]
]
```

***Обратите внимание, все коды свойств продукта нужно писать с префиксом ```PROPERTY_```***

Пример использования
```php
$APPLICATION->IncludeCOmponent(
	'odva:elements',
	'',
	[
		'filter'         => ['IBLOCK_ID' => 7],
		'sort'           => ['CML2_ARTICLE' => 'ASC,nulls'],
		'page'           => 2,
		'count'          => 5,
		// 'pagn_id'        => 'nav',
		// 'show_all'       => true,
		'load_section'   => true,
		'price_ids'      => [1, 4],
		'load_discounts' => false,
		'props'          => ['MORE_PHOTO', 'CML2_ARTICLE'],
		'images'         => ['MORE_PHOTO' => ['small' => [100, 100]], 'PREVIEW_PICTURE' => ['small' => [100, 100]]],
		'product' => [
			'filter' => [
				'NAME' => '',
				'PROPERTY_TEST' => ''
			],
			'props' => ['PROPERTY_MORE_PHOTO', 'NAME']
		]
	]
);
```


## Работа с ценами

Начиная с версии 18.6.200 битрикс умеет работать с ценами "красиво". Для получения цены надо в arSelect функции GetList передать ключ ```PRICE_<price_id>```. где price_id - ID типа цены. Посмотреть ID можно в админке: ***Магазин - Цены - Типы цен***

В нашем компоненте цены передаются отдельным параметром ***price_ids***, который является массивом ID-шников цен (не ```PRICE_<price_id>```, а только ```<price_id>```), которые нужно достать.

Сортировки и фильтры работают так же - передачей ключа ```PRICE_<price_id>```, где price_id - id типа цены. Но есть нюанс - ***не учитывается скидка***. Но это нормально =) стандартный компонент битрикса тоже не умеет сортировать с учетом скидки.

Если используются скидки и их нужно достать, надо передать дополнительный параметр ***load_discounts*** со значением ***true***.
*Однако надо помнить, что при доставании скидок битрикс делает очень много запросов. Для 50 элементов делается около **```1000 запросов к БД```**. Поэтому доставать скидки нужно только при крайней необходимости.*

В результирующем массиве в ключе PRICE всегда находится актуальная цена (с учетом скидок). Если есть скидка для данного товара, то добавится ключ OLD_PRICE, в котором будет старая цена без учета скидок.


## Настройка обработки изображений

Массив images - ***обязательно*** ассоциативный, где

- ключ - код поля, которое надо обработать. Ключи DETAIL_PICTURE и PREVIEW_PICTURE автоматически воспринимаются как стандартные анонс
и детальная картинка. Остальные ищутся в массиве свойств.
- значение - массив настроек для изображения. Это тоже ***обязательно*** ассоциативный массив, где
	- ключ - код, с которым будет добавлена картинка в результирующий массив картинок
	- значение - массив, в котором ***первые два значения*** - ширина и высота для обрезания картинки - их нужно ***обязательно*** передать.
	Кроме того можно передать третий параметр - тип обрезания resizeType
	(см. [документацию по обрезанию картинок](https://dev.1c-bitrix.ru/api_help/main/reference/cfile/resizeimageget.php)).

*Коды свойств, которые передаются в images, *обязательно* нужно передать так же в *props*, иначе они не будут подгруженны и соответственно не обработаны.*

*Коды свойств продукта передавать **без** префикса ```PROPERTY_```*


## Настройка пагинации

Пагинацию можно вывести с помощью компонента *bitrix:main.pagenavigation*. Нормальной документации не нашел, но про подключение можно почитать
[тут](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=2741&LESSON_PATH=3913.5062.5748.2741),
так же есть пример шаблона вместе с описанием в этом репозитории (bitrixComponetns)

В ```$arResult``` есть ключ ```NAV_OBJECT```, который необходимо передать при подключении.

Пример подключения пагинации ***в шаблоне odva:elemetns:***

```php
$APPLICATION->IncludeComponent(
	"bitrix:main.pagenavigation",
	"",
	[
		"NAV_OBJECT"  => $arResult['NAV_OBJECT']
	],
	false
);
```

Естественно надо создать шаблон для пагинации, и вывести там данные. Пример шаблона (с многоточиями: 1 2 ... 10) есть в этом же репозитории.

### Логика учитывания параметров пагинации

- если передается pagn_id
	- игнорируем параметры page и show_all
	- создаем объект пагинации и записываем его в arResult
	- берем все данные для пагинации из URL
	- количество элементов ставим либо из count, либо 20
	- передаем в getlist параметры iNumPage и nPageSize, значения которых берем из объекта nav

- если pagn_id не передан
	- объект пагинации не создаем
	- если есть page
		- передаем в getlist параметры iNumPage и nPageSize
			- iNumPage берем из page
			- nPageSize либо из count, либо 20
	- если нет page
		- если есть count
			- передаем в getlist параметр nTopCount
		- если нет count
			- если есть параметр show_all
				- оставляем параметры навигации пустым массивом
			- если нет параметра show_all
				- передаем в getlist параметр nTopCount