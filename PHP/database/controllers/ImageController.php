<?php

class ImageController extends BaseController
{
    public function __construct(private ImageRepository $gateway)
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
        $image = $this->gateway->get($id);

        if (!$image) {
            http_response_code(404);
            echo json_encode(["message" => "image Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($image->toArray());
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

                //Update image
                http_response_code(200);
                $rows = $this->gateway->update($image, $data);
                echo json_encode([
                    "message" => "image $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "image $id - Deleted",
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
                //No errors create a image
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "image Was Created",
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

        if ($is_new && empty($data["email"])) {
            $errors[] = "Email is required";
        }
        if ($is_new && empty($data["imagename"])) {
            $errors[] = "imagename is required";
        }
        if ($is_new && empty($data["password"])) {
            $errors[] = "Password is required";
        }
        return $errors;
    }
}
