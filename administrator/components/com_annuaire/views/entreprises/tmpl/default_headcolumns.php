<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

	<tr>
        <th width="5%" class="hidden-phone">
			<?php echo JHtml::_('grid.checkall'); ?>
        </th>                   
        <th width="20%">
			<?php echo JHtml::_('grid.sort', 'COM_ANNUAIRE_ENTREPRISES_NOM', 'e.nom', $listDirn, $listOrder) ?>
        </th>
        <th width="35%" class="nowrap center">
			<?php echo JHtml::_('grid.sort', 'COM_ANNUAIRE_ENTREPRISES_LOGO', 'e.logo', $listDirn, $listOrder) ?>
        </th>
        <th width="10%">
			<?php echo JHtml::_('grid.sort', 'COM_ANNUAIRE_ENTREPRISES_CODEAPE', 'e.codeAPE_NAF', $listDirn, $listOrder) ?>
        </th>
        <th width="10%" class="nowrap hidden-phone">
			<?php echo JHtml::_('grid.sort', 'COM_ANNUAIRE_ENTREPRISES_SITEWEB', 'e.siteWeb', $listDirn, $listOrder) ?>
        </th>
        <th class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'COM_ANNUAIRE_ENTREPRISES_ADR_PAYS', 'pays', $listDirn, $listOrder) ?>
        </th>
        <th width="5%" style="min-width:55px" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'Publié', 'e.published', $listDirn, $listOrder) ?>
        </th>
        <th width="10%" style="min-width:120px" class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'Date', 'e.modified', $listDirn, $listOrder) ?>
        </th>
		<th width="5%" class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'e.hits', $listDirn, $listOrder); ?>
		</th>
		<th width="5%" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'e.id', $listDirn, $listOrder); ?>
		</th>
	</tr>

