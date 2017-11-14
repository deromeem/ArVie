<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireModelEntreprise extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_annuaire.entreprise';

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
			$query->select('e.id, e.nom, e.alias, e.logo, e.activite, e.codeAPE_NAF, e.numSIREN, e.numTVAintra, e.pays_id, e.siteWeb, e.adrRue, e.adrVille, e.adrCP, e.commentaire');
			$query->from('#__annuaire_entreprises e');

			// joint la table pays
			$query->select('p.pays AS pays')->join('LEFT', '#__annuaire_pays AS p ON p.id=e.pays_id');
		
			$query->where('e.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
