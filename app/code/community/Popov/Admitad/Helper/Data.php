<?php
/**
 * Admitad ReTag default Helper
 *
 * @category Popov
 * @package Popov_Admitad
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 20.04.14 14:54
 */
class Popov_Admitad_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function setCookies() {
        $request = Mage::app()->getRequest();
        $cookie = Mage::getSingleton('core/cookie');
        if ($request->get('admitad_uid')) {
            $cookie->set('ADMITAD_UID', $request->get('admitad_uid'), time() + 7776000, '/'); // 90 days

            if ($request->get('publisher_id')) {
                $cookie->set('ADMITAD_PUBLISHER_ID', $request->get('publisher_id'), time() + 7776000, '/');
            }
            if ($request->get('website_id')) {
                $cookie->set('ADMITAD_WEBSITE_ID', $request->get('website_id'), time() + 7776000, '/');
            }
            if ($request->get('chanel_id')) {
                $cookie->set('ADMITAD_CHANEL_ID', $request->get('chanel_id'), time() + 7776000, '/');
            }
            if ($request->get('group_id')) {
                $cookie->set('ADMITAD_GROUP_ID', $request->get('group_id'), time() + 7776000, '/');
            }
        }
    }
}
