<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerRole extends JControllerForm
{
		function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Role'));
 
                parent::display($cachable, $urlparams);
        }
}
