<?php // no direct access
defined('_JEXEC') or die('Restricted access');
vmJsApi::jQuery();
vmJsApi::chosenDropDowns();
?>

<div class="vm-curency">
  <!-- Currency Selector Module -->
  <?php echo $text_before ?>

  <form action="<?php echo vmURI::getCleanUrl() ?>" method="post">
    <?php echo JHTML::_('select.genericlist', $currencies, 'virtuemart_currency_id', 'class="inputbox vm-chzn-select"', 'virtuemart_currency_id', 'currency_txt', $virtuemart_currency_id) ; ?>
    <input class="button" type="submit" name="submit" value="<?php echo vmText::_('MOD_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES') ?>" />
  </form>
</div>
