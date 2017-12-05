<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelMessages extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'c.id',
				'auteur', 'c.auteur',
				'discussion', 'c.discussion',
				'contenu', 'c.contenu',
				'alias', 'c.contact_id',
				'created', 'c.created_id',
				'created_by', 'c.created_by',
				'published', 'c.published',
				'hits', 'c.hits',
				'modified', 'c.modified'
				'modified_by', 'c.modified_by'
				);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$alias = $this->getUserStateFromRequest($this->context.'.filter.alias', 'filter_alias', '');
		$this->setState('filter.alias', $alias);

		$created = $this->getUserStateFromRequest($this->context.'.filter.created', 'filter_created', '');
		$this->setState('filter.created', $created);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// parent::populateState('modified', 'desc');
		parent::populateState('c.nom', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('c.id, c.nom, c.discussion, c.civilites_id, c.typescontacts_id, c.createds_id, c.contenu, c.created_by, c.mobile, c.tel, c.published, c.hits, c.modified');
		$query->from('#__annuaire_contacts c');

		// joint la table civilites
		$query->select('m.civilite AS civilite')->join('LEFT', '#__annuaire_civilites AS m ON m.id=c.civilites_id');

		// joint la table typescontacts
		$query->select('t.alias AS alias')->join('LEFT', '#__annuaire_typescontacts AS t ON t.id=c.typescontacts_id');

		// joint la table createds
		$query->select('e.nom AS created')->join('LEFT', '#__annuaire_createds AS e ON e.id=c.createds_id');

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
				$searches[]	= 'c.discussion LIKE '.$search;
				$searches[]	= 't.alias LIKE '.$search;
				$searches[]	= 'e.nom LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_alias'
		$alias = $this->getState('filter.alias');
		if (is_numeric($alias)) {
			$query->where('c.typescontacts_id=' . (int) $alias);
		}
		// filtre selon l'état du filtre 'filter_created'
		$created = $this->getState('filter.created');
		if (is_numeric($created)) {
			$query->where('c.createds_id=' . (int) $created);
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
		$query->select('id, alias');
		$query->from('#__annuaire_typescontacts');
		$query->where('published=1');
		$query->order('alias ASC');
		$this->_db->setQuery($query);
		$createds = $this->_db->loadObjectList();
		return $createds;
	}	

	public function getcreateds()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, nom');
		$query->from('#__annuaire_createds');
		$query->where('published=1');
		$query->order('nom ASC');
		$this->_db->setQuery($query);
		$createds = $this->_db->loadObjectList();
		return $createds;
	}	
}
