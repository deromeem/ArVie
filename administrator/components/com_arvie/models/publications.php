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
				'titre',          'p.titre',
				'parent',		  'p.publication_parent',
				'groupe',         'p.groupe',
				'groupes_nom',    'p.groupe',
				'auteur_nom',     'p.auteur',
				'texte',          'p.texte',
				'date_publi',     'p.date_publi',
				'public',         'p.public',
				'alias',          'p.alias',
				'published',      'p.published',
				'created',        'p.created',
				'created_by',     'p.created_by',
				'modified',       'p.modified',
				'modified_by',    'p.modified_by',
				'hits',           'p.hits'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session publication nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$etat = $this->getUserStateFromRequest($this->context.'.filter.publications', 'filter_publications', '');
		$this->setState('filter.etat', $etat);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		//parent::populateState('nom', 'asc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('p.id, p.titre, p.publication_parent, p.groupe, p.auteur, p.texte, p.published, p.created, p.created_by, p.modified, p.modified_by, p.hits');
		$query->from('#__arvie_publications p');
		
		// joint la table utilisateur pour les auteurs
		$query->select('ap.prenom AS auteur_prenom')->join('LEFT', '#__arvie_utilisateurs AS ap ON ap.id=p.auteur');
		
		// joint la table groupes pour les groupes
		$query->select('pp.nom AS groupes_nom')->join('LEFT', '#__arvie_groupes AS pp ON pp.id=p.groupe');

		// joint la table publication pour les parent
		$query->select('p.id AS parent_id')->join('LEFT', '#__arvie_publications AS op ON p.id=op.publication_parent');

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
				$searches[]	= 'p.parent LIKE '.$search;
				$searches[]	= 'p.groupe LIKE '.$search;
				//$searches[]	= 'u.fonction LIKE '.$search;
				$searches[]	= 'p.auteur LIKE '.$search;
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
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}
}
