<?php

$request = explode("/", strtolower($_SERVER["REQUEST_URI"]));

if ($request[1] == "api") {
    //Get The 2nd parameter
    $id = $request[3] ?? null;

    switch ($request[2]) {
        case "images":
            $output = new ImageRepository($database);
            $output = new ImageController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "users":
            $output = new UserRepository($database);
            $output = new UserController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "buildings":
            $output = new BuildingRepository($database);
            $output = new BuildingController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "campuses":
            $output = new CampusRepository($database);
            $output = new CampusController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "connections":
            $output = new ConnectionRepository($database);
            $output = new ConnectionController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "floors":
            $output = new FloorRepository($database);
            $output = new FloorController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "locations":
            $output = new LocationRepository($database);
            $output = new LocationController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "rooms":
            $output = new RoomRepository($database);
            $output = new RoomController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "tables":
            $statement = $database->getTables();
            echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
            break;
        case "logs":
            $output = new LogRepository($database);
            $output = new LogController($output);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        default:
            http_response_code(404);
            // header("Location: ./hello.php");
            break;
    }
}
