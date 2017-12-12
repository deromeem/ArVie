<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('17', $user->groups));		// sets flag when user group is '17' that is 'Annuaire' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ARVIE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="form-inline form-inline-header">
		<div class="btn-group pull-left">
			<h2><?php echo JText::_('COM_ARVIE_ABONNEMENT'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_arvie&view=abonnements'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_arvie&view=form_a&layout=edit&id='.$this->item->id); ?>" class="btn" role="button"><span class="icon-edit"></span></a>
		</div>	
	</div>
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_ABONNEMENTS_ABONNE'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->nom ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_ABONNEMENTS_SUIVI'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->prenom ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_ABONNEMENTS_DATE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->civilite ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_ABONNEMENTS_ALIAS'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->typecontact ?>
					</td>
				</tr>
				<tr>

<!-- 					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_ABONNEMENTS_UTILISATEURS'); ?></span>
					</td>
					<td width="80%">
						<a href="<?php echo JRoute::_('index.php?option=com_arvie&view=utilisateur&id='.(int) $this->item->entreprises_id); ?>"><?php echo $this->item->entreprise ?></a>
					</td>
				</tr> -->
		
					<td width="80%">
						<?php echo $this->item->commentaire ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif; ?>
