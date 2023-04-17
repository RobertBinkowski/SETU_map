<?php
//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

/**
 * Includes for the Back End
 */
include "./src/ErrorHandler.php";
//Auto Loader for Database Components
include "./src/AutoLoader.php";
//Main header data
include "./src/Header.php";
include "./src/Security.php";
include "./router.php";


// Test
// $user = new User(
//     1,
//     "Hello",
//     "Email",
//     "Pas",
//     "none",
//     1
// );

// echo $user;
