<?php
	defined ('_JEXEC') or  die('Direct Access to ' . basename (__FILE__) . ' is not allowed.');
	/*
 * Module Helper
 *
 * @package VirtueMart
 * @copyright (C) 2010 - Patrick Kohl
 * @ Email: cyber__fr|at|hotmail.com
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * VirtueMart is Free Software.
 * VirtueMart comes with absolute no warranty.
 *
 * www.virtuemart.net
 */
	if (!class_exists ('VmConfig')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
	}
	VmConfig::loadConfig ();
	// Load the language file of com_virtuemart.
	JFactory::getLanguage ()->load ('com_virtuemart');
	if (!class_exists ('calculationHelper')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'calculationh.php');
	}
	if (!class_exists ('CurrencyDisplay')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'currencydisplay.php');
	}
	if (!class_exists ('VirtueMartModelVendor')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' . DS . 'vendor.php');
	}
	if (!class_exists ('VmImage')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'image.php');
	}
	if (!class_exists ('shopFunctionsF')) {
		require(JPATH_SITE . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'shopfunctionsf.php');
	}
	if (!class_exists ('calculationHelper')) {
		require(JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'cart.php');
	}
	if (!class_exists ('VirtueMartModelProduct')) {
		JLoader::import ('product', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models');
	}

class ModJAVMProduct{
	public static function &getInstance()
    {
        static $instance = null;
        if (!$instance) {
            $instance = new ModJAVMProduct();
        }
        return $instance;
    }
	
	function addtocart ($product) {	
		$app = JFactory::getApplication();
		
		
		
		if (!VmConfig::get ('use_as_catalog', 0)) {
			$stockhandle = VmConfig::get ('stockhandle', 'none');
			if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) {
				$button_lbl = JText::_ ('COM_VIRTUEMART_CART_NOTIFY');
				$button_cls = 'notify-button';
				$button_name = 'notifycustomer';
				?>
				<div style="display:inline-block;">
			<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>
				</div>
			<?php
			} else {
				$basepath = JPATH_SITE.'/modules/mod_javmproducts/tmpl/';
		
				$templatepath = 'templates/'.$app->getTemplate().'/html/mod_javmproducts/';
				
				if(file_exists(JPATH_SITE . '/' . $templatepath.'cart.php')) {
					$carttemp = JPATH_SITE.'/'.$templatepath.'cart.php';
				}else {
					$carttemp = $basepath.'cart.php';
				}
				?>
			<div class="addtocart-area">
				<?php
				ob_start();
				require $carttemp;
				$contents = ob_get_contents();
				ob_end_clean();
				echo $contents;
				?>
				<div class="clear"></div>
			</div>
			<?php
			}
		}
	}
}
