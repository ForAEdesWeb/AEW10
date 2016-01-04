<div class="acm-feature-intro">
	<div class="item">
    <?php if($helper->get('button-link') && !$helper->get('button')): ?>
    <a class="mask" href="<?php echo $helper->get('button-link') ?>" title="<?php echo $helper->get('title') ?>"></a>
    <?php endif; ?>  

    <?php if($helper->get('image')): ?>
      <img src="<?php echo $helper->get('image'); ?>" class="feature-intro-img" alt="<?php echo $helper->get('title') ?>">
    <?php endif; ?>

    <div class="feature-intro-content <?php echo $helper->get('content-position') ?> <?php echo $helper->get('acm-style') ?>">
      <?php if($helper->get('title')): ?>
        <h1 class="item-title"><?php echo $helper->get('title') ?></h1>
      <?php endif; ?>
      
			<?php if($helper->get('description')): ?>
				<p class="item-desc"><?php echo $helper->get('description') ?></p>
			<?php endif; ?>

      <?php if($helper->get('button')): ?>
        <a href="<?php echo $helper->get('button-link') ?>" class="feature-intro-btn btn btn-primary"><?php echo $helper->get('button') ?></a>
      <?php endif; ?>
    </div>
	</div>
</div>