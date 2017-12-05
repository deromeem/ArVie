<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerEvenement extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Evenement'));

                parent::display($cachable, $urlparams);
        }
}
