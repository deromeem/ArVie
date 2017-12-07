<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerMetier_groupe_maps extends JControllerForm
{
		function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'groupe_utilisateur_maps'));
 
                parent::display($cachable, $urlparams);
        }
}
