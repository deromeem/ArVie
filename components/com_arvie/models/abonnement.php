<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieModelAbonnement extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_arvie.abonnement';

	protected function populateState()
	{
		$app = JFactory::getApplication('site');
		
		// Charge et mémorise l'état (state) de l'id depuis le contexte
		$pk = $app->input->getInt('id');
		$this->setState($this->_context.'.id', $pk);
		// $this->setState('contact.id', $pk);
	}

	public function getItem($pk = null)
	{
		// Initialise l'id
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->_context.'.id');

		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('a.id, a.abonne, a.suivi, a.date, a.alias');
			$query->from('#__arvie_abonnements AS a');

			// joint la table utilisateurs pour l'abonné
			$query->select('u.utilisateur AS utilisateur')->join('LEFT', '#__arvie_abonnements AS a ON a.abonne=u.nom');
			// joint la table utilisateurs pour le suivi
			$query->select('u.utilisateur AS utilisateur')->join('LEFT', '#__arvie_abonnements AS a ON a.suivi=u.nom');

			$query->where('a.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
