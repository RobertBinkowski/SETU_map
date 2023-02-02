<?php

$request = explode("/", $_SERVER["REQUEST_URI"]);
//Get The 2nd parameter
$id = $request[2] ?? null;

switch ($request[1]) {
    case "image":
        $output = new Image($database);
        $output = new ImageController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "user":
        $output = new User($database);
        $output = new UserController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "building":
        $output = new Building($database);
        $output = new BuildingController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "campus":
        $output = new Campus($database);
        $output = new CampusController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "connection":
        $output = new Connection($database);
        $output = new ConnectionController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "floor":
        $output = new Floor($database);
        $output = new FloorController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "layout":
        $output = new Layout($database);
        $output = new LayoutController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "location":
        $output = new Location($database);
        $output = new LocationController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    case "room":
        $output = new Room($database);
        $output = new RoomController($output);
        $output->request($_SERVER["REQUEST_METHOD"], $id);
        break;
    default:
        http_response_code(404);
        // header("Location: ./hello.php");
        break;
}
