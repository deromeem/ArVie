<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerUtilisateur_even_map extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Utilisateur_even_map'));

                parent::display($cachable, $urlparams);
        }
}
