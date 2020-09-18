# Элемент детально

Компонент для вывода детальной информации элемента или простого продукта (***торговые предложения не поддерживаются***)

Принимаемые параметры:

- ___ID___ _или_ ___CODE___ - соответственно, ID или CODE элемента. ___Один из двух надо передать обязательно.___ Если переданы оба, учитывается ID
- ___props___               - массив CODE свойств, которые нужно достать
- ___load_section___        - подгружать / не подгружать информацию о разделе
- ___price_ids___           - массив ID типов цен, которые нужно достать. Посмотреть ID можно в админке: ***Магазин - Цены - Типы цен***
- ___images___              - массив [настроек для обработки изображений](#настройка-обработки-изображений).

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