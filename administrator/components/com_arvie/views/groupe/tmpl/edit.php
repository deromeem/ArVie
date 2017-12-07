<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'groupe.cancel' || document.formvalidator.isValid(document.id('arvie-form')))
		{
			Joomla.submitform(task, document.getElementById('arvie-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_arvie&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="arvie-form" class="form-validate">

	<div class="form-inline form-inline-header">
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('nom'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('nom'); ?></div>

			<div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
		</div>					
	</div>
		
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_ARVIE_GROUPE')); ?>
		
		<div class="control-group">
			<div class="span3">
				<div class="control-label"><?php echo $this->form->getLabel('groupe_parent'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('groupe_parent'); ?></div>
			</div>
		</div>

		<div class="control-group">
			<div class="span3">
				<div class="control-label"><?php echo $this->form->getLabel('est_groupe_interet'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('est_groupe_interet'); ?></div>
			</div>
		</div>

		<div class="control-group">
			<div class="span3">
				<div class="control-label"><?php echo $this->form->getLabel('est_public'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('est_public'); ?></div>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
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
