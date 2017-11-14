<?php
defined('_JEXEC') or die('Restricted access');

class AnnuaireModelEntreprise extends JModelAdmin
{
	protected $_compo = 'com_annuaire';
	protected $_context = 'entreprise';
	public $typeAlias = 'com_annuaire.entreprise';
	
	// Surcharges des méthodes de la classe mère pour :
	
	// 1) définir la table de soutien à utiliser
	public function getTable($type = 'Entreprise', $prefix = 'AnnuaireTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	// 2) préciser le chemin du contexte à utiliser pour charger le fichier XML décrivant les champs de saisie
	public function getForm($data = array(), $loadData = true) 
	{
		$form = $this->loadForm($this->typeAlias, $this->_context,
			array('control'=>'jform', 'load_data'=>$loadData));
		if (empty($form)) 
		{
			return false;
		}
		
		$jinput = JFactory::getApplication()->input;

		// le frontend appelle ce modèle et utilise a_id (initialisé à 0 by par défaut) pour éviter la collision avec id
		if ($jinput->get('a_id'))
		{
			$id = $jinput->get('a_id', 0);
		}
		// le backend utilise id (initialisé à 0 by par défaut)
		else
		{
			$id = $jinput->get('id', 0);
		}		
		// echo "Backend : id=".$id;   // TEST/DEBUG
		
		return $form;
	}

	// 3) contrôler qu'un tableau de données n'est pas déjà initialisé dans la session
	protected function loadFormData() 
	{
		$data = JFactory::getApplication()->getUserState($this->_compo.'.edit.'.$this->_context.'.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}

	// 4) préparer les données avant la sauvegarde en base de données par l'objet JTable
	protected function prepareTable($table)
	{
		$table->alias = JApplication::stringURLSafe($table->alias);
		if (empty($table->alias))
		{
			$table->alias = JApplication::stringURLSafe($table->nom);
		}
	}
}
