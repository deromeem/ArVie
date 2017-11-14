<?php
defined('_JEXEC') or die('Restricted access');

class AnnuaireModelEntreprises extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'e.id',
				'nom', 'e.nom',
				'logo', 'e.logo',
				'codeAPE_NAF', 'e.codeAPE_NAF',
				'pays', 'e.pays',
				'siteWeb', 'e.siteWeb',
				'published', 'e.published',
				'hits', 'e.hits',
				'modified', 'e.modified'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$codeAPE_NAF = $this->getUserStateFromRequest($this->context.'.filter.codeAPE_NAF', 'filter_codeAPE_NAF', '');
		$this->setState('filter.codeAPE_NAF', $codeAPE_NAF);

		$pay = $this->getUserStateFromRequest($this->context.'.filter.pay', 'filter_pay', '');
		$this->setState('filter.pay', $pay);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// parent::populateState('modified', 'desc');
		parent::populateState('e.nom', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('e.id, e.nom, e.alias, e.logo, e.codeAPE_NAF, e.pays_id, e.siteWeb, e.published, e.hits, e.modified');
		$query->from('#__annuaire_entreprises e');

		// joint la table pays
		$query->select('p.pays AS pays')->join('LEFT', '#__annuaire_pays AS p ON p.id=e.pays_id');

		// joint la table _users de Joomla
		// $query->select('ul.name AS linked_user')->join('LEFT', '#__users AS ul ON ul.id=a.affected_to');

		// filtre de recherche rapide textuelle
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('e.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'e.nom LIKE '.$search;
				$searches[]	= 'e.codeAPE_NAF LIKE '.$search;
				$searches[]	= 'e.siteWeb LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// filtre selon l'état du filtre 'filter_codeAPE_NAF'
		$codeAPE_NAF = $this->getState('filter.codeAPE_NAF');
		if (is_numeric($codeAPE_NAF)) {
			$query->where('e.codeAPE_NAF=' . (int) $codeAPE_NAF);
		}
		// filtre selon l'état du filtre 'filter_pay'
		$pay = $this->getState('filter.pay');
		if (is_numeric($pay)) {
			$query->where('e.pays_id=' . (int) $pay);
		}
		// filtre selon l'état du filtre 'filter_published'
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('e.published=' . (int) $published);
		}
		elseif ($published === '') {
			// si aucune sélection, on n'affiche que les publiés et dépubliés
			$query->where('(e.published=0 OR e.published=1)');
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'e.nom');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','egs_',$query));			// TEST/DEBUG
		return $query;
	}

	public function getPays()
	{
		$query = $this->_db->getQuery(true);
		$query->select('id, pays');
		$query->from('#__annuaire_pays');
		$query->where('published=1');
		$query->order('pays ASC');
		$this->_db->setQuery($query);
		$pays = $this->_db->loadObjectList();
		return $pays;
	}	
}
