<?php
//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);
include "./src/ErrorHandler.php";
include "./src/AutoLoader.php";
include "./src/header.php";

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
