<?php
defined('_JEXEC') or die('Restricted access');
 
class ArvieControllerDiscussion extends JControllerForm
{
        function display($cachable = false, $urlparams = false) 
        {
                $input = JFactory::getApplication()->input;
                $input->set('view', $input->getCmd('view', 'Discussion'));

                parent::display($cachable, $urlparams);
        }
}
