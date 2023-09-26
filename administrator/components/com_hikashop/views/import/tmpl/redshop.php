<?php
/**
 * @package	HikaShop for Joomla!
 * @version	5.0.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2023 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php

echo JText::sprintf('X_IMPORT_DESC','Redshop','Redshop 1.x or 2.x').' :<br/>';
$functions = array('TAXATIONS','HIKA_CATEGORIES','PRODUCTS','PRICES','USERS','ORDERS','DOWNLOADS','FILES','HIKA_IMAGES','DISCOUNTS','COUPONS');
foreach($functions as $k => $v){
	echo '<br/>  - '.JText::_($v);
}

