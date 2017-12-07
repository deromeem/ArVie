<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<tr>
	<th width="1%" class="hidden-phone left">
		<?php echo JHtml::_('grid.checkall'); ?> 
	</th>
	<th width="1%">
		<?php echo JHtml::_('grid.sort', 'Label', 'm.label', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" style="min-width:55px" class="nowrap left ">
		<?php echo JHtml::_('grid.sort', 'Publié', 'm.published', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" style="min-width:120px" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Date', 'm.modified', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" class="center hidden-tablet hidden-phone">
		<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'm.hits', $listDirn, $listOrder); ?>
	</th>
	<th width="1%" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'm.id', $listDirn, $listOrder); ?>
	</th>
</tr>
