<?php

// Initiate all repositories for later easier use
$logRepository = new LogRepository($database);
$campusRepository = new CampusRepository($database);
$userRepository = new UserRepository($database, $campusRepository);
$locationRepository = new LocationRepository($database);
$buildingRepository = new BuildingRepository($database, $campusRepository, $locationRepository);
$floorRepository = new FloorRepository($database, $buildingRepository);
$connectionRepository = new ConnectionRepository($database, $locationRepository);
$roomRepository = new RoomRepository(
    $database,
    $buildingRepository,
    $locationRepository,
    $floorRepository
);
$imageRepository = new ImageRepository($database, $campusRepository, $buildingRepository, $roomRepository);

// explode the url request to create a router
$request = explode("/", strtolower($_SERVER["REQUEST_URI"]));

// Provided the first one is a /api/ call
if ($request[1] == "api") {
    //Get The 2nd parameter
    $id = $request[3] ?? null;

    switch ($request[2]) {
            // Database routes
        case "images":
            $output = new ImageController($imageRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "users":
            $output = new UserController($userRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "buildings":
            $output = new BuildingController($buildingRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "campuses":
            $output = new CampusController($campusRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "connections":
            $output = new ConnectionController($connectionRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "floors":
            $output = new FloorController($floorRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "locations":
            $output = new LocationController($locationRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "rooms":
            $output = new RoomController($roomRepository, $logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "tables":
            // Returns all tables used to then display them in the admin panel
            $tables = $database->getTables();
            echo json_encode($tables);
            break;
        case "logs":
            // Logs
            $output = new LogController($logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "login":
            // LogIn Service
            $output = new SignInService($userRepository);
            break;
        default:
            // By Default respond with failiure
            http_response_code(404);
            // header("Location: ./hello.php");
            break;
    }
}
