<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelMetier_groupe_maps extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'mgm.id',
				'metier', 'mgm.metier',
				'groupe','mgm.groupe',
				'role','mgm.role',
				'published', 'mgm.published',
				'created','mgm.created',
				'modified', 'mgm.modified',
				'modified_by', 'mgm.modified_by',
				'hits', 'mgm.hits',
				'role_label','r.label',
				'metier_label','m.label',
				'groupe_nom','g.nom'
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
		$query->select('mgm.id, mgm.metier, mgm.groupe, mgm.published, mgm.created, mgm.modified, mgm.modified_by, mgm.hits');
		$query->from('#__arvie_metier_groupe_map mgm');

		// joint la table metier pour les prenoms
		$query->select('m.label AS metier_label')->join('LEFT', '#__arvie_metiers AS m ON mgm.metier=m.id');

		// joint la table groupe pour les nom de groupe
		$query->select('g.nom AS groupe_nom')->join('LEFT', '#__arvie_groupes AS g ON mgm.groupe=g.id');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('mgm.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'mgm.metier LIKE '.$search;
				$searches[]	= 'mgm.groupe LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('mgm.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(mgm.published=0 OR mgm.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','arvie_',$query));			// TEST/DEBUG
		return $query;
	}

}
