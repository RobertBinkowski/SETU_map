<?php

$request = explode("/", strtolower($_SERVER["REQUEST_URI"]));

if ($request[1] == "api") {
    //Get The 2nd parameter
    $id = $request[3] ?? null;

    switch ($request[2]) {
        case "images":
            $output = new Image($database);
            $output = new ImageController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "users":
            $output = new User($database);
            $output = new UserController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "buildings":
            $output = new Building($database);
            $output = new BuildingController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "campus":
            $output = new Campus($database);
            $output = new CampusController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "connections":
            $output = new Connection($database);
            $output = new ConnectionController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "floors":
            $output = new Floor($database);
            $output = new FloorController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "layouts":
            $output = new Layout($database);
            $output = new LayoutController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "locations":
            $output = new Location($database);
            $output = new LocationController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "rooms":
            $output = new Room($database);
            $output = new RoomController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "tables":
            $statement = $database->getTables();
            echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
            break;
        default:
            http_response_code(404);
            // header("Location: ./hello.php");
            break;
    }
}
