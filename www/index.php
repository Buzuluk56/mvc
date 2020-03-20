<?php

//var_dump($_SERVER);
$parts = explode('/',$_SERVER['REQUEST_URI']);

//var_dump($parts);
$controllerName = $parts[2];
$actionName = $parts[3];


$controllerFileName = ucfirst($controllerName);
//var_dump($controllerFileName);

include "../App/Controller/$controllerName.php";

$controllerObj = new $controllerName();
$actionFunName = $actionName . 'Action';

if (!method_exists($controllerObj,$actionFunName))
{
    echo '404';
    die;
}

$tp1 ='../App//Templates'. $controllerFileName . '/' . $actionName . '.phtml';


include "../Base/View.php";
$view = new View();
$controllerObj->view = $view;

$controllerObj->$actionFunName();
$view->render($tp1);
