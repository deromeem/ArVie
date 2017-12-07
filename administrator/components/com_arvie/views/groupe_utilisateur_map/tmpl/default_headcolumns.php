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
                <?php echo JHtml::_('grid.sort', 'id', 'gum.id', $listDirn, $listOrder) ?>
        </th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'Utilisateur', 'gum.utilisateur', $listDirn, $listOrder) ?>
        </th>
        </th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'Role', 'gum.role', $listDirn, $listOrder) ?>
        </th>
        </th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'Groupe', 'gum.groupe', $listDirn, $listOrder) ?>
        </th></th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'Date Debut', 'gum.date_deb', $listDirn, $listOrder) ?>
        </th>
        </th>
        <th width="2%">
                <?php echo JHtml::_('grid.sort', 'Date Fin', 'gum.date_fin', $listDirn, $listOrder) ?>
        </th>

        <th width="1%" style="min-width:55px" class="">
                <?php echo JHtml::_('grid.sort', 'Publié', 'gum.published', $listDirn, $listOrder) ?>
        </th>
		<th width="1%">
			<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'gum.hits', $listDirn, $listOrder); ?>
		</th>
		
	</tr>

