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

	public function getCmsIndexIndexScript() {
	    return sprintf('<script type="text/javascript">
    window._retag = window._retag || [];
    window._retag.push({code: "9ce8887d95", level: 0});
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
</script>');
	}

	public function getCatalogCategoryViewScript() {
		die(__METHOD__);
		return $this->getCatalogCategoryLayeredScript();
	}
	
	public function getCatalogCategoryLayeredScript() {
		die(__METHOD__);
        $category = Mage::registry('current_category');

	    return sprintf('<script type="text/javascript">
    window.ad_category = "%s";   // required

    window._retag = window._retag || [];
    window._retag.push({code: "9ce8887d94", level: 1});
    (function () {
        var id = "admitad-retag";
        if (document.getElementById(id)) {return;}
        var s=document.createElement("script");
        s.async = true; s.id = id;
        var r = (new Date).getDate();
        s.src = (document.location.protocol == "https:" ? "https:" : "http:") + "//cdn.lenmit.com/static/js/retag.js?r="+r;
        var a = document.getElementsByTagName("script")[0]
        a.parentNode.insertBefore(s, a);
    })()
</script>', $category->getId());
	}

	/** checkout_cart_index */
	public function getCheckoutCartIndexScript() {
		die(__METHOD__);
        $data = array();
        $items = Mage::getSingleton('checkout/cart')->getQuote()->getAllItems();
        foreach ($items as $item) {
            //$productName = $item->getProduct()->getName();
            //$productPrice = $item->getProduct()->getPrice();
            $data[] = array('id' => $item->getProductId(), 'number' => $item->getQty());
        }

	    return sprintf('<script type="text/javascript">
    window.ad_products = [
    	%s
    ];

    window._retag = window._retag || [];
    window._retag.push({code: "9ce8887d92", level: 3});
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
</script>', Mage::helper('core')->jsonEncode($data));
	}

	public function getCheckoutOnepageSuccessScript() {

		$order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());

        $items = $order->getAllVisibleItems();
        $data = array();
        foreach ($items as $item) {
            //$productName = $item->getProduct()->getName();
            //$productPrice = $item->getProduct()->getPrice();
            $data[] = array('id' => $item->getProductId(), 'number' => $item->getQty());
        }

			return sprintf('<script type="text/javascript">
    window.ad_order = "%s";    // required
    window.ad_amount = "%d";
    window.ad_products = [
    	%s
    ];

    window._retag = window._retag || [];
    window._retag.push({code: "9ce8887d91", level: 4});
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
</script>', $order->getId(), $order->getGrandTotal(), Mage::helper('core')->jsonEncode($data));
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
		//die(__METHOD__);
        if (!($method = 'get' . uc_words($this->getData('action'), '') . 'Script')) {
            return '';
        }

        return $this->{$method}();
    }
}