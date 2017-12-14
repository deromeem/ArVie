<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.framework'); 				// javascript Joomla object for grid.sort !

$user = JFactory::getUser();               		// gets current user object
<<<<<<< HEAD
$isAdmin = (in_array('17', $user->groups));		// sets flag when user group is '17' that is 'Annuaire' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ANNUAIRE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<h2><?php echo JText::_('COM_ANNUAIRE_OPTIONS')." : ".JText::_('COM_ANNUAIRE_ENTREPRISES')." - "; ?>
		<a href="<?php echo JRoute::_('index.php?option=com_annuaire&view=contacts'); ?>">
			<?php echo JText::_('COM_ANNUAIRE_CONTACTS'); ?>
		</a>
	</h2>

=======
//modifier le '17' en '10' pour passer des utilisateurs 'ANNUAIRE' a 'ARVIE'
$isAdmin = (in_array('17', $user->groups));		// sets flag when user group is '10' that is 'Arvie' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ARVIE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

>>>>>>> 1fce6d606733414dea9d6b5c0a3550dc4788b672
	<?php echo $this->loadTemplate('items'); ?>

	<?php echo $this->pagination->getListFooter(); ?>

<?php endif; ?>
