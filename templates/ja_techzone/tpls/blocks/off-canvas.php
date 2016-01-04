<?php
/*
 * ------------------------------------------------------------------------
 * JA Techzone Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

// get params
$sitename  = $this->params->get('sitename');
$slogan    = $this->params->get('slogan', '');
$logotype  = $this->params->get('logotype', 'text');
$logoimage = $logotype == 'image' ? $this->params->get('logoimage', T3Path::getUrl('images/logo.png', '', true)) : '';
$logoimgsm = ($logotype == 'image' && $this->params->get('enable_logoimage_sm', 0)) ? $this->params->get('logoimage_sm', T3Path::getUrl('images/logo-sm.png', '', true)) : false;

if (!$sitename) {
  $sitename = JFactory::getConfig()->get('sitename');
}
?>
<?php
	if (!$this->getParam('addon_offcanvas_enable')) return ;
?>

<button class="btn btn-primary off-canvas-toggle <?php $this->_c('off-canvas') ?>" type="button" data-pos="left" data-nav="#t3-off-canvas" data-effect="<?php echo $this->getParam('addon_offcanvas_effect', 'off-canvas-effect-4') ?>">
  <span class="patty"></span>
</button>

<!-- OFF-CANVAS SIDEBAR -->
<div id="t3-off-canvas" class="t3-off-canvas <?php $this->_c('off-canvas') ?>" style="right: -340px;">

  <div class="t3-off-canvas-header">
    <div class="logo-<?php echo $logotype, ($logoimgsm ? ' logo-control' : '') ?>">
      <a href="<?php echo JURI::base(true) ?>" title="<?php echo strip_tags($sitename) ?>">
        <?php if($logotype == 'image'): ?>
          <img class="logo-img" src="<?php echo JURI::base(true) . '/' . $logoimage ?>" alt="<?php echo strip_tags($sitename) ?>" />
        <?php endif ?>
        <?php if($logoimgsm) : ?>
          <img class="logo-img-sm" src="<?php echo JURI::base(true) . '/' . $logoimgsm ?>" alt="<?php echo strip_tags($sitename) ?>" />
        <?php endif ?>
        <span><?php echo $sitename ?></span>
      </a>
      <small class="site-slogan"><?php echo $slogan ?></small>
    </div>
  </div>

  <div class="t3-off-canvas-body">
    <jdoc:include type="modules" name="<?php $this->_p('off-canvas') ?>" style="T3Xhtml" />
  </div>

</div>
<!-- //OFF-CANVAS SIDEBAR -->
