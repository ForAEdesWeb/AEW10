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

// no direct access
defined('_JEXEC') or die('Restricted access');
/**
 * Default joomla
 * */
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

$mainframe = JFactory::getApplication();
$document  = JFactory::getDocument();

/**
 * Require helpers
 * Override add to cards
 * */
require_once (dirname(__FILE__) .  '/helpers/'  . 'helper.php');
$helper = ModJAVMProduct::getInstance();
/**
 *load js and css file
 * */
include(dirname(__FILE__).'/assets/asset.php');
//Load VM Libraries

if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');

VmConfig::loadConfig();

//Get params
$max_items 		= $params->get('max_items',10);
$display_items	= $params->get('display_items',3);
$category_id 	= $params->get('vm_catids');

$show_price = 		(bool)$params->get( 'show_price', 1 ); // Display the Product Price?
$show_addtocart = 	(bool)$params->get( 'show_addtocart', 1 ); // Display the "Add-to-Cart" Link?
$show_rating = 	(bool)$params->get( 'show_rating', 1 ); // Display the "Add-to-Cart" Link?
$product_group = 	$params->get( 'product_group', 'featured'); // Display a footerText
//Get products

$productModel = VmModel::getModel('Product');


if(is_array($category_id)){
	$products 	  = array();
	foreach ($category_id as $catid) {
		$prods 	= array();
		$prods 	= $productModel->getProductListing($product_group, $max_items, true, true, false,true, $catid);
		if(count($prods)){
			foreach ($prods as $prod){
				array_push($products,$prod);
			}
		}
	}
	$productModel->addImages($products);
}


if(empty($products)) return false;
$currency = CurrencyDisplay::getInstance( );

vmJsApi::jPrice();
vmJsApi::cssSite();

if($show_rating){
	$ratingModel = VmModel::getModel('ratings');
}
require JModuleHelper::getLayoutPath('mod_javmproducts', $params->get('layout', 'default'));