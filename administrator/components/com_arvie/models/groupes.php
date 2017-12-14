<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelGroupes extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'g.id',
				'nom', 'g.nom',
				'groupe_parent','g.groupe_parent',
				'created_by','g.created_by',
				'published', 'g.published',
				'est_groupe_interet','g.est_groupe_interet',
				'est_public','g.est_public',
				'hits', 'g.hits',
				'modified', 'g.modified',
				'parent_nom','gp.nom',
				'created_by_nom','u.name'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session groupe nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('modified', 'desc');
	}
	
	protected function getListQuery(){
	
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('g.id,g.groupe_parent, g.nom, g.est_groupe_interet, g.est_public, g.published, g.hits, g.modified,g.created_by');
		$query->from('#__arvie_groupes g');

		// joint la table parent pour les groupe_parents
		$query->select('gp.nom AS parent_nom')->join('LEFT', '#__arvie_groupes AS gp ON gp.id=g.groupe_parent');

		// joint la table #_users pour les created_by
		$query->select('u.name AS created_by_nom')->join('LEFT', '#__users AS u ON g.created_by=u.id');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('g.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'g.nom LIKE '.$search;
				$searches[]	= 'g.created_by LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('g.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(g.published=0 OR g.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','arvie_',$query));			// TEST/DEBUG
		return $query;
	}

}
