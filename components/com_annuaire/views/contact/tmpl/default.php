<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('17', $user->groups));		// sets flag when user group is '17' that is 'Annuaire' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ANNUAIRE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="form-inline form-inline-header">
		<div class="btn-group pull-left">
			<h2><?php echo JText::_('COM_ANNUAIRE_CONTACT'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_annuaire&view=contacts'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_annuaire&view=form_c&layout=edit&id='.$this->item->id); ?>" class="btn" role="button"><span class="icon-edit"></span></a>
		</div>	
	</div>
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_NOM'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->nom ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_PRENOM'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->prenom ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_CIVILITE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->civilite ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_TYPECONTACT'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->typecontact ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_ENTREPRISE'); ?></span>
					</td>
					<td width="80%">
						<a href="<?php echo JRoute::_('index.php?option=com_annuaire&view=entreprise&id='.(int) $this->item->entreprises_id); ?>"><?php echo $this->item->entreprise ?></a>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_FONCTION'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->fonction; ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_EMAIL'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->email ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_MOBILE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->mobile ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_CONTACTS_TEL'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->tel ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_COMMENT'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->commentaire ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif; ?>
