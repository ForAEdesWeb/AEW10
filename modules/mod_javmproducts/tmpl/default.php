<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
?>
<div class="vmgroup<?php echo $params->get ('moduleclass_sfx');?> vmproduct<?php echo $module->id; ?>">
	<div id="javm_slide<?php echo $module->id;?>" class="vmproduct productdetails">
	<?php foreach ($products as $product) : ?>
		<div class="slide floatleft">
			<div class="spacer">
				<div class="vmproduct-image">
				<?php
					if (!empty($product->images[0])) {
						$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
					} else {
						$image = '';
					}
					echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));?>					 
				</div>
				
				<div class="clear"></div>
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
					<span class="vote"><?php echo JText::_('COM_VIRTUEMART_RATING') . ' ' . JText::_('COM_VIRTUEMART_UNRATED') ?></span>
					    <?php
					} else {
					    $ratingwidth = $rating->rating * 12; //I don't use round as percetntage with works perfect, as for me
					    ?>
					<span class="vote">
					    <span title=" <?php echo (JText::_("COM_VIRTUEMART_RATING_TITLE") . round($rating->rating) . '/' . $maxrating) ?>" class="ratingbox" style="display:inline-block;">
								<span class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>"></span>
					  	</span>
					  	<?php echo JText::_('COM_VIRTUEMART_RATING') . ' ' . round($rating->rating) . '/' . $maxrating; ?>
					</span>
					<?php
				    }
				}
				if ($show_price) {
					echo '<div class="product-price">'.$currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
					if ($product->prices['salesPriceWithDiscount'] > 0) {
						echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
					}
					echo '</div>';
				}
				if ($show_addtocart) {
					echo $helper->addtocart ($product);
				}
				?>
			</div>
		</div>
	<?php
endforeach; ?>
</div>
</div>