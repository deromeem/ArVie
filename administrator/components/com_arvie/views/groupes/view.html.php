<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieViewGroupes extends JViewLegacy
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
		ArvieHelper::addSubmenu('groupes');
		// prépare et affiche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		JToolBarHelper::title('Arvie : Groupes');
		
		// affiche les boutons d'action
		JToolBarHelper::addNew('groupe.add', 'Nouveau groupe');
		JToolBarHelper::editList('groupe.edit', 'Modifier groupe');
		JToolBarHelper::deleteList('Etes vous sur ?', 'groupes.delete', 'Supprimer groupes');
		JToolbarHelper::publish('groupes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('groupes.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('groupes.archive');
		JToolbarHelper::checkin('groupes.checkin');
		JToolbarHelper::trash('groupes.trash');
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
		foreach ($this->groupes as $groupe) {
			if($groupe->id==$currParent) return $groupe->nom;
		}
		return "N.C.";
	}

}
 