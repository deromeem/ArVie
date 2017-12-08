<?php
defined('_JEXEC') or die('Restricted access');

class ArvieModelMetiers extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id' =>             'id',
				'label' =>        	'm.label',
				'alias' =>    		'm.alias',
				'published' =>      'm.published',
				'created' =>        'm.created',
				'created_by' =>     'm.created_by',
				'modified' =>       'm.modified',
				'modified_by' =>    'm.modified_by',
				'hits' =>           'm.hits'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session metier nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		//$etat = $this->getUserStateFromRequest($this->context.'.filter.entreprises', 'filter_entreprises', '');
		//$this->setState('filter.etat', $etat);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		parent::populateState('label', 'asc');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('m.id, m.label, m.alias, m.published, m.created, m.created_by, m.modified, m.modified_by, m.hits');
		$query->from('#__arvie_metiers m');
		
		// joint la table users
		/*$query->select('up.nom nom_parrain, up.prenom prenom_parrain')->join('INNER', '#__arvie_utilisateurs AS up ON p.parrain = up.id');
		$query->select('uf.nom nom_filleul, uf.prenom prenom_filleul')->join('INNER', '#__arvie_utilisateurs AS uf ON p.filleul = uf.id');*/


		// filtre de recherche rapide textuel
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'label:'
			if (stripos($search, 'label:') === 0) {
				$query->where('m.label = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'm.label LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('m.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publié et dépublié
			$query->where('(m.published=0 OR m.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','arvie_',$query));			// TEST/DEBUG
		return $query;
	}
}
