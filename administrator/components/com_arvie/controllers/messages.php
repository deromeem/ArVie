<?php
defined('_JEXEC') or die('Restricted access');
 
<<<<<<< HEAD
class ArvieControllerMessages extends JControllerAdmin
{
	// surcharge pour gérer la suppression de utilisateurs par le modèle adéquat
	public function getModel($name = 'Message', $prefix = 'ArvieModel') 
	{
		// récupèrer le modèle de détail ($name au sigulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
=======
class ArvieControllerMessages extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Messages'));

                parent::display($cachable, $urlparams);
        }
}
>>>>>>> 0bf3845e736d9c0bac9a20277d5a8fc552c09648
