<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false)
	{
		// affectation de la vue récupérée en paramètre
<<<<<<< HEAD
		$vName = $this->input->get('view', 'abonnement');
=======
		$vName = $this->input->get('view', 'groupes');
>>>>>>> 563054317def4a64b6268bb159b7c9f226967430
		$this->input->set('view', $vName);
		
		parent::display($cachable, false);
		return $this;
	}
}
