<?php

class LogController extends BaseController
{
    public function __construct(private LogRepository $gateway)
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
        $log = $this->gateway->get($id);

        if (!$log) {
            http_response_code(404);
            echo json_encode(["message" => "Logs Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($log);
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

                //Update log
                http_response_code(200);
                $rows = $this->gateway->update($log, $data);
                echo json_encode([
                    "message" => "log $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "log $id - Deleted",
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
                //No errors create a log
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "log Was Created",
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

        if ($is_new && empty($data["title"])) {
            $errors[] = "Title is required";
        }
        if ($is_new && empty($data["type"])) {
            $errors[] = "Type is required";
        }
        if ($is_new && empty($data["info"])) {
            $errors[] = "Info is required";
        }
        return $errors;
    }
}
