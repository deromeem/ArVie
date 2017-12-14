<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework'); 				// javascript Joomla object for grid.sort !

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('17', $user->groups));		// sets flag when user group is '17' that is 'Annuaire' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ARVIE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_ARVIE_OPTIONS')." : ".JText::_('COM_ARVIE_UTILISATEURS')." - "; ?>
		<a href="<?php echo JRoute::_('index.php?option=com_arvie&view=entreprises'); ?>">
			<?php echo JText::_('COM_ARVIE_ENTREPRISES'); ?>
		</a>
	</h2>

	<?php echo $this->loadTemplate('items'); ?>

	<?php echo $this->pagination->getListFooter(); ?>

<?php endif; ?>
