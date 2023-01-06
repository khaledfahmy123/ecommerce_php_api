<?php

declare(strict_types = 1);

spl_autoload_register(function ($class){
    require __DIR__ . "/src/$class.php"; // we could use composers autoloader 
});

set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset: UTF-8");

$request_parts = explode("/", $_SERVER['REQUEST_URI']);


// $dbName = "id20111439_products";
// $user = "id20111439_products_test";
// $password = "M=yK]2cl!E_80a)l";
// $host = "localhost";
$host = "localhost";
$user = "root";
$password = "root";
$dbName = "test";


$db = new Database($host, $dbName, $user, $password);

$gate = new ProductsGateway($db);

$controller = new ProductController($gate);

$id = $request_parts[3] ?? null;

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);

?>