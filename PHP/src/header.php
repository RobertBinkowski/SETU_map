<?php

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
