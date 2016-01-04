<?php
/**
 * @version $Id: edit_legacy.php 272 2014-05-21 10:25:49Z michal $
 * @package DJ-Catalog2
 * @copyright Copyright (C) 2012 DJ-Extensions.com LTD, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Michal Olczyk - michal.olczyk@design-joomla.eu
 *
 * DJ-Catalog2 is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-Catalog2 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-Catalog2. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'country.cancel' || document.formvalidator.isValid(document.id('country-form'))) {
			Joomla.submitform(task, document.getElementById('country-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_djcatalog2&view=country&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="country-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_DJCATALOG2_NEW') : JText::_('COM_DJCATALOG2_EDIT'); ?></legend>
			<ul class="adminformlist">
			<li>
			<?php echo $this->form->getLabel('country_name'); ?>
			<?php echo $this->form->getInput('country_name'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('published'); ?>
			<?php echo $this->form->getInput('published'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('country_2_code'); ?>
			<?php echo $this->form->getInput('country_2_code'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('country_3_code'); ?>
			<?php echo $this->form->getInput('country_3_code'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('is_default'); ?>
			<?php echo $this->form->getInput('is_default'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('is_eu'); ?>
			<?php echo $this->form->getInput('is_eu'); ?>
			</li>

			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>
			
			</ul>

		</fieldset>
		
	</div>
	<div class="clr"></div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>