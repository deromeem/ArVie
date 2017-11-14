<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireViewContact extends JViewLegacy
{
	protected $item;
	
	function display($tpl = null) 
	{
		// initialise les variables
		$this->item = $this->get('Item');

		// affiche les erreurs
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		// affiche la vue
		parent::display($tpl);
	}
}
