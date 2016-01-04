<?php
/**
 * ------------------------------------------------------------------------
 * JA VMProducts Module
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

$app = JFactory::getApplication();
$lang = jFactory::getLanguage();

$basepath = JURI::root(true).'/modules/' . $module->module . '/assets/';

$doc = JFactory::getDocument();
$autoplay = 'false';
if ($params->get('autoplay',0)) {
	$autoplay = 'true';
}
$navigation = 'false';
if ($params->get('navigation',0)) {
	$navigation = 'true';
}
$circular = 'false';
if($params->get('circular',0)){
	$circular = 'true';
}
if(!defined('_MODE_JAVM_ASSETS_')){
	define('_MODE_JAVM_ASSETS_', 1);
    if($lang->isRTL() == 1){
        $doc->addScript($basepath.'js/jquery.bxslider.rtl.js');
    }else{
        $doc->addScript($basepath.'js/jquery.bxslider.js');
    }

	$doc->addScript($basepath.'js/script.js');
	$doc->addStyleSheet($basepath.'css/style.css');
}
if (!defined('_MODE_JAVM_ASSETS_' . $module->id)) {
	define('_MODE_JAVM_ASSETS_' . $module->id, 1);
	if(!($params->get('max_items',10) == 1 && count($params->get('vm_catids')) == 1)){
		$doc->addScriptDeclaration('
			jQuery(document).ready(function(){
				javm_slide("'.$module->id.'",'.$params->get('display_items',3).','.$autoplay.','.$circular.','.$params->get('display_items_mobile',1).','.$params->get('display_items_tablet',2).','.$navigation.');
			});
		');
	}
}
