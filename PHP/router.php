<?php
$logRepository = new LogRepository($database);

$campusRepository = new CampusRepository($database);
$userRepository = new UserRepository($database, $campusRepository);

$imageRepository = new ImageRepository($database);
$buildingRepository = new BuildingRepository($database);
$connectionRepository = new ConnectionRepository($database);
$floorRepository = new FloorRepository($database);
$locationRepository = new LocationRepository($database);

$roomRepository = new RoomRepository(
    $database,
    $buildingRepository,
    $locationRepository,
    $floorRepository
);

$request = explode("/", strtolower($_SERVER["REQUEST_URI"]));

if ($request[1] == "api") {
    //Get The 2nd parameter
    $id = $request[3] ?? null;

    switch ($request[2]) {
        case "images":
            $output = new ImageController($imageRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "users":
            $output = new UserController($userRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "buildings":
            $output = new BuildingController($buildingRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "campuses":
            $output = new CampusController($campusRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "connections":
            $output = new ConnectionController($connectionRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "floors":
            $output = new FloorController($floorRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "locations":
            $output = new LocationController($locationRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "rooms":
            $output = new RoomController($roomRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        case "tables":
            $statement = $database->getTables();
            echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
            break;
        case "logs":
            $output = new LogController($logRepository);
            $output->request($_SERVER["REQUEST_METHOD"], $id);
            break;
        default:
            http_response_code(404);
            // header("Location: ./hello.php");
            break;
    }
}
