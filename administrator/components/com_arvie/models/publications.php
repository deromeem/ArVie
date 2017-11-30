<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelPublications extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',             'p.id',
				'parent',         'p.parent',		
				'groupe',         'p.groupe',
				'auteur',         'p.auteur',
				'texte',          'p.texte',
				'date_publi',     'p.date_publi',
				'public',		  'p.public',
				'alias',          'p.alias',
				'published',      'p.published',
				'created',        'p.created',
				'created_by',     'p.created_by',
				'modified',       'p.modified',
				'modified_by',    'p.modified_by',
				'hits',           'p.hits',
				'idutilisateur',  'u.id',
				'idgroupe',       'g.id',
				
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session publication nécessaires au paramétrage de l'écran
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
		$query->select('p.id, p.parent, p.groupe, p.auteur, p.texte, p.date_publi, p.public, p.alias, p.published, p.created, p.created_by, p.modified, p.modified_by, p.hits');
		$query->from('#__arvie_publications p');
		
		// joint la table utilisateur
		$query->select('u.id as idutilisateur')->join('LEFT', '#__arvie_utilisateurs AS u ON u.id = p.auteur');

		// joint la table groupe
		$query->select('g.id as idgroupe')->join('LEFT', '#__arvie_groupes AS g ON g.id = p.groupe');

		


		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('p.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'p.auteur LIKE '.$search;
				$searches[]	= 'p.parent LIKE '.$search;
				//$searches[]	= 'u.fonction LIKE '.$search;
				$searches[]	= 'p.id LIKE '.$search;
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
			$query->where('(p.published=0 OR u.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}
