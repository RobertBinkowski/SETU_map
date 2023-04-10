<?php

class RoomController extends BaseController
{
    public function __construct(
        private RoomRepository $gateway,
        private LogRepository $logRepository
    ) {
        $this->logRepository = $logRepository;
    }
    protected function getRepository()
    {
        return $this->gateway;
    }
    public function request(string $method, ?string $id): void
    {
        $this->logRepository->create(
            "Room Request",
            "Attempting to get data from Room with " . $method,
            "Info"
        );
        if ($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }
    public function processResourceRequest(string $method, string $id): void
    {
        $this->logRepository->create(
            "Room Request with ID",
            "Attempting to get data from Room with " . $method . " id: " . $id,
            "Info"
        );
        $room = $this->gateway->get($id);

        if (!$room) {
            http_response_code(404);
            echo json_encode(["message" => "room Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($room->toArray());
                break;
            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                //Check if any errors
                $errors = $this->getValidationErrors($data, false);
                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                //Update room
                http_response_code(200);
                $rows = $this->gateway->update($room, $data);
                echo json_encode([
                    "message" => "room $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "room $id - Deleted",
                    "rows" => $rows
                ]);
                break;
            default:
                $this->logRepository->create(
                    "Room Request",
                    "Attempting to Reach Wrong method " . $method . " id: " . $id,
                    "Error"
                );
                http_response_code(405);
                header("Allowed: GET, PATCH, DELETE");
                break;
        }
    }
    public function processCollectionRequest($method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->getAll());
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                //Check if any errors
                $errors = $this->getValidationErrors($data);
                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }
                //No errors create a room
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "User Was Created",
                    "ID" => $id,
                ]);
                break;
            default: //Only allow GET and POST responses
                $this->logRepository->create(
                    "Room Request",
                    "Attempting to Reach Wrong method " . $method . " id: " . $id,
                    "Error"
                );
                http_response_code(405);
                header("Allowed: GET, POST");
        }
    }
    /**
     * Validate the inputs
     * @param array $data
     * @return array
     */
    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];
        if ($is_new && empty($data["name"])) {
            $errors[] = "name is required";
        }
        $this->logRepository->create(
            "Validation Error",
            "Errors Found:  " . $errors,
            "Error"
        );
        return $errors;
    }
}
