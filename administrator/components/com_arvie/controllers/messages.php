<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerMessages extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Messages'));

                parent::display($cachable, $urlparams);
        }
}