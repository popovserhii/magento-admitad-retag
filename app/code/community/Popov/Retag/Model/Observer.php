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

	public function hookToSetProductScript() 
	{
		//Zend_Debug::dump(Mage::app()->getFrontController()->getAction()->getFullActionName()); die(__METHOD__);
        $block = Mage::app()->getLayout()->createBlock(
            'popov_retag/script',
            'admitad.retag.script',
            array('action' => Mage::app()->getFrontController()->getAction()->getFullActionName())
        );
        //$script = $block->getCatalogProductViewScript();

        $beforeBodyEnd = Mage::app()->getLayout()->getBlock('before_body_end');

        //$handle = Mage::app()->getLayout()->getUpdate()->getHandles();
        //$actionName = Mage::app()->getFrontController()->getAction()->getFullActionName();

        /*$block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'my_block_name_here',
            array('template' => 'activecodeline/developer.phtml')
        );*/

		//Zend_Debug::dump($block); die(__METHOD__);		
        $beforeBodyEnd->append($block);
        //echo $script;
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