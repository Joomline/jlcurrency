<?php
 /**
 * @package mod_jlcurrency
 * @author Zhukov Artem (artem@joomline.ru)
 * @version 1.1
 * @copyright (C) 2012 by JoomLine (http://www.joomline.net)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
// No direct access
defined('_JEXEC') or die('Restricted access');
$vl = array();
$vl[$params->get('JPY')]=$params->get('JPY');$vl[$params->get('ZAR')]=$params->get('ZAR');
$vl[$params->get('KRW')]=$params->get('KRW');$vl[$params->get('CHF')]=$params->get('CHF');
$vl[$params->get('SEK')]=$params->get('SEK');$vl[$params->get('CZK')]=$params->get('CZK');
$vl[$params->get('UAH')]=$params->get('UAH');$vl[$params->get('UZS')]=$params->get('UZS');
$vl[$params->get('TRY')]=$params->get('TRY');$vl[$params->get('TMT')]=$params->get('TMT');
$vl[$params->get('TJS')]=$params->get('TJS');$vl[$params->get('SGD')]=$params->get('SGD');
$vl[$params->get('XDR')]=$params->get('XDR');$vl[$params->get('RON')]=$params->get('RON');
$vl[$params->get('PLN')]=$params->get('PLN');$vl[$params->get('NOK')]=$params->get('NOK');
$vl[$params->get('MDL')]=$params->get('MDL');$vl[$params->get('LTL')]=$params->get('LTL');
$vl[$params->get('LVL')]=$params->get('LVL');$vl[$params->get('CNY')]=$params->get('CNY');
$vl[$params->get('KGS')]=$params->get('KGS');$vl[$params->get('CAD')]=$params->get('CAD');
$vl[$params->get('KZT')]=$params->get('KZT');$vl[$params->get('INR')]=$params->get('INR');
$vl[$params->get('EUR')]=$params->get('EUR');$vl[$params->get('USD')]=$params->get('USD');
$vl[$params->get('DKK')]=$params->get('DKK');$vl[$params->get('HUF')]=$params->get('HUF');
$vl[$params->get('BRL')]=$params->get('BRL');$vl[$params->get('BGN')]=$params->get('BGN');
$vl[$params->get('BYR')]=$params->get('BYR');$vl[$params->get('AMD')]=$params->get('AMD');
$vl[$params->get('GBP')]=$params->get('GBP');$vl[$params->get('AZN')]=$params->get('AZN');
$vl[$params->get('AUD')]=$params->get('AUD');

if (!function_exists("getTodayCurrency")) {
    function getTodayCurrency($vl) {
      $xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
      foreach ($xml->xpath('/ValCurs') as $prod) {$date_now = str_replace("SimpleXMLElement Object ( [0] => ","",$prod['Date']);}
       $i=0;$valute= array();
      foreach ($xml->xpath('/ValCurs/Valute') as $producs) {
        if (array_key_exists(str_replace("SimpleXMLElement Object ( [0] => ","",$producs->CharCode), $vl)) {
			$valute[$i]['Date'] = date("d.m",strtotime($date_now));
			$valute[$i]['NumCode'] = str_replace("SimpleXMLElement Object ( [0] => ","",$producs->NumCode);
			$valute[$i]['CharCode'] = str_replace("SimpleXMLElement Object ( [0] => ","",$producs->CharCode);
			$valute[$i]['Nominal'] = str_replace("SimpleXMLElement Object ( [0] => ","",$producs->Nominal);
			$valute[$i]['Name'] = str_replace("SimpleXMLElement Object ( [0] => ","",$producs->Name);
			$valute[$i]['Value'] = str_replace("SimpleXMLElement Object ( [0] => ","",$producs->Value);
			++$i;
		}
        }
      return $valute;
    }
}
$cache = & JFactory::getCache('mod_jlcurrency');
$enabled_cache = $params->get('cache');
$time_cache = $params->get('timecache')*60;
$cache->setCaching( $enabled_cache );  
if ($enabled_cache==1){$cache->setLifeTime($time_cache); }
$data = $cache->call( 'getTodayCurrency',$vl) ;

require JModuleHelper::getLayoutPath('mod_jlcurrency', $params->get('layout', 'default'));