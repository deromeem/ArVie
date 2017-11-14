<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

	<tr>
        <th width="1%" class="hidden-phone">
                <?php echo JHtml::_('grid.checkall'); ?>
        </th>                   
        <th width="1%">
                <?php echo JHtml::_('grid.sort', 'COM_ARVIE_GROUPES_NOM', 'g.nom', $listDirn, $listOrder) ?>
        </th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'COM_ARVIE_GROUPES_PARENT', 'gp.nom', $listDirn, $listOrder) ?>
        </th>

        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'COM_ARVIE_GROUPES_CREE_PAR', 'u.name', $listDirn, $listOrder) ?>
        </th>

        <th width="1%" style="min-width:55px" class="">
                <?php echo JHtml::_('grid.sort', 'Publié', 'g.published', $listDirn, $listOrder) ?>
        </th>
        <th width="1%" style="min-width:100px" class="nowrap center">
                <?php echo JHtml::_('grid.sort', 'Date', 'g.modified', $listDirn, $listOrder) ?>
        </th>
		<th width="1%">
			<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'g.hits', $listDirn, $listOrder); ?>
		</th>
		<th width="1%" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'g.id', $listDirn, $listOrder); ?>
		</th>
	</tr>

