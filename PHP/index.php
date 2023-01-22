<?php
//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);
include "./src/ErrorHandler.php";
include "./src/AutoLoader.php";
include "./src/Header.php";
include "./src/Security.php";

$request = explode("/", $_SERVER["REQUEST_URI"]);

// if ($request[1] == "") {
//     http_response_code(404);
//     exit;
// } else {
// }

$output = new Image($database);
$output = new ImageController($output);

$pass = $request[1] ?? null;

$output->request($_SERVER["REQUEST_METHOD"], $pass);
