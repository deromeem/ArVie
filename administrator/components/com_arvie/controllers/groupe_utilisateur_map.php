<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerGroupe_utilisateur_map extends JControllerForm
{
		function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'groupe_utilisateur_map'));
 
                parent::display($cachable, $urlparams);
        }
}
