<?php
defined('_JEXEC') or die;

class EntrepriseHelper extends JHelperContent
{
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('Entreprises'),
			'index.php?option=com_annuaire&view=entreprises',
			$vName == 'entreprises'
		);

		JHtmlSidebar::addEntry(
			JText::_('Contacts'),
			'index.php?option=com_annuaire&view=contacts',
			$vName == 'contacts'
		);
	}
}
