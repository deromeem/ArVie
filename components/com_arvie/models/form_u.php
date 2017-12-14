<?php
defined('_JEXEC') or die;

// use Joomla\Registry\Registry;

// Base ce modèle sur celui du backend.
require_once JPATH_COMPONENT_ADMINISTRATOR.'/models/utilisateur.php';

class ArvieModelForm_u extends ArvieModelUtilisateur
{
	protected $_context = 'utilisateur';

	protected function populateState()
	{
 		$app = JFactory::getApplication();

		// Charge l'état depuis l'URL
		$pk = $app->input->getInt('id');
		$this->setState('utilisateur.id', $pk);
		
		$this->setState($this->_context.'id', $pk);

		$return = $app->input->get('return', null, 'base64');
		$this->setState('return_page', base64_decode($return));

		$this->setState('layout', $app->input->getString('layout'));
	}
	
	public function getItem($itemId = null)
	{
		$itemId = (int) (!empty($itemId)) ? $itemId : $this->getState('utilisateur.id');
		// echo "Frontend itemId=".$itemId;   // TEST/DEBUG

		// Obtient une instance de la ligne
		$table = $this->getTable();

		// Charge la ligne, si possible
		$return = $table->load($itemId);

		// Test une éventuelle erreur sur l'objet table
		if ($return === false && $table->getError())
		{
			$this->setError($table->getError());

			return false;
		}

		$properties = $table->getProperties(1);
		$value = JArrayHelper::toObject($properties, 'JObject');

		return $value;
	}

}
