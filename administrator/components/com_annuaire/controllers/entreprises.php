<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireControllerEntreprises extends JControllerAdmin
{
	// surcharge pour gérer la suppression d'entreprises par le modèle adéquat
	public function getModel($name = 'Entreprise', $prefix = 'AnnuaireModel') 
	{
		// récupère le modèle de détail ($name au sigulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
