<?php

declare(strict_types = 1);

spl_autoload_register(function ($class){
    require __DIR__ . "/src/$class.php"; // we could use composers autoloader 
});

set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset: UTF-8");

$request_parts = explode("/", $_SERVER['REQUEST_URI']);



$host = "xxxxxxxx";
$user = "xxxxxxxx";
$password = "xxxxxxxxx";
$dbName = "xxxxxxxxxxx";


$db = new Database($host, $dbName, $user, $password);

$gate = new ProductsGateway($db);

$controller = new ProductController($gate);

$id = $request_parts[3] ?? null;

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);

?>