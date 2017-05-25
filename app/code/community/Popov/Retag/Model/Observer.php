<?php
/**
 * Add Admitad ReTag
 *
 * @category Popov
 * @package Popov_Retag
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 24.05.2017 17:40
 */

class Popov_Retag_Model_Observer extends Varien_Event_Observer
{
	/**
	 * @var Popov_Retag_Helper_Data $helper
	 */
	protected $helper;

	public function hookToSetScript()
	{
        $block = Mage::app()->getLayout()->createBlock(
            'popov_retag/script',
            'admitad.retag.script',
            array('action' => Mage::app()->getFrontController()->getAction()->getFullActionName())
        );
        $beforeBodyEnd = Mage::app()->getLayout()->getBlock('before_body_end');

        $beforeBodyEnd->append($block);
	}
}