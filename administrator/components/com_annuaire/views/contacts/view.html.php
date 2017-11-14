<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireViewContacts extends JViewLegacy
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
		$params = JComponentHelper::getParams('com_annuaire');
		$this->paramDescShow = $params->get('jannuaire_show_desc', 0);
		$this->paramDescSize = $params->get('jannuaire_size_desc', 70);
		$this->paramDateFmt = $params->get('jannuaire_date_fmt', "d F Y");

		// affiche les erreurs éventuellement retournées
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// ajoute la toolbar contenant les boutons d'actions
		$this->addToolBar();
		// invoque la méthode addSubmenu du fichier de soutien (helper)
		EntrepriseHelper::addSubmenu('contacts');
		// prépare et affiche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		JToolBarHelper::title(JText::_('COM_ANNUAIRE_OPTIONS')." : ".JText::_('COM_ANNUAIRE_CONTACTS'));
		
		// affiche les boutons d'action
		// JToolBarHelper::addNew('contact.add', 'Nouveau contact');
		JToolBarHelper::addNew('contact.add');
		// JToolBarHelper::editList('contact.edit', 'Modifier contact');
		JToolBarHelper::editList('contact.edit');
		// JToolBarHelper::deleteList('Etes vous sur ?', 'entreprises.delete', 'Supprimer entreprises');
		JToolBarHelper::deleteList('Etes vous sur ?', 'contacts.delete');
		
		JToolbarHelper::publish('contacts.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('contacts.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('contacts.archive');
		JToolbarHelper::checkin('contacts.checkin');
		JToolbarHelper::trash('contacts.trash');
		JToolbarHelper::preferences('com_annuaire');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_annuaire');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);

		// ajoute le filtre spécifique pour les types de contacts
		$this->typescontacts = $this->get('Typescontacts');
		$options3	= array();
		foreach ($this->typescontacts as $typecontact) {
			$options3[]	= JHtml::_('select.option', $typecontact->id,  $typecontact->typeContact);
		}
		$this->typecontact = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_ANNUAIRE_TYPESCONTACTS_SELECT')." -", 'filter_typecontact',
			JHtml::_('select.options', $this->typecontact,
			'value', 'text', $this->state->get('filter.typecontact'))
		);

		// ajoute le filtre spécifique pour les entreprises
		$this->entreprises = $this->get('Entreprises');
		$options3	= array();
		foreach ($this->entreprises as $entreprise) {
			$options3[]	= JHtml::_('select.option', $entreprise->id,  $entreprise->nom);
		}
		$this->entreprise = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_ANNUAIRE_ENTREPRISES_SELECT')." -", 'filter_entreprise',
			JHtml::_('select.options', $this->entreprise,
			'value', 'text', $this->state->get('filter.entreprise'))
		);
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'c.nom' => JText::_('COM_ANNUAIRE_CONTACTS_NOM'),
			'c.prenom' => JText::_('COM_ANNUAIRE_CONTACTS_PRENOM'),
			'c.published' => JText::_('JSTATUS'),
			'c.modified' => JText::_('JDATE'),
			'c.id' => "Id"
		);
	}  
	
}
