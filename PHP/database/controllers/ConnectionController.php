<?php

class ConnectionController extends BaseController
{
    public function __construct(private ConnectionRepository $gateway)
    {
    }
    protected function getRepository()
    {
        return $this->gateway;
    }
    public function request(string $method, ?string $id): void
    {
        if ($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }
    public function processResourceRequest(string $method, string $id): void
    {
        $connection = $this->gateway->get($id);

        if (!$connection) {
            http_response_code(404);
            echo json_encode(["message" => "connection Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($connection->toArray());
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

                //Update connection
                http_response_code(200);
                $rows = $this->gateway->update($connection, $data);
                echo json_encode([
                    "message" => "connection $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "connection $id - Deleted",
                    "rows" => $rows
                ]);
                break;
            default:
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
                //No errors create a connection
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "connection Was Created",
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

        if ($is_new && empty($data["distance"])) {
            $errors[] = "distance is required";
        }
        return $errors;
    }
}
