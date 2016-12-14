<?php
 /**
 * @package mod_jlcurrency
 * @author Zhukov Artem (artem@joomline.ru)
 * @version 2.4
 * @copyright (C) 2012-2014 by JoomLine (http://www.joomline.net)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
// No direct access
defined('_JEXEC') or die('Restricted access');
require_once __DIR__ .'/helper.php';

JHtml::_('jquery.framework');
JFactory::getDocument()->addScript(JUri::root().'/modules/mod_jlcurrency/assets/js/jlcurrency.js');
$data = ModJlcurrencyHelper::getTodayCurrency();

if(is_array($data) && count($data)){
    require JModuleHelper::getLayoutPath('mod_jlcurrency', $params->get('layout', 'default'));
}

