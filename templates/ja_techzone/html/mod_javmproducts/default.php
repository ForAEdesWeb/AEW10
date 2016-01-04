<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
?>
<div class="vmgroup<?php echo $params->get ('moduleclass_sfx');?> vmproduct<?php echo $module->id; ?>">
	<div id="javm_slider<?php echo $module->id;?>" class="vmproduct productdetails owl-carousel">
	<?php foreach ($products as $product) : ?>
		<div class="slide floatleft">
			<div class="spacer">

				<div class="product-container">
					<div class="vm-product-media-container vmproduct-image">
						<?php
						if (!empty($product->images[0])) {
							$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
						} else {
							$image = '';
						}
						echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => htmlspecialchars($product->product_name)));?>
						
						<div class="show-desc">
							<?php 

							if ($show_addtocart) {
								?>				
								<div class="addtocart-area">
									<?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product,'rowHeights'=>$rowsHeight[$row])); ?>
									<?php 
										$link = empty($product->link)? $product->canonical:$product->link;
										echo JHtml::link($link.$ItemidStr,vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );
									?>
								</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="product-content clearfix">
						<?php 
							$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
								$product->virtuemart_category_id);
								?>
						<a class="vmproduct-title" href="<?php echo $url ?>"><?php echo $product->product_name ?></a>   
						
						<?php    
						echo '<div class="clear"></div>';
						if($show_rating){
							
							$rating = $ratingModel->getRatingByProduct($product->virtuemart_product_id);
							
							$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);

						    if (empty($rating)) {
							?>
							<div class="ratingbox dummy" title="<?php echo vmText::_('COM_VIRTUEMART_UNRATED'); ?>" ></div>
							    <?php
							} else {
							    $ratingwidth = $rating->rating * 24; //I don't use round as percetntage with works perfect, as for me
							    ?>
							<div title=" <?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE") . round($rating) . '/' . $maxrating) ?>" class="ratingbox" >
							  <div class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>"></div>
							</div>
							<?php
						    }
						}

						if ($show_price) {
							echo '<div class="product-price">'.$currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
							if ($product->prices['salesPriceWithDiscount'] > 0) {
								echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
							}
							echo '</div>';
						} ?>
					</div>
				</div>

			</div>
		</div>
	<?php
endforeach; ?>
</div>
</div>

<script>
(function($){
  jQuery(document).ready(function($) {
    $("#javm_slider<?php echo $module->id;?>.owl-carousel").owlCarousel({
      navigation : true,
      pagination: false,
      items: <?php echo $params->get('display_items', '4'); ?>,
      loop: false,
      scrollPerPage : true,
      itemsDesktop : [1199, 3],
      itemsDesktopSmall : [979, <?php echo $params->get('display_items_tablet', '2'); ?>],
      itemsTablet : [768, <?php echo $params->get('display_items_tablet', '2'); ?>],
      itemsTabletSmall : [600, <?php echo $params->get('display_items_mobile', '1'); ?>],
      itemsMobile : [479, <?php echo $params->get('display_items_mobile', '1'); ?>]
    });
  });
})(jQuery);
</script>