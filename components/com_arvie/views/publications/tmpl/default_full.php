<?php
defined('_JEXEC') or die('Restricted access');
?>

<h1>Entreprises de l'annuaire</h1>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">

	<table class="category">
		<thead>
			<tr>
			<th class="title">Titre</th>
			<th class="title">Publié</th>
			<th class="title">Date</th>
		</tr>
		</thead>

		<tbody>
			<?php foreach($this->tickets as $i => $item) : ?>
			<tr>
				<td><?php echo $item->title ?></td>
				<td><?php echo $item->published ?></td>
				<td><?php echo $item->created ?></td>
			</tr>			
			<?php endforeach; ?>
		</tbody>
	</table>

</form>

<?php echo $this->pagination->getListFooter(); ?>
