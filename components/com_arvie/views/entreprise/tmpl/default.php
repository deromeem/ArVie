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
			<h2><?php echo JText::_('COM_ANNUAIRE_ENTREPRISE'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_annuaire&view=entreprises'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_annuaire&view=form&layout=edit&id='.$this->item->id); ?>" class="btn" role="button">
				<span class="icon-edit"></span></a>
		</div>	
	</div>	
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_NOM'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->nom ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_LOGO'); ?></span>
					</td>
					<td width="80%">
						<?php echo "<img src='" . JURI::root() . "images/annuaire/logos/" . $this->item->logo . "' border='0' />"; ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_ACTIVITE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->activite ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_CODEAPE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->codeAPE_NAF ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_SITEWEB'); ?></span>
					</td>
					<td width="80%">
						<a href="http://<?php echo $this->item->siteWeb; ?>" target="_blank">
							<?php echo $this->item->siteWeb; ?>
						</a>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_NUMSIREN'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->numSIREN ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_NUMTVAINTRA'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->numTVAintra ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_ADR_RUE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->adrRue ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_ADR_VILLE'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->adrVille ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_ADR_CP'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->adrCP ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISES_ADR_PAYS'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->pays ?>
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
