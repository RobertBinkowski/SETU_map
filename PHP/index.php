<?php
//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);
include "./src/ErrorHandler.php";
include "./src/AutoLoader.php";
include "./src/header.php";

//Handle Exceptions
set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

//Set all headers to return Json type
header("Content-type:application/json; charset=UTF-8");

//Database Connection
$host = "127.0.0.1";
$username = "root";
$password = "pass";
$database = "setu_map";

$database = new Database($host, $database, $username, $password);

$request = explode("/", $_SERVER["REQUEST_URI"]);

// if($request[1] == ""){
//     http_response_code(404);
//     exit;
// }else{
// }

$gateway = new userGateway($database);
$userCont = new UserController($gateway);

$pass = $request[1] ?? null;

$userCont->userRequest($_SERVER["REQUEST_METHOD"], $pass);
