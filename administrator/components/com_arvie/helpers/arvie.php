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
			JText::_('Groupe_util_map'),
			'index.php?option=com_arvie&view=groupe_utilisateur_maps',
			$vName == 'groupe_utilisateur_maps'
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
			JText::_('Metier_groupe_map'),
			'index.php?option=com_arvie&view=metier_groupe_maps',
			$vName == 'metier_groupe_maps'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Metiers'),
			'index.php?option=com_arvie&view=metiers',
			$vName == 'metiers'
		);

		JHtmlSidebar::addEntry(
			JText::_('Parrains'),
			'index.php?option=com_arvie&view=parrains',
			$vName == 'parrains'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Publications'),
			'index.php?option=com_arvie&view=publications',
			$vName == 'publications'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('Roles'),
			'index.php?option=com_arvie&view=roles',
			$vName == 'roles'
		);

		JHtmlSidebar::addEntry(
			JText::_('Utilisateur_discu_map'),
			'index.php?option=com_arvie&view=utilisateur_discu_maps',
			$vName == 'utilisateur_discu_maps'
		);		

		JHtmlSidebar::addEntry(
			JText::_('Utilisateur_even_map'),
			'index.php?option=com_arvie&view=utilisateur_even_maps',
			$vName == 'utilisateur_even_maps'
		);		
		
		JHtmlSidebar::addEntry(
			JText::_('Utilisateurs'),
			'index.php?option=com_arvie&view=utilisateurs',
			$vName == 'utilisateurs'
		);		
				
		
	}
}
