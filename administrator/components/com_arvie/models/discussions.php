<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelDiscussions extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',             'd.id',
				'nom',            'd.nom',
				'nb_utilisateurs','nb_utilisateurs',
				'published',      'd.published',
				'created',        'd.created',
				'created_by',     'd.created_by',
				'modified',       'd.modified',
				'modified_by',    'd.modified_by',
				'hits',           'd.hits'
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
		$query->select('d.id, d.nom, d.published, d.created, d.created_by, d.modified, d.modified_by, d.hits');
		$query->from('#__arvie_discussions d');
		
		
		//joint entre la table #__arvie_utilisateur_discu_map
		$query->select('COUNT(*) AS nb_utilisateurs')->join('LEFT','#__arvie_utilisateur_discu_map AS ud ON ud.discussion = d.id');
		$query->group('d.id');

		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('d.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'd.nom LIKE '.$search;

				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('d.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(d.published=0 OR d.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','arvie_',$query));			// TEST/DEBUG
		return $query;
	}

}
