<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<tr>
	<th width="1%" class="hidden-phone">
		<?php echo JHtml::_('grid.checkall'); ?> 
	</th>
	<th width="20%">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_METIER', 'up.nom', $listDirn, $listOrder) ?>
	</th>
	<th width="20%">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_GROUPE', 'uf.nom', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" style="min-width:55px" class="nowrap center ">
		<?php echo JHtml::_('grid.sort', 'Publié', 'p.published', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" style="min-width:120px" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Date', 'p.modified', $listDirn, $listOrder) ?>
	</th>
	<th width="10%" class="center hidden-tablet hidden-phone">
		<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'p.hits', $listDirn, $listOrder); ?>
	</th>
	<th width="1%" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'p.id', $listDirn, $listOrder); ?>
	</th>
</tr>

