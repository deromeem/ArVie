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
                <?php echo JHtml::_('grid.sort', 'COM_ARVIE_ROLES_ID', 'r.id', $listDirn, $listOrder) ?>
        </th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'COM_ARVIE_ROLES_LABEL', 'r.label', $listDirn, $listOrder) ?>  
        </th>

        <th width="1%" style="min-width:55px" class="">
                <?php echo JHtml::_('grid.sort', 'Publié', 'r.published', $listDirn, $listOrder) ?>
        </th>
        <th width="1%" style="min-width:100px" class="nowrap center">
                <?php echo JHtml::_('grid.sort', 'Date', 'r.modified', $listDirn, $listOrder) ?>
        </th>
	<th width="1%">
		<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'r.hits', $listDirn, $listOrder); ?>
	</th>
	</tr>

