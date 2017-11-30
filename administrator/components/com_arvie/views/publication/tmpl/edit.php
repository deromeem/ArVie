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

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
	</div>


	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'publication')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publication', JText::_('COM_ARVIE_PUBLICATION')); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="form-vertical">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('texte'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('texte'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('date_publi'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('date_publi'); ?></div>
				</div>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
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