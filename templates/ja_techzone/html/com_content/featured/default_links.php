<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ol class="nav">
<?php foreach ($this->link_items as &$item) : ?>
	<li>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
			<?php echo $item->title; ?>
    </a>
    <div class="article-footer clearfix">
      <dl class="article-info muted">
        <dd class="modified">
          <i class="fa fa-clock-o"></i>
          <time datetime="<?php echo JHtml::_('date', $item->modified, 'c'); ?>" itemprop="dateModified">
            <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
          </time>
        </dd>
      </dl>
    </div>
	</li>
<?php endforeach; ?>
</ol>
