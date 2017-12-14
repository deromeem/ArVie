<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false)
	{
		// affectation de la vue récupérée en paramètre
<<<<<<< HEAD
		$vName = $this->input->get('view', 'publications');
=======
		$vName = $this->input->get('view', 'groupes');
>>>>>>> 1fce6d606733414dea9d6b5c0a3550dc4788b672
		$this->input->set('view', $vName);
		
		parent::display($cachable, false);
		return $this;
	}
}
