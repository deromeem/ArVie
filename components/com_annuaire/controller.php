<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false)
	{
		// affectation de la vue récupérée en paramètre
		$vName = $this->input->get('view', 'entreprises');
		$this->input->set('view', $vName);
		
		parent::display($cachable, false);
		return $this;
	}
}
