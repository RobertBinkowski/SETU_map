<?php
//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);
include "./src/ErrorHandler.php";
include "./src/AutoLoader.php";
include "./src/header.php";

$request = explode("/", $_SERVER["REQUEST_URI"]);

// if ($request[1] == "") {
//     http_response_code(404);
//     exit;
// } else {
// }

$output = new User($database);
$output = new UserController($output);

$pass = $request[1] ?? null;

$output->userRequest($_SERVER["REQUEST_METHOD"], $pass);
