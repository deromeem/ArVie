<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'entreprise.cancel' || document.formvalidator.isValid(document.id('annuaire-form')))
		{
			<?php echo $this->form->getField('commentaire')->save(); ?>
			Joomla.submitform(task, document.getElementById('annuaire-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_annuaire&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="annuaire-form" class="form-validate">

	<div class="form-inline form-inline-header">
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('nom'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('nom'); ?></div>
		</div>					
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
		</div>					
	</div>					

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_ANNUAIRE_ENTREPRISE')); ?>
		<div class="row-fluid ">
			<div class="span9">
				<div class="form-vertical">
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('logo'); ?></div>
						</div>					
						<div class="span7">
							<div class="controls"><?php echo $this->form->getInput('logo'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('activite'); ?></div>
						</div>					
						<div class="span7">
							<div class="controls"><?php echo $this->form->getInput('activite'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('codeAPE_NAF'); ?></div>
						</div>					
						<div class="span7">
							<div class="controls"><?php echo $this->form->getInput('codeAPE_NAF'); ?></div>
						</div>					
					</div>					
				</div>
				<div class="form-vertical">
					<?php echo $this->form->getControlGroup('commentaire'); ?>
				</div>
			</div>
			<div class="span3">
				<?php echo "<img src='" . "../images/annuaire/logos/" . $this->item->logo . "' border='0' />"; ?>
				<?php echo "<br><br>"; ?>
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infos', JText::_('COM_ANNUAIRE_ADVANCED')); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="form-vertical">
				<div class="span6">
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('pays_id'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('pays_id'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('numSIREN'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('numSIREN'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('numTVAintra'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('numTVAintra'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('siteWeb'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('siteWeb'); ?></div>
						</div>					
					</div>					
				</div>
				<div class="span6">
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('adrRue'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('adrRue'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('adrVille'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('adrVille'); ?></div>
						</div>					
					</div>					
					<div class="control-group">
						<div class="span2">
							<div class="control-label"><?php echo $this->form->getLabel('adrCP'); ?></div>
						</div>					
						<div class="span4">
							<div class="controls"><?php echo $this->form->getInput('adrCP'); ?></div>
						</div>					
					</div>					
				</div>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
			</div>
		</div>
	
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
