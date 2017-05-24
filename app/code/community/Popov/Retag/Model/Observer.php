<?php
/**
 * Add Admitad ReTag
 *
 * @category Popov
 * @package Popov_Retag
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 24.05.2017 17:40
 */

class Popov_Retag_Model_Observer extends Varien_Event_Observer {

	/**
	 * @var Popov_Retag_Helper_Data $helper
	 */
	protected $helper;

	public function hookToSetProductScript() {
	    die(__METHOD__);
		$this->getHelper()->setCookies();
	}

	public function hookToSetPokuponCookies() {
		$this->getHelper()->setCookies();
	}

	public function getHelper() {
		if (!$this->helper) {
			$this->helper = Mage::helper('popov_retag');
		}

		return $this->helper;
	}
}