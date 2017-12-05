<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'publication.cancel' || document.formvalidator.isValid(document.id('arvie-form')))
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
		</div>					
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
		</div>					
	</div>			


	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
			
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_ARVIE_PUBLICATION')); ?>
		<div class="row-fluid form-horizontal-desktop">

		<div class="span9">
				<div class="form-vertical">
					<div class="span2">
						<div class="control-label"><?php echo $this->form->getLabel('COM_ARVIE_PUBLICATION_PARENT'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('COM_ARVIE_PUBLICATION_PARENT'); ?></div>
					</div>
					<div class="span2">
						<div class="control-label"><?php echo $this->form->getLabel('COM_ARVIE_PUBLICATION_AUTEUR'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('COM_ARVIE_PUBLICATION_AUTEUR'); ?></div>
					</div>
					<div class="span2">
						<div class="control-label"><?php echo $this->form->getLabel('COM_ARVIE_PUBLICATION_GROUPE'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('COM_ARVIE_PUBLICATION_GROUPE'); ?></div>
					</div>
				</div>
			</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		</div>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="form-vertical">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>

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
