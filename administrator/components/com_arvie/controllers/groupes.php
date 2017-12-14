<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerGroupes extends JControllerAdmin
{
	// surcharge pour gérer la suppression de groupes par le modèle adéquat
	public function getModel($name = 'Groupe', $prefix = 'ArvieModel') 
	{
		// récupèrer le modèle de détail ($name au singulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
