<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieViewGroupe_Utilisateur_map extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;
	
	public function display($tpl = null) 
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		$this->addToolBar();
		parent::display($tpl);
	}

	protected function addToolBar() 
	{			
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		// $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
	
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title(JText::_('COM_ARVIE_GROUPE_UTILISATEUR_MAP')." : ".($isNew ? JText::_('COM_ARVIE_NEW'): JText::_('COM_ARVIE_MODIF')), 'address');


		if ($isNew)
		{
			JToolbarHelper::apply('groupe_utilisateur_map.apply');
			JToolbarHelper::save('groupe_utilisateur_map.save');
			JToolbarHelper::save2new('groupe_utilisateur_map.save2new');
		}
		else
		{
			// if (!$checkedOut)
			// {
				JToolbarHelper::apply('groupe_utilisateur_map.apply');
				JToolbarHelper::save('groupe_utilisateur_map.save');
			// }
		}
		JToolBarHelper::cancel('groupe_utilisateur_map.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}