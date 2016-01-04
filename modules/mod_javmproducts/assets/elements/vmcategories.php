<?php
defined('_JEXEC') or die();

/**
 *
 * @package    VirtueMart
 * @subpackage Plugins  - Elements
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if (!class_exists( 'VmConfig' )) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');

if (!class_exists('ShopFunctions'))
	require(VMPATH_ADMIN . DS . 'helpers' . DS . 'shopfunctions.php');
if (!class_exists('TableCategories'))
	require(VMPATH_ADMIN . DS . 'tables' . DS . 'categories.php');

if (JVM_VERSION == 2) {
	// VM VERSION 2
	if (!class_exists('VmElements'))
	    require(JPATH_VM_ADMINISTRATOR . DS . 'elements' . DS . 'vmelements.php');
	/*
	 * This element is used by the menu manager
	 * Should be that way
	 */
	class VmElementVmCategories extends VmElements {
	
	    var $type = 'vmcategories';
	
	    // This line is required to keep Joomla! 1.6/1.7 from complaining
	    function getInput() {
	        $key = ($this->element['key_field'] ? $this->element['key_field'] : 'value');
	        $val = ($this->element['value_field'] ? $this->element['value_field'] : $this->name);
			$ispublish = ($this->element['publish'] ? $this->element['publish'] : '0');
		    $lang = JFactory::getLanguage();
		    $lang->load('com_virtuemart',JPATH_ADMINISTRATOR);
			$value = $this->value?$this->value:array();
	        $categorylist = $this->categoryListTree($value,$ispublish);
			if($categorylist){
				$html = '<select class="inputbox"   name="' . $this->name . '[]" multiple="multiple">';
				//$html .= '<option value="0">' . JText::_('COM_VIRTUEMART_CATEGORY_FORM_TOP_LEVEL') . '</option>';
				$html .= $categorylist;
				$html .="</select>";
			}else{
				$html = '<span color="red">'.JText::_('COM_VIRTUEMART_CATEGORY_DOES_NOT_CREATED_CATEGORIES').'</span>';
			}
	        return $html;
	    }
	    /**
		 * Creates structured option fields for all categories
		 *
		 * @todo: Connect to vendor data
		 * @author RolandD, Max Milbers, jseros
		 * @param array 	$selectedCategories All category IDs that will be pre-selected
		 * @param int 		$cid 		Internally used for recursion
		 * @param int 		$level 		Internally used for recursion
		 * @return string 	$category_tree HTML: Category tree list
		 */
		static public function categoryListTree($selectedCategories = array(),$ispublish=0, $cid = 0, $level = 0, $disabledFields = array()) {
	
			//self::$counter++;
			$publish = false;
			if ($ispublish==1) {
				$publish = true;
			}
			static $categoryTree = '';
	
			$virtuemart_vendor_id = 1;
	
	// 		vmSetStartTime('getCategories');
			$categoryModel = VmModel::getModel ('category');
			$level++;
	
			$categoryModel->_noLimit = TRUE;
			$app = JFactory::getApplication ();
			$records = $categoryModel->getCategories ($publish, $cid);
	// 		vmTime('getCategories','getCategories');
			$selected = "";
			if (!empty($records)) {
				foreach ($records as $key => $category) {
	
					$childId = $category->category_child_id;
	
					if ($childId != $cid) {
						if (in_array ($childId, $selectedCategories)) {
							$selected = 'selected=\"selected\"';
						} else {
							$selected = '';
						}
	
						$disabled = '';
						if (in_array ($childId, $disabledFields)) {
							$disabled = 'disabled="disabled"';
						}
	
						if ($disabled != '' && stristr ($_SERVER['HTTP_USER_AGENT'], 'msie')) {
							//IE7 suffers from a bug, which makes disabled option fields selectable
						} else {
							$categoryTree .= '<option ' . $selected . ' ' . $disabled . ' value="' . $childId . '">';
							$categoryTree .= str_repeat (' - ', ($level - 1));
	
							$categoryTree .= $category->category_name . '</option>';
						}
					}
	
					if ($categoryModel->hasChildren ($childId)) {
						$categoryTree .= ShopFunctions::categoryListTreeLoop ($selectedCategories, $childId, $level, $disabledFields);
					}
	
				}
			}
	
			return $categoryTree;
		}
	
	}
	
	
	if (JVM_VERSION === 2 ) {
	
	    class JFormFieldVmCategories extends VmElementVmCategories {
	
	    }
	
	} else {
	
	    class JElementVmCategories extends VmElementVmCategories {
	
	    }
	
	}
} else {
	// VM VERSION 3
	jimport('joomla.form.formfield');
	
	/*
	 * This element is used by the menu manager
	 * Should be that way
	 */
	class JFormFieldVmcategories extends JFormField {
	
		var $type = 'vmcategories';
	
		// This line is required to keep Joomla! 1.6/1.7 from complaining
		protected function getInput() {
			$key = ($this->element['key_field'] ? $this->element['key_field'] : 'value');
			$val = ($this->element['value_field'] ? $this->element['value_field'] : $this->name);
	
			VmConfig::loadConfig();
			VmConfig::loadJLang('com_virtuemart');
	
			$categorylist = ShopFunctions::categoryListTree(is_array($this->value) ? $this->value : array($this->value));
	
			$html = '<select class="inputbox" multiple="multiple" name="' . $this->name . '[]" >';
			$html .= '<option value="0">' . vmText::_('COM_VIRTUEMART_CATEGORY_FORM_TOP_LEVEL') . '</option>';
			$html .= $categorylist;
			$html .= "</select>";
			return $html;
		}
	
	
	}
}