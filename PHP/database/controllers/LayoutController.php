<?php

class LayoutController
{
    public function __construct(private Layout $gateway)
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
        $layout = $this->gateway->get($id);

        if (!$layout) {
            http_response_code(404);
            echo json_encode(["message" => "Layout Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($layout);
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

                //Update layout
                http_response_code(200);
                $rows = $this->gateway->update($layout, $data);
                echo json_encode([
                    "message" => "Layout $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "Layout $id - Deleted",
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
                //No errors create a layout
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "Layout Was Created",
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

        if ($is_new && empty($data["src"])) {
            $errors[] = "Source is required";
        }
        if ($is_new && empty($data["name"])) {
            $errors[] = "Name is required";
        }
        return $errors;
    }
}
