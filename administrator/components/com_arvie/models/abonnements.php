<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelAbonnements extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'abonne',       'a.abonne',
				'suivi',        'a.suivi',
				'nabonne',       'ua.nom',
				'nsuivi',        'us.nom',
				'date',         'a.date',
				'alias',		'a.alias',
				'published',      'a.published',
				'created',        'a.created',
				'created_by',     'a.created_by',
				'modified',       'a.modified',
				'modified_by',    'a.modified_by',
				'hits',           'a.hits'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session abonnement nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		//$etat = $this->getUserStateFromRequest($this->context.'.filter.entreprises', 'filter_entreprises', '');
		//$this->setState('filter.etat', $etat);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('abonne', 'asc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('a.id, a.abonne, a.suivi, a.date, a.alias, a.published, a.created, a.created_by, a.modified, a.modified_by, a.hits');
		$query->from('#__arvie_abonnements a');
		
		// joint la table users
		//$query->select('ju.password')->join('LEFT', '#__users AS ju ON u.email = ju.email');
		$query->select('ua.nom as nabonne')->join('LEFT', '#__arvie_utilisateurs AS ua ON a.abonne = ua.id');
		$query->select('us.nom as nsuivi')->join('LEFT', '#__arvie_utilisateurs AS us ON a.suivi = us.id');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('a.abonne = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'a.abonne LIKE '.$search;
				$searches[]	= 'a.suivi LIKE '.$search;
				//$searches[]	= 'u.fonction LIKE '.$search;
				//$searches[]	= 'u.email LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('a.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(a.published=0 OR a.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}
