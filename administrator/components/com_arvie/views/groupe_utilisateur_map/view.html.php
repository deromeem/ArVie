<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieViewGroupe_util_map extends JViewLegacy
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
		ArvieHelper::addSubmenu('groupe_util_map');
		// prépare et affiche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		JToolBarHelper::title('Arvie : Groupe_util_map');
		
		// affiche les boutons d'action
		JToolBarHelper::addNew('groupe_util_map.add', 'Nouveau groupe_util_map');
		JToolBarHelper::editList('groupe_util_map.edit', 'Modifier groupe_util_map');
		JToolBarHelper::deleteList('Etes vous sur ?', 'groupe_util_map.delete', 'Supprimer groupe_util_map');
		JToolbarHelper::publish('groupe_util_map.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('groupe_util_map.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('groupe_util_map.archive');
		JToolbarHelper::checkin('groupe_util_map.checkin');
		JToolbarHelper::trash('groupe_util_map.trash');
		JToolbarHelper::preferences('com_arvie');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_arvie');
		
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
			'g.published' => JText::_('JSTATUS'),
			'g.nom' => JText::_('COM_ARVIE_GROUPES_NOM'),
			'g.id' => 'ID',
			'gp.id' => JText::_('COM_ARVIE_GROUPES_PARENT'),
			'g.created_by' => JText::_('COM_ARVIE_GROUPES_CREE_PAR'),
		);
	}

	protected function displayParent($currParent) 
	{
		foreach ($this->groupe_util_map as $groupe_util_map) {
			if($groupe_util_map->id==$currParent) return $groupe_util_map->nom;
		}
		return "N.C.";
	}

}
 