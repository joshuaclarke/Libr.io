<?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Dispatcheur PHP (Toutes les requêtes passent par ce script)
 *    Victor LAURENT 11409577
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

define('ROOT', str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']));

$param = explode('/', $_GET['p']);
$controller = $param[0] !== "" ? htmlspecialchars($param[0]) : 'Home';
$action = isset($param[1]) ? htmlspecialchars($param[1]) : 'topTen';

if(file_exists(ROOT.'controller/'.$controller.'.php'))
{
    require_once(ROOT.'controller/'.$controller.'.php');
    $controller = new $controller();
    if(method_exists($controller, $action) && isset($param[2]) && $param[2] !== "")
    {
        $argument = htmlspecialchars($param[2]);
        $controller->$action($argument);
    }
    elseif(method_exists($controller, $action))
    {
        $controller->$action();
    }
    else
    {
        echo json_encode("no_data_found");
    }
}
else
{
    echo json_encode("error_controller");
}
