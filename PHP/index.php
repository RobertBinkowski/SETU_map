<?php

//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);

//Auto Loader for all Controllers from /src/
spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

//Handle Exceptions
set_exception_handler("ErrorHandler::handleException");

//Set all headers to return Json type
header("Content-type:application/json; charset=UTF-8");

//Create Objects
$database = new Database("127.0.0.1","setu_map","root","pass"); 
$userCont = new UserController;

$request = explode("/",$_SERVER["REQUEST_URI"]);

// if($request[1] == ""){
//     http_response_code(404);
//     exit;
// }else{
// }

$database->getConnection();
$pass = $request[1] ?? null;

$userCont->userRequest($_SERVER["REQUEST_METHOD"], $pass);