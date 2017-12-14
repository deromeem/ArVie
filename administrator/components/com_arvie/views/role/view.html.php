<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieViewRole extends JViewLegacy
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
		JToolBarHelper::title(($isNew ? JText::_('COM_ARVIE_NEW'): JText::_('COM_ARVIE_ROLE').' : '.JText::_('COM_ARVIE_MODIF')), 'address');


		if ($isNew)
		{
			JToolbarHelper::apply('role.apply');
			JToolbarHelper::save('role.save');
			JToolbarHelper::save2new('role.save2new');
		}
		else
		{
			// if (!$checkedOut)
			// {
				JToolbarHelper::apply('role.apply');
				JToolbarHelper::save('role.save');
			// }
		}
		JToolBarHelper::cancel('role.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}
