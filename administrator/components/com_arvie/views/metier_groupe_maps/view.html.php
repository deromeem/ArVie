<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieViewMetier_groupe_maps extends JViewLegacy
{
	function display($tpl = null) 
	{
		// récupère la liste des items à afficher
		$this->items = $this->get('Items');
		// récupère l'objet jPagination correspondant à la liste
		$this->pagination = $this->get('Pagination');

		// récupère l'état des information de tri des colonnes
		$this->state = $this->get('State');
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn	= $this->escape($this->state->get('list.direction'));			

		// récupère les paramêtres du fichier de configuration config.xml
		$params = JComponentHelper::getParams('com_arvie');
		$this->paramDescShow = $params->get('jarvie_show_desc', 0);
		$this->paramDescSize = $params->get('jarvie_size_desc', 70);
		$this->paramDateFmt = $params->get('jarvie_date_fmt', "d F Y");

		// affiche les erreurs éventuellement retournées
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// ajoute la toolbar contenant les boutons d'actions
		$this->addToolBar();
		// invoque la méthode addSubmenu du fichier de soutien (helper)
		ArvieHelper::addSubmenu('metier_groupe_maps');
		// prépare et affuche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		JToolBarHelper::title(JText::_('COM_ARVIE')." : ".JText::_('COM_ARVIE_METIER_GROUPE_MAP'));
		
		// affiche les boutons d'action
		JToolBarHelper::addNew('metier_groupe_map.add');
		JToolBarHelper::editList('metier_groupe_map.edit');
		JToolBarHelper::deleteList('Etes vous sûr ?', 'metier_groupe_maps.delete');
		JToolbarHelper::publish('metier_groupe_maps.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('metier_groupe_maps.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('metier_groupe_maps.archive');
		JToolbarHelper::checkin('metier_groupe_maps.checkin');
		JToolbarHelper::trash('metier_groupe_maps.trash');
		JToolbarHelper::preferences('com_arvie');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_arvie&view=metier_groupe_maps');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'up.nom' => JText::_('COM_ARVIE_PARRAINS_PARRAIN'),
			'uf.nom' => JText::_('COM_ARVIE_PARRAINS_FILLEUL'),
			'p.date_deb' => JText::_('COM_ARVIE_PARRAINS_DATE_DEB'),
			'p.date_fin' => JText::_('COM_ARVIE_PARRAINS_DATE_FIN'),
			'p.published' => JText::_('JSTATUS'),
			'p.id' => "ID"
		);
	}
}
