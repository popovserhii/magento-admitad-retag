<?php
/**
 * Add Admitad ReTag
 *
 * @category Popov
 * @package Popov_Admitad
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 24.05.2017 17:40
 */
ini_set('display_errors', 'on');
error_reporting(-1);
class Popov_Admitad_Model_Observer extends Varien_Event_Observer
{
	/**
	 * @var Popov_Admitad_Helper_Data $helper
	 */
	protected $helper;

	public function hookToSetScript()
	{
        $block = Mage::app()->getLayout()->createBlock(
            'popov_admitad/script',
            'admitad.retag.script',
            array('action' => Mage::app()->getFrontController()->getAction()->getFullActionName())
        );
        $beforeBodyEnd = Mage::app()->getLayout()->getBlock('before_body_end');
        $beforeBodyEnd->append($block);
	}

    public function hookToSendBackRequest()
	{
        /** @var $helper Popov_Admitad_Helper_PostBack */
        $helper = Mage::helper('popov_admitad/backRequest');
        $helper->buildParams();
    }

    public function hookToSetCookies()
    {
        $this->getHelper()->setCookies();
    }

    public function getHelper() {
        if (!$this->helper) {
            $this->helper = Mage::helper('popov_admitad');
        }

        return $this->helper;
    }

}