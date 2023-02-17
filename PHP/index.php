<?php
//Enable Strict to ensure Scalars is configured per file basis
declare(strict_types=1);
header('Access-Control-ALlow-Origin: *');
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
