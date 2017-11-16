<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerGroupe extends JControllerForm
{
		function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Groupe'));
 
                parent::display($cachable, $urlparams);
        }
}
