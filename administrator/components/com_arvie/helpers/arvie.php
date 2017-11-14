<?php
defined('_JEXEC') or die;

class ArvieHelper extends JHelperContent
{
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('Abonnements'),
			'index.php?option=com_arvie&view=abonnements',
			$vName == 'abonnements'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Discussions'),
			'index.php?option=com_arvie&view=discussions',
			$vName == 'discussions'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Evénements'),
			'index.php?option=com_arvie&view=evenements',
			$vName == 'evenements'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Groupes'),
			'index.php?option=com_arvie&view=groupes',
			$vName == 'groupes'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Messages'),
			'index.php?option=com_arvie&view=messages',
			$vName == 'messages'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Parrains'),
			'index.php?option=com_arvie&view=parrains',
			$vName == 'groupes'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Publications'),
			'index.php?option=com_arvie&view=publications',
			$vName == 'publications'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Utilisateurs'),
			'index.php?option=com_arvie&view=utilisateurs',
			$vName == 'utilisateurs'
		);		
	}
}
