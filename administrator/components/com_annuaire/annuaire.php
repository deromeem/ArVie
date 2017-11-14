<?php
defined('_JEXEC') or die('Restricted access');
 
// récupère une instance du controller préfixée par le nom du composant
$controller = JControllerLegacy::getInstance('annuaire');
 
// exécute la tâche demandée
$jinput = JFactory::getApplication()->input;
$task = $jinput->get('task', "", 'STR' );
$controller->execute($task);
 
// exécute la redirection prévue par le controleur
$controller->redirect();
