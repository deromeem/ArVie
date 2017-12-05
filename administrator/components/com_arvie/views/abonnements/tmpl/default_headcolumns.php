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
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_ABONNEMENTS_ABONNE', 'a.abonne', $listDirn, $listOrder) ?>
	</th>
	<th width="15%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_ABONNEMENTS_SUIVI', 'a.suivi', $listDirn, $listOrder) ?>
	</th>
	<th width="20%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_ABONNEMENTS_DATE', 'a.date', $listDirn, $listOrder) ?>
	</th>
	<th width="20%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_ABONNEMENTS_ALIAS', 'a.alias', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" style="min-width:55px" class="nowrap center ">
		<?php echo JHtml::_('grid.sort', 'Publié', 'a.published', $listDirn, $listOrder) ?>
	</th>
	<th width="1%" style="min-width:120px" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Date', 'a.modified', $listDirn, $listOrder) ?>
	</th>
	<th width="10%" class="center hidden-tablet hidden-phone">
		<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?>
	</th>
</tr>

