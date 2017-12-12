<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelEvenements extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',              'e.id',
				'titre',           'p.titre',
				'texte',           'p.texte',
				'date_event',      'e.date_event',
				'lieu',            'e.lieu',
				'alias',           'e.alias',
				'published',       'e.published',
				'created',         'e.created',
				'created_by',      'e.created_by',
				'modified',        'e.modifed',
				'modified_by',     'e.modified_by',
				'hits',            'e.hits'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session evenement nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		//$etat = $this->getUserStateFromRequest($this->context.'.filter.entreprises', 'filter_entreprises', '');
		//$this->setState('filter.etat', $etat);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('id', 'asc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('e.id, e.date_event, e.lieu, e.alias, e.published, e.created, e.created_by, e.modified, e.modified_by, e.hits');
		$query->from('#__arvie_evenements e');
		
		// joint la table users
		$query->select('p.titre, p.texte')->join('INNER', '#__arvie_publications AS p ON e.id = p.id');
		

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('e.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'p.titre LIKE '.$search;
				$searches[]	= 'e.date_event LIKE '.$search;
				//$searches[]	= 'e.fonction LIKE '.$search;
				$searches[]	= 'e.email LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('e.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(e.published=0 OR e.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}
