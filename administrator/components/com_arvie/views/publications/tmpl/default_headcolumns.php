<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<tr>
	<th width="2%" class="hidden-phone">
		<?php echo JHtml::_('grid.checkall'); ?> 
	</th>
	<th width="2%">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_PUBLICATIONS_ID', 'p.id', $listDirn, $listOrder) ?>
	</th>
	<th width="2%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_PUBLICATIONS_PARENT', 'p.parent', $listDirn, $listOrder) ?>
	</th>
	<th width="2%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_PUBLICATIONS_GROUPE', 'p.groupe', $listDirn, $listOrder) ?>
	</th>
	<th width="2%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_PUBLICATIONS_AUTEUR', 'p.auteur', $listDirn, $listOrder) ?>
	</th>
	<th width="5%" class="nowrap">
		<?php echo JHtml::_('grid.sort', 'COM_ARVIE_PUBLICATIONS_TEXTE', 'p.texte', $listDirn, $listOrder) ?>
	</th>
	<th width="5%" style="min-width:55px" class="nowrap center hidden-phone">
	<?php echo JHtml::_('grid.sort', 'Publié', 'p.published', $listDirn, $listOrder) ?>
</th>
<th width="10%" style="min-width:120px" class="nowrap center hidden-tablet hidden-phone">
	<?php echo JHtml::_('grid.sort', 'Date', 'p.modified', $listDirn, $listOrder) ?>
</th>
<th width="5%" class="nowrap center hidden-tablet hidden-phone">
	<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'p.hits', $listDirn, $listOrder); ?>
</th>
</tr>

