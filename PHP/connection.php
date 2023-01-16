<?php



// Create connection
$con = mysqli_connect($server_name, $username, $password, $database);

// Check connection
if (!$con) {
    log(mysqli_connect_error());
    die("Connection failed!");
}
