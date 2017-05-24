<?php
/**
 * Robots default helper
 *
 * @category Popov
 * @package Popov_Retag
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 20.04.14 14:54
 */
class Popov_Retag_Helper_Data extends Mage_Core_Helper_Abstract {

	public function setCookies() {
		$request = Mage::app()->getRequest();
		$cookie = Mage::getSingleton('core/cookie');
		if ($request->get('pdid')) {
			$cookie->set('POKUPON_DID', $request->get('pdid'), time() + 2592000, '/');
		}
		if ($request->get('puid')) {
			$cookie->set('POKUPON_UID', $request->get('puid'), time() + 2592000, '/');
		}
	}

}
