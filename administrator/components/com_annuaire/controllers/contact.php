<?php
defined('_JEXEC') or die('Restricted access');
 
class AnnuaireControllerContact extends JControllerForm
{
		function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Contact'));
 
                parent::display($cachable, $urlparams);
        }
}
