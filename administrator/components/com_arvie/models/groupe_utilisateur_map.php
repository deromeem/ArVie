<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelGroupe_utilisateur_map extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'gum.id',
				'utilisateur', 'gum.utilisateur',
				'groupe','gum.groupe',
				'date_deb','gum.date_deb',
				'date_fin','gum.date_fin',
				'role','gum.role',
				'published', 'gum.published',
				'created','gum.created',
				'modified', 'gum.modified',
				'modified_by', 'gum.modified_by',
				'hits', 'gum.hits'
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
		$query->select('gum.id, gum.utilisateur, gum.groupe, gum.date_deb, gum.date_fin, gum.role, gum.published, gum.created, gum.modified, gum.modified_by, gum.hits');
		$query->from('#__arvie_groupe_utilisateur_map gum');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('gum.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'gum.nom LIKE '.$search;
				$searches[]	= 'gum.created_by LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('gum.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(gum.published=0 OR gum.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','arvie_',$query));			// TEST/DEBUG
		return $query;
	}

}
