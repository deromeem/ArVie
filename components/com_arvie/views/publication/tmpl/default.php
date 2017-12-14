<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('13', $user->groups));		// sets flag when user group is '13' that is 'Agent' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ARVIE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="form-inline form-inline-header">
		<div class="btn-group pull-left">
			<h2><?php echo JText::_('COM_ARVIE_PUBLICATION'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_arvie&view=publications'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_arvie&view=form&layout=edit&id='.$this->item->id); ?>" class="btn" role="button">
				<span class="icon-edit"></span></a>
		</div>	
	</div>	
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_ID'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->id ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_PARENT'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->parent ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_GROUPE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->groupe ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_AUTEUR'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->auteur_prenom ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_TITRE'); ?></span>
					</td>
					<td width="80%">						
							<?php echo $this->item->titre; ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_TEXTE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->texte ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ARVIE_PUBLICATIONS_ESTPUBLIC'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->estPublic ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif; ?>
