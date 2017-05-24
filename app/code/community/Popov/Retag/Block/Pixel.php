<?php

/**
 * Pokupon Pixel
 *
 * @category Popov
 * @package Popov_Retag
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 16.08.2015 18:25
 */
class Popov_Retag_Block_Pixel extends Mage_Core_Block_Template {

	public function getSuccessPokuponPixel() {
		$cookie = Mage::getSingleton('core/cookie');
		$order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());

		if ($cookie->get('POKUPON_DID')) {
			return sprintf('<img src="http://pokupon.ua/pixel/v2/%d/new.png?uid=%d&ord_id=%s&amount=%d" />',
				$cookie->get('POKUPON_DID'),
				(int) $cookie->get('POKUPON_UID'),
				$order->getId(),
				$order->getGrandTotal()
			//sprintf("%01.2f", $quote->getData('grand_total'))
			);
		}
	}

	public function getCompletePokuponPixel() {
		$cookie = Mage::getSingleton('core/cookie');
		$order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());

		if ($cookie->get('POKUPON_DID')) {
			return sprintf('<img src="http://pokupon.ua/pixel/v2/%d/complete.png?uid=%d&ord_id=%s&amount=%d" />',
				$cookie->get('POKUPON_DID'),
				(int) $cookie->get('POKUPON_UID'),
				$order->getId(),
				$order->getGrandTotal()
			);
		}
	}

}