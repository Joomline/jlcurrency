<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

/**
 * Helper for mod_articles_news
 *
 * @since  1.6
 */
abstract class ModJlcurrencyHelper
{

    public static function getTodayCurrency()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('data')->from('#__mod_jlcurrency_data');
        $result = $db->setQuery($query,0,1)->loadResult();
        return json_decode($result, true);
    }

    public static function loadCurrency($vl, $increase)
    {
        $xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
        foreach ($xml->xpath('/ValCurs') as $prod) {
            $date_now = str_replace("SimpleXMLElement Object ( [0] => ", "", $prod['Date']);
        }
        $i = 0;
        $valute = array();
        $increase = ($increase > 0) ? 1 + ($increase / 100) : 0;
        foreach ($xml->xpath('/ValCurs/Valute') as $producs) {
            if (array_key_exists((string)$producs->CharCode, $vl)) {
                $valute[$i]['Date'] = date("d.m", strtotime($date_now));
                $valute[$i]['NumCode'] = (string)$producs->NumCode;
                $valute[$i]['CharCode'] = (string)$producs->CharCode;
                $valute[$i]['Nominal'] = (string)$producs->Nominal;
                $valute[$i]['Name'] = (string)$producs->Name;
                if ($increase > 0) {
                    $valute[$i]['Value'] = sprintf("%.2f", str_replace(",", ".", ((string)$producs->Value)) * $increase);
                } else {
                    $valute[$i]['Value'] = sprintf("%.2f", str_replace(",", ".", ((string)$producs->Value)));
                }
                ++$i;
            }
        }
        return $valute;
    }

    public static function getAjax()
    {
        $date = new DateTime();
        $date = $date->format('Y-m-d');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`date`')->from('#__mod_jlcurrency_data');
        $result = $db->setQuery($query,0,1)->loadResult();

        if($result == $date){
            echo 'not modified';
            return;
        }

        $moduleObject = JModuleHelper::getModule('mod_jlcurrency', null);

        $params = new JRegistry($moduleObject->params);

        $vl = array();
        $vl[$params->get('JPY')] = $params->get('JPY');
        $vl[$params->get('ZAR')] = $params->get('ZAR');
        $vl[$params->get('KRW')] = $params->get('KRW');
        $vl[$params->get('CHF')] = $params->get('CHF');
        $vl[$params->get('SEK')] = $params->get('SEK');
        $vl[$params->get('CZK')] = $params->get('CZK');
        $vl[$params->get('UAH')] = $params->get('UAH');
        $vl[$params->get('UZS')] = $params->get('UZS');
        $vl[$params->get('TRY')] = $params->get('TRY');
        $vl[$params->get('TMT')] = $params->get('TMT');
        $vl[$params->get('TJS')] = $params->get('TJS');
        $vl[$params->get('SGD')] = $params->get('SGD');
        $vl[$params->get('XDR')] = $params->get('XDR');
        $vl[$params->get('RON')] = $params->get('RON');
        $vl[$params->get('PLN')] = $params->get('PLN');
        $vl[$params->get('NOK')] = $params->get('NOK');
        $vl[$params->get('MDL')] = $params->get('MDL');
        $vl[$params->get('LTL')] = $params->get('LTL');
        $vl[$params->get('LVL')] = $params->get('LVL');
        $vl[$params->get('CNY')] = $params->get('CNY');
        $vl[$params->get('KGS')] = $params->get('KGS');
        $vl[$params->get('CAD')] = $params->get('CAD');
        $vl[$params->get('KZT')] = $params->get('KZT');
        $vl[$params->get('INR')] = $params->get('INR');
        $vl[$params->get('EUR')] = $params->get('EUR');
        $vl[$params->get('USD')] = $params->get('USD');
        $vl[$params->get('DKK')] = $params->get('DKK');
        $vl[$params->get('HUF')] = $params->get('HUF');
        $vl[$params->get('BRL')] = $params->get('BRL');
        $vl[$params->get('BGN')] = $params->get('BGN');
        $vl[$params->get('BYR')] = $params->get('BYR');
        $vl[$params->get('AMD')] = $params->get('AMD');
        $vl[$params->get('GBP')] = $params->get('GBP');
        $vl[$params->get('AZN')] = $params->get('AZN');
        $vl[$params->get('AUD')] = $params->get('AUD');

        $increase = $params->get('increase');

        $xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
        foreach ($xml->xpath('/ValCurs') as $prod) {
            $date_now = str_replace("SimpleXMLElement Object ( [0] => ", "", $prod['Date']);
        }
        $i = 0;
        $valute = array();
        $increase = ($increase > 0) ? 1 + ($increase / 100) : 0;
        foreach ($xml->xpath('/ValCurs/Valute') as $producs) {
            if (array_key_exists((string)$producs->CharCode, $vl)) {
                $valute[$i]['Date'] = date("d.m", strtotime($date_now));
                $valute[$i]['NumCode'] = (string)$producs->NumCode;
                $valute[$i]['CharCode'] = (string)$producs->CharCode;
                $valute[$i]['Nominal'] = (string)$producs->Nominal;
                $valute[$i]['Name'] = (string)$producs->Name;
                if ($increase > 0) {
                    $valute[$i]['Value'] = sprintf("%.2f", str_replace(",", ".", ((string)$producs->Value)) * $increase);
                } else {
                    $valute[$i]['Value'] = sprintf("%.2f", str_replace(",", ".", ((string)$producs->Value)));
                }
                ++$i;
            }
        }

        if(count($valute)){
            $query->clear()->delete('#__mod_jlcurrency_data');
            $db->setQuery($query)->execute();
            $ob = new stdClass();
            $ob->date = $date;
            $ob->data = json_encode($valute);
            $db->insertObject('#__mod_jlcurrency_data', $ob);
        }

        echo 'ok';
        return;
    }
}
