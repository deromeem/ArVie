<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelParrains extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id' =>             'p.id',
				'parrain' =>        'p.parrain',
				'nom_parrain' =>    'up.nom',
				'prenom_parrain' => 'up.prenom',
				'filleul' =>        'p.filleul',
				'nom_filleul' =>    'uf.nom',
				'prenom_filleul' => 'uf.prenom',
				'date_deb' =>       'p.date_deb',
				'date_fin' =>       'p.date_fin',
				'alias' =>          'p.alias',
				'published' =>      'p.published',
				'created' =>        'p.created',
				'created_by' =>     'p.created_by',
				'modified' =>       'p.modified',
				'modified_by' =>    'p.modified_by',
				'hits' =>           'p.hits'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session parrain nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		//$etat = $this->getUserStateFromRequest($this->context.'.filter.entreprises', 'filter_entreprises', '');
		//$this->setState('filter.etat', $etat);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('filleul', 'asc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('p.id, p.parrain, p.filleul, p.date_deb, p.date_fin, p.alias, p.published, p.created, p.created_by, p.modified, p.modified_by, p.hits');
		$query->from('#__arvie_parrains p');
		
		// joint la table users
		$query->select('up.nom nom_parrain, up.prenom prenom_parrain')->join('INNER', '#__arvie_utilisateurs AS up ON p.parrain = up.id');
		$query->select('uf.nom nom_filleul, uf.prenom prenom_filleul')->join('INNER', '#__arvie_utilisateurs AS uf ON p.filleul = uf.id');


		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'parrain:'
			if (stripos($search, 'parrain:') === 0) {
				$query->where('p.parrain = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'p.filleul LIKE '.$search;
				$searches[]	= 'p.date_fin LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('p.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(p.published=0 OR p.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'parrain');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}
