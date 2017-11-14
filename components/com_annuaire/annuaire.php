<?php
defined('_JEXEC') or die('Restricted access');
 
// récupère une instance du contrôleur préfixé par le nom du composant
$controller = JControllerLegacy::getInstance('annuaire');
 
// exécute la tâche demandée
$input = JFactory::getApplication()->input;
$task = $input->get('task', 'cmd');
$controller->execute($task);
 
// exécute la redirection prévue par le contrôleur
$controller->redirect();
