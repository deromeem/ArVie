<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelUtilisateurs extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',             'u.id',
				'nom',            'u.nom',
				'prenom',         'u.prenom',
				'email',          'u.email',
				'mobile',         'u.mobile',
				'password',       'ju.password',
				'published',      'u.published',
				'created',        'u.created',
				'created_by',     'u.created_by',
				'modified',       'u.modified',
				'modified_by',    'u.modified_by',
				'hits',           'u.hits'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		//$etat = $this->getUserStateFromRequest($this->context.'.filter.entreprises', 'filter_entreprises', '');
		//$this->setState('filter.etat', $etat);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('nom', 'asc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('u.id, u.nom, u.prenom, u.email, u.mobile, u.published, u.created, u.created_by, u.modified, u.modified_by, u.hits');
		$query->from('#__arvie_utilisateurs u');
		
		// joint la table users
		$query->select('ju.password')->join('LEFT', '#__users AS ju ON u.email = ju.email');


		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('u.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'u.nom LIKE '.$search;
				$searches[]	= 'u.prenom LIKE '.$search;
				//$searches[]	= 'u.fonction LIKE '.$search;
				$searches[]	= 'u.email LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('u.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(u.published=0 OR u.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}
