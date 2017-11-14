<?php
defined('_JEXEC') or die;

class GroupeHelper extends JHelperContent
{
	public static function addSubmenu($vName)
	{

		JHtmlSidebar::addEntry(
			JText::_('Groupes'),
			'index.php?option=com_arvie&view=groupes',
			$vName == 'groupe'
		);
	}
}
