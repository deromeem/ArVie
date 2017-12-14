<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('17', $user->groups));		// sets flag when user group is '17' that is 'Annuaire' 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_ANNUAIRE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<script type="text/javascript">
		// fonction javascript pour gérer les actions sur les boutons
		Joomla.submitbutton = function(task)
		{
			// si bouton 'Annuler' ou si les champs du formulaire sont valides alors on envoie le formulaire
			if (task == 'entreprise.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
			{
				Joomla.submitform(task);
			}
		}
	</script>

	<div class="edit item-page">
		<form action="<?php echo JRoute::_('index.php?option=com_annuaire&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
			
			<div class="form-inline form-inline-header">
				<div class="btn-group pull-left">
					<?php $isNew = ($this->item->id == 0); ?>
					<h2><?php echo JText::_('COM_ANNUAIRE_ENTREPRISE')." ".($isNew ? JText::_('COM_ANNUAIRE_ADD_PAR'): JText::_('COM_ANNUAIRE_MODIF_PAR')); ?></h2>
				</div>
				<div class="btn-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn" onclick="Joomla.submitbutton('entreprise.cancel')">
							<span class="icon-cancel"></span>
						</button>
					</div>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary validate" onclick="Joomla.submitbutton('entreprise.save')">
							<span class="icon-ok"></span>
						</button>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>

			<fieldset>
				<ul class="nav nav-tabs">
					<li><a href="#entreprise" data-toggle="tab"><?php echo JText::_('COM_ANNUAIRE_ENTREPRISE'); ?></a></li>
					<li><a href="#avance" data-toggle="tab"><?php echo JText::_('COM_ANNUAIRE_ADVANCED'); ?></a></li>
					<li><a href="#commentaire" data-toggle="tab"><?php echo JText::_('COM_ANNUAIRE_COMMENT'); ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="entreprise">
						<table class="table">
							<tbody>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('nom'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('nom'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('logo'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('logo'); ?></div>
										<?php echo "<img src='" . JURI::root() . "images/annuaire/logos/" . $this->item->logo . "' border='0' />"; ?>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('activite'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('activite'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('codeAPE_NAF'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('codeAPE_NAF'); ?></div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane" id="avance">
						<table class="table">
							<tbody>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('pays_id'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('pays_id'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('numSIREN'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('numSIREN'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('numTVAintra'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('numTVAintra'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('siteWeb'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('siteWeb'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('adrRue'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('adrRue'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('adrVille'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('adrVille'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('adrCP'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('adrCP'); ?></div>
									</td>
								</tr>
							</tbody>
						</table>				

						<input type="hidden" name="task" value="" />
						<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
					</div>
					<div class="tab-pane" id="commentaire">
						<?php echo $this->form->getControlGroup('commentaire'); ?>
					</div>
					</div>
				<?php echo JHtml::_('form.token'); ?>
			</fieldset>
		</form>
	</div>

<?php endif; ?>
