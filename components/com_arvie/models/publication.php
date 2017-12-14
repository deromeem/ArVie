<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieModelPublication extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_arvie.publication';

	protected function populateState()
	{
		$app = JFactory::getApplication('site');
		
		// Charge et mémorise l'état (state) de l'id depuis le contexte
		$pk = $app->input->getInt('id');
		$this->setState($this->_context.'.id', $pk);
		// $this->setState('entreprise.id', $pk);
	}

	public function getItem($pk = null)
	{
		// Initialise l'id
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->_context.'.id');

		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('p.id, p.publication_parent, p.groupe, p.auteur, p.titre, p.texte, p.date_publi, p.est_public, p.published, p.alias');
			$query->from('#__arvie_publications p');

			// joint la table utilisateur pour les auteurs
			$query->select('ap.prenom AS auteur_prenom')->join('LEFT', '#__arvie_utilisateurs AS ap ON ap.id=p.auteur');
		
			// joint la table groupes pour les groupes
			$query->select('pp.nom AS groupes_nom')->join('LEFT', '#__arvie_groupes AS pp ON pp.id=p.groupe');

			// joint la table publication pour les parent
			$query->select('p.id AS parent_id')->join('LEFT', '#__arvie_publications AS op ON p.id=op.publication_parent');

			$query->where('p.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
