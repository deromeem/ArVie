<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerMetiers extends JControllerAdmin
{
	// surcharge pour gérer la suppression de métiers par le modèle adéquat
	public function getModel($name = 'Metier', $prefix = 'ArvieModel') 
	{
		// récupèrer le modèle de détail ($name au sigulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
