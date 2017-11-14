<?php
defined('_JEXEC') or die('Restricted access');

class AnnuaireModelContacts extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'c.id',
				'nom', 'c.nom',
				'prenom', 'c.prenom',
				'fonction', 'c.fonction',
				'typecontact', 'c.contact_id',
				'entreprise', 'c.entreprise_id',
				'email', 'c.email',
				'published', 'c.published',
				'hits', 'c.hits',
				'modified', 'c.modified'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$typecontact = $this->getUserStateFromRequest($this->context.'.filter.typecontact', 'filter_typecontact', '');
		$this->setState('filter.typecontact', $typecontact);

		$entreprise = $this->getUserStateFromRequest($this->context.'.filter.entreprise', 'filter_entreprise', '');
		$this->setState('filter.entreprise', $entreprise);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// parent::populateState('modified', 'desc');
		parent::populateState('c.nom', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('c.id, c.nom, c.prenom, c.civilites_id, c.typescontacts_id, c.entreprises_id, c.fonction, c.email, c.mobile, c.tel, c.published, c.hits, c.modified');
		$query->from('#__annuaire_contacts c');

		// joint la table civilites
		$query->select('m.civilite AS civilite')->join('LEFT', '#__annuaire_civilites AS m ON m.id=c.civilites_id');

		// joint la table typescontacts
		$query->select('t.typeContact AS typecontact')->join('LEFT', '#__annuaire_typescontacts AS t ON t.id=c.typescontacts_id');

		// joint la table entreprises
		$query->select('e.nom AS entreprise')->join('LEFT', '#__annuaire_entreprises AS e ON e.id=c.entreprises_id');

		// joint la table _users de Joomla
		// $query->select('ul.name AS linked_user')->join('LEFT', '#__users AS ul ON ul.id=a.affected_to');

		// filtre de recherche rapide textuelle
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('c.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'c.nom LIKE '.$search;
				$searches[]	= 'c.prenom LIKE '.$search;
				$searches[]	= 't.typeContact LIKE '.$search;
				$searches[]	= 'e.nom LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_typecontact'
		$typecontact = $this->getState('filter.typecontact');
		if (is_numeric($typecontact)) {
			$query->where('c.typescontacts_id=' . (int) $typecontact);
		}
		// filtre selon l'état du filtre 'filter_entreprise'
		$entreprise = $this->getState('filter.entreprise');
		if (is_numeric($entreprise)) {
			$query->where('c.entreprises_id=' . (int) $entreprise);
		}
		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('c.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publiés et dépubliés
			$query->where('(c.published=0 OR c.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'c.nom');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}

	public function getTypescontacts()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, typeContact');
		$query->from('#__annuaire_typescontacts');
		$query->where('published=1');
		$query->order('typeContact ASC');
		$this->_db->setQuery($query);
		$entreprises = $this->_db->loadObjectList();
		return $entreprises;
	}	

	public function getEntreprises()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, nom');
		$query->from('#__annuaire_entreprises');
		$query->where('published=1');
		$query->order('nom ASC');
		$this->_db->setQuery($query);
		$entreprises = $this->_db->loadObjectList();
		return $entreprises;
	}	
}
