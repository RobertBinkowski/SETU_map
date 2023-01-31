<?php

class RoomController
{
    public function __construct(private Room $gateway)
    {
    }
    public function request(string $method, ?string $id): void
    {
        if ($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }
    private function processResourceRequest(string $method, string $id): void
    {
        $room = $this->gateway->get($id);

        if (!$room) {
            http_response_code(404);
            echo json_encode(["message" => "room Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($room);
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
                http_response_code(405);
                header("Allowed: GET, PATCH, DELETE");
                break;
        }
    }
    private function processCollectionRequest($method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->gateway->getAll());
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
        return $errors;
    }
}