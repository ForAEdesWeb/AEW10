<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
?>
<form method="post" class="product" action="index.php">
	<?php
	// Product custom_fields
	if (!empty($product->customfieldsCart)) {
		?>
		<div class="product-fields">
			<?php foreach ($product->customfieldsCart as $field) { ?>

			<div style="display:inline-block;" class="product-field product-field-type-<?php echo $field->field_type ?>">
				<span class="product-fields-title"><b><?php echo $field->custom_title ?></b></span>
				<?php echo JHTML::tooltip ($field->custom_tip, $field->custom_title, 'tooltip.png'); ?>
				<span class="product-field-display"><?php echo $field->display ?></span>
				<span class="product-field-desc"><?php echo $field->custom_field_desc ?></span>
			</div>

			<?php } ?>
		</div>
		<?php } ?>

	<div class="addtocart-bar">

		<?php
		// Display the quantity box
		?>
		<!-- <label for="quantity<?php echo $product->virtuemart_product_id;?>" class="quantity_box"><?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </label> -->
<!-- Quantity auto set 1 -->
<input type="hidden" class="quantity-input" name="quantity[]" value="1"/>
		<?php
		// Add the button
		$button_lbl = JText::_ ('COM_VIRTUEMART_CART_ADD_TO');
		$button_cls = ''; //$button_cls = 'addtocart_button';


		?>
		<?php // Display the add to cart button ?>
		<span class="addtocart-button">
			<?php 
			echo shopFunctionsF::getAddToCartButton($product->orderable); ?>
</span>

		<div class="clear"></div>
	</div>

	<input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
	<input type="hidden" name="option" value="com_virtuemart"/>
	<input type="hidden" name="view" value="cart"/>
	<noscript><input type="hidden" name="task" value="add"/></noscript>
	<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
	<input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>"/>
</form>