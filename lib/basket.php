<?php

namespace Odva\Module;

use \Bitrix\Sale;
use \Bitrix\Main\Error;
use \Bitrix\Main\Loader;
use \Bitrix\Sale\Discount;
use \Bitrix\Sale\Discount\Context\Fuser;

Loader::includeModule("sale");
Loader::includeModule("catalog");

/**
 * класс для работы с корзиной
 */
class Basket
{
	/**
	 * статический объект корзины
	 * @var \Bitrix\Sale\Basket
	 */
	public static $basket = false;

	/**
	 * полная информация о корзине -
	 * список продуктов, цены и количество
	 *
	 * @return array ['PRODUCTS', 'PRICE', 'COUNT']
	 */
	public function getInfo()
	{
		return [
			'PRODUCTS' => self::getItemsArray(),
			'COUNT'    => self::getCount(),
			'PRICE'    => self::getPrice()
		];
	}

	/**
	 * список продуктов корзины в виде массива
	 * @return array
	 */
	public function getItemsArray()
	{
		$basketItems = self::getItemsObject();
		$result 	 = [];
		$products    = [];
		$ids		 = [];

		foreach ($basketItems as $basketItem)
		{
			$item = [];

			$item['ID'] = $basketItem->getId();
			$item['PRODUCT_ID'] = $basketItem->getProductId();
			$item['PRICE'] = self::getProductPrice($basketItem);
			$item['QUANTITY'] = $basketItem->getQuantity();

			$ids[] = $item['PRODUCT_ID'];

			$products[$item['PRODUCT_ID']] = $item;
		}

		if(!empty($ids))
			$result = self::fillElementsData($products, $ids);

		return $result;
	}

	public function getProductPrice($product)
	{
		$price = [];

		$price['BASE_PRICE'] = $product->getBasePrice();
		$price['DISCOUNT_PRICE'] = $product->getDiscountPrice();
		$price['DISCOUNT_PERCENT'] = round(($product->getDiscountPrice() * 100 / $product->getBasePrice()), 0);
		$price['PRICE'] = $product->getPrice();

		return $price;
	}

	public function fillElementsData($products, $ids)
	{
		$res = \CIBlockElement::GetList([], ['ID' => $ids], false, [], []);

		$result = [];

		while ($ob = $res->GetNextElement())
		{
			$product = $ob->GetFields();
			$product['PROPERTIES'] = $ob->getProperties();

			$result[$product['ID']] = array_merge($products[$product['ID']], $product);
		}

		return $result;
	}

	/**
	 * возвращает коллекцию элементов корзины в виде объекта
	 * @return \Bitrix\Sale\BasketItemCollection
	 */
	public static function getItemsObject()
	{
		$basket = self::getBasket();
		return $basket->getBasketItems();
	}

	/**
	 * возвращает количество елементов в корзине
	 * @return array ['ITEMS' => int, 'PRODUCTS' => int]
	 */
	public function getCount()
	{
		$basket = self::getBasket();
		return [
			'ITEMS'    => array_sum(array_values($basket->getQuantityList())),
			'PRODUCTS' => $basket->count(),
		];
	}

	/**
	 * достает цену корзины
	 * @return array ['BASE' => int, 'PRICE' => int]
	 */
	public function getPrice()
	{
		$basket = self::getBasket();

		return [
			'BASE'     => $basket->getBasePrice(),
			'PRICE'    => $basket->getPrice(),
			'DISCOUNT' => (floatval($basket->getBasePrice()) - floatval($basket->getPrice()))
		];
	}

	/**
	 * добавляет в корзину указанный товар в указанном количестве
	 *
	 * @param int $productId ID продукта
	 * @param int $quantity количество
	 */
	public function addItem($productId, $quantity)
	{
		if(!\CCatalogProduct::GetByID($productId))
		{
			$result = new \Bitrix\Sale\Result();
			$result->addError(new Error("Продукт #{$productId} не найден."));
			return $result;
		}

		$basket = self::getBasket();

		if ($item = $basket->getExistsItem('catalog', $productId))
		{
			$newQuantity = $item->getQuantity() + $quantity;

			if($newQuantity <= 0)
				$item->delete();
			else
				$item->setField('QUANTITY', $newQuantity);
		}
		else
		{
			$item = $basket->createItem('catalog', $productId);

			$item->setFields([
				'QUANTITY'               => $quantity,
				'CURRENCY'               => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
				'LID'                    => \Bitrix\Main\Context::getCurrent()->getSite(),
				'PRODUCT_PROVIDER_CLASS' => \Bitrix\Catalog\Product\Basket::getDefaultProviderName()
			]);
		}

		return $basket->save();
	}

	/**
	 * увеличение / уменьшение количества товара в корзине
	 * если количество будет <= 0, товар удалится из корзины
	 *
	 * @param int $productId id продукта
	 * @param int $quantity количество, может быть как положительным, так и отрицательным
	 */
	public function changeItemQuantity($productId, $quantity)
	{
		$basket = self::getBasket();
		$item   = $basket->getExistsItem('catalog', $productId);

		if(!$item)
			return new Error("Продукт #{$productId} в корзине не найден.");

		$newQuantity = $item->getQuantity() + $quantity;

		if($newQuantity <= 0)
			$item->delete();
		else
			$item->setField('QUANTITY', $newQuantity);

		$result = $basket->save();

		self::reset();

		return $result;
	}

	/**
	 * метод класса котоый удаляет товар из корзины
	 *
	 * @param int $itemId id продукта, который надо удалить
	 */
	public function deleteItem($itemId)
	{
		$basket = self::getBasket();

		$item = $basket->getExistsItem('catalog', $itemId);

		if (!$item)
			return new Error("Продукт #{$itemId} в корзине не найден.");

		$item->delete();
		$result = $basket->save();

		self::reset();

		return $result;
	}

	public function clear()
	{
		$basket = self::getBasket();
		$basket->clearCollection();
		return $basket->save();
	}

	public function getBasket()
	{
		if(self::$basket === false)
			self::reset();

		return self::$basket;
	}

	public function reset()
	{
		$basket    = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), SITE_ID);

		$context   = new \Bitrix\Sale\Discount\Context\Fuser($basket->getFUserId());
		$discounts = \Bitrix\Sale\Discount::buildFromBasket($basket, $context);

		if(!empty($discounts))
			$result = $discounts->calculate()->getData();

		if(array_key_exists('BASKET_ITEMS', $result))
			$basket->applyDiscount($result['BASKET_ITEMS']);

		self::$basket = $basket;
	}

	/**
	 * проверка существования товара в корзине
	 *
	 * @param int $productId id товара
	 */
	public function hasInBasket($productId)
	{
		$basket = self::getBasket();
		return $basket->getExistsItem('catalog', $productId);
	}

	/**
	 * применение купона
	 * @param  string купон
	 * @return boolean
	 */
	public function applyCoupon($coupon)
	{
		return \Bitrix\Sale\DiscountCouponsManager::add($coupon);
	}

	/**
	 * отмена купона
	 * @param  string купон
	 * @return boolean
	 */
	public function deleteCoupon($coupon)
	{
		return \Bitrix\Sale\DiscountCouponsManager::delete($coupon);
	}
}