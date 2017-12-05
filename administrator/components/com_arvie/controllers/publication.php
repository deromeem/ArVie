<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerPublication extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Publication'));

                parent::display($cachable, $urlparams);
        }
}
