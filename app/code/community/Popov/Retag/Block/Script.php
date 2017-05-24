<?php

/**
 * Pokupon Pixel
 *
 * @category Popov
 * @package Popov_Retag
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 16.08.2015 18:25
 */
class Popov_Retag_Block_Script extends Mage_Page_Block_Html_Wrapper {

	public function getCatalogProductViewScript() {
		$product = Mage::registry('current_product');

			return sprintf('<script type="text/javascript">
    // required object
    window.ad_product = {
        "id": "%s",   // required
        "vendor": "",
        "price": "%s",
        "url": "%s",
        "picture": "",
        "name": "%s",
        "category": ""
    };

    window._retag = window._retag || [];
    window._retag.push({code: "9ce8887d93", level: 2});
    (function () {
        var id = "admitad-retag";
        if (document.getElementById(id)) {return;}
        var s = document.createElement("script");
        s.async = true; s.id = id;
        var r = (new Date).getDate();
        s.src = (document.location.protocol == "https:" ? "https:" : "http:") + "//cdn.lenmit.com/static/js/retag.js?r="+r;
        var a = document.getElementsByTagName("script")[0]
        a.parentNode.insertBefore(s, a);
    })()
</script>', $product->getId(), $product->getFinalPrice(), Mage::helper('core/url')->getCurrentUrl()/*, Mage::helper('catalog/image')->init($product, 'image')*/, Mage::helper('core')->escapeHtml($product->getName()));
	}

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


    protected function _toHtml()
    {
        return $this->getCatalogProductViewScript();
    }
}