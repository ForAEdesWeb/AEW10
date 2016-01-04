<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2LoginBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" name="login">
		<?php if($params->get('pretext')): ?>
		<p class="preText"><?php echo $params->get('pretext'); ?></p>
	  <?php endif; ?>

	  <fieldset>
	    <div id="form-login-username" class="form-group">
	      <label for="modlgn_username"><?php echo JText::_('K2_USERNAME') ?></label>
	      <input id="modlgn_username" type="text" name="username" class="inputbox form-control" size="18" />
	    </div>
	    <div id="form-login-password" class="form-group">
	      <label for="modlgn_passwd"><?php echo JText::_('K2_PASSWORD') ?></label>
	      <input id="modlgn_passwd" type="password" name="<?php echo $passwordFieldName; ?>" class="inputbox form-control" size="18" />
	    </div>
	    <?php if(JPluginHelper::isEnabled('system', 'remember')): ?>
	    <div class="form-group">
	    	<p id="form-login-remember">
		      <label for="modlgn_remember" class="checkbox-inline">
		      	<input id="modlgn_remember" type="checkbox" name="remember" class="inputbox" value="yes" />
		      	<?php echo JText::_('K2_REMEMBER_ME') ?>
		      </label>
		    </p>
	    </div>
	    <?php endif; ?>

	    <div class="form-group">
	    	<input type="submit" name="Submit" class=" btn btn-primary" value="<?php echo JText::_('K2_LOGIN') ?>" />
	    </div>
	  </fieldset>

	  <ul>
	    <li><a href="<?php echo $resetLink; ?>"><?php echo JText::_('K2_FORGOT_YOUR_PASSWORD'); ?></a></li>
	    <li><a href="<?php echo $remindLink ?>"><?php echo JText::_('K2_FORGOT_YOUR_USERNAME'); ?></a></li>
	    <?php if ($usersConfig->get('allowUserRegistration')): ?>
	    <li><a href="<?php echo $registrationLink; ?>"><?php echo JText::_('K2_CREATE_AN_ACCOUNT'); ?></a></li>
	    <?php endif; ?>
	  </ul>

	  <?php if($params->get('posttext')): ?>
	  <p class="postText"><?php echo $params->get('posttext'); ?></p>
	  <?php endif; ?>

	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="hidden" name="task" value="<?php echo $task; ?>" />
	  <input type="hidden" name="return" value="<?php echo $return; ?>" />
	  <?php echo JHTML::_( 'form.token' ); ?>
	</form>
</div>
