<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.view');
 
class AnnuaireViewContacts extends JViewLegacy
{
	protected $items;
	
	// surcharge de la methode display de la class JViewLegacy
	function display($tpl = null) 
	{
		// récupère la liste des items à afficher
		$this->items = $this->get('Items');
		// récupère l'objet jPagination correspondant à la liste
		$this->pagination = $this->get('Pagination');
		// récupère les informations contextuelles (des listes ou de l'utilisateur)
		$this->state = $this->get('State');

		// affiche les erreurs éventuellement retournées
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
}
