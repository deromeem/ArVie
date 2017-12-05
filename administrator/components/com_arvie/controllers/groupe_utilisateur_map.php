<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerGroupe extends JControllerForm
{
		function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Groupe_utilisateur_map'));
 
                parent::display($cachable, $urlparams);
        }
}
