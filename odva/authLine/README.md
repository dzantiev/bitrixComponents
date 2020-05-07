# Компонент полоса авторизации

- пример подключения
```php
    $APPLICATION->IncludeComponent("odva:authLine","auth.line",[]);// auth.line - шаблок линии авторизации и регистарции
```
- примерные шаблоны
    auth.line - шаблок линии авторизации и регистарции

- переменные которые нужня для ajax, а следовательно и работы самого компонента
```php
	$arResult['LOGOUT_AJAX_PATH'] // - путь к файлу для разлогинизации
```