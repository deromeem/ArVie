<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieModelGroupe extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_arvie.groupe';

	protected function populateState()
	{
		$app = JFactory::getApplication('site');
		
		// Charge et mémorise l'état (state) de l'id depuis le contexte
		$pk = $app->input->getInt('id');
		$this->setState($this->_context.'.id', $pk);
		// $this->setState('groupe.id', $pk);
	}

	public function getItem($pk = null)
	{
		// Initialise l'id
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->_context.'.id');

		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('g.id, g.nom, g.alias, g.est_public, g.est_groupe_interet, g.groupe_parent');
			$query->from('#__arvie_groupes g');

			// joint la table parent pour recuperer nom du groupe_parent
			$query->select('gp.nom AS groupe_parent_nom')->join('LEFT', '#__arvie_groupes AS gp ON gp.id=g.groupe_parent');
		
			$query->where('g.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
