<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerParrain extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Parrain'));

                parent::display($cachable, $urlparams);
        }
}
