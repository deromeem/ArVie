<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireModelContact extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_annuaire.contact';

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
			$query->select('c.id, c.nom, c.prenom, c.civilites_id, c.typescontacts_id, c.entreprises_id, c.fonction, c.email, c.mobile, c.tel, c.commentaire');
			$query->from('#__annuaire_contacts AS c');

			// joint la table civilites
			$query->select('m.civilite AS civilite')->join('LEFT', '#__annuaire_civilites AS m ON m.id=c.civilites_id');

			// joint la table typescontacts
			$query->select('t.typeContact AS typecontact')->join('LEFT', '#__annuaire_typescontacts AS t ON t.id=c.typescontacts_id');

			// joint la table entreprises
			$query->select('e.nom AS entreprise')->join('LEFT', '#__annuaire_entreprises AS e ON e.id=c.entreprises_id');		
					
			$query->where('c.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
