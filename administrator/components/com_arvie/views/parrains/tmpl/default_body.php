<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_arvie&task=parrains.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php foreach($this->items as $i => $item): ?>
<tr class="row<?php echo $i % 2; ?>">
	<td class="center hidden-phone">
		<?php echo JHtml::_('grid.id', $i, $item->id); ?>
	</td>
	<td class="wrap has-context">
		<div class="pull-left">
			<a href="<?php echo JRoute::_('index.php?option=com_arvie&task=parrain.edit&id='.(int) $item->id); ?>">
				<?= $this->escape($item->nom_parrain) ?> <?= $item->prenom_parrain ?>
			</a>
			<div class="small hidden-phone">
				<?php // extrait description selon les paramètres de configuration
				if ($this->paramDescShow) {
					$desc = JFilterOutput::cleanText($item->activite);
					echo substr($desc, 0, $this->paramDescSize);
					echo (strlen($desc)>$this->paramDescSize?"...":"") ;
				}
				?>
			</div>
		</div>
	</td>
	<td align="small">
		<?= $item->nom_filleul ?> <?= $item->prenom_filleul ?>
	</td>
	</td>
	<td align="small">
		<?php echo $item->date_deb; ?>
	</td>
	<td align="small">
		<?php echo $item->date_fin; ?>
	</td>
	<td align="center">
		<?php echo JHtml::_('jgrid.published', $item->published, $i, 'parrains.', true); ?>
	</td>
	<td class="center hidden-phone">
		<?php echo JHtml::_('date', $item->modified, $this->paramDateFmt); ?>
	</td>
	<td class="center hidden-tablet hidden-phone">
			<?php echo (int) $item->hits; ?>
	</td>
	<td class="center hidden-phone">
		<?php echo (int) $item->id; ?>
	</td>
</tr>
<?php endforeach; ?>
