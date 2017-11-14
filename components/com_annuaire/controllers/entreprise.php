<?php
defined('_JEXEC') or die;

class AnnuaireControllerEntreprise extends JControllerForm
{
	// précise la vue (formulaire de saisie) à afficher
	protected $view_item = 'form';
	
	// précise la variable d'édition URL
	protected $urlVar = 'a.id';
	
	public function add()
	{
		if (!parent::add())
		{
			$this->setRedirect($this->getReturnPage());
		}
	}

	public function edit($key = null, $urlVar = 'a_id')
	{
		$result = parent::edit($key, $urlVar);
		if (!$result)
		{
			$this->setRedirect($this->getReturnPage());
		}
		return $result;
	}

	public function save($key = null, $urlVar = 'a_id')
	{
		$result = parent::save($key, $urlVar);
		if ($result)
		{
			$this->setRedirect($this->getReturnPage());
		}
		return $result;
	}

	public function cancel($key = 'a_id')
	{
		parent::cancel($key);
		$this->setRedirect($this->getReturnPage());
	}

	protected function getReturnPage()
	{
		// $return = $this->input->get('return', null, 'base64');
		// if (empty($return) || !JUri::isInternal(base64_decode($return)))
		// {
			// return JUri::base();
		// }
		// else
		// {
			// return base64_decode($return);
		// }		
		return JURI::base()."/index.php?option=com_annuaire&view=entreprises";		
	}

	public function getModel($name = 'form', $prefix = '', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
