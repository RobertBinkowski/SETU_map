<?php

$server_name = "127.0.0.1";
$username = "root";
$password = "pass";
$database = "setu_map";

// Create connection
$con = mysqli_connect($server_name, $username, $password, $database);

// Check connection
if (!$con) {
    log(mysqli_connect_error());
    die("Connection failed!");
}
