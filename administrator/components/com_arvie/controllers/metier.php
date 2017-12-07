<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerMetier extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Metier'));

                parent::display($cachable, $urlparams);
        }
}
