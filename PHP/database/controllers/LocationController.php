<?php

class LocationController extends BaseController
{
    public function __construct(
        private LocationRepository $gateway,
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
            "Location Request",
            "Attempting to get data with " . $method,
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
            "Location Request with ID",
            "Attempting to get data with " . $method . " id: " . $id,
            "Info"
        );
        $location = $this->gateway->get($id);

        if (!$location) {
            http_response_code(404);
            echo json_encode(["message" => "location Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($location->toArray());
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

                //Update location
                http_response_code(200);
                $rows = $this->gateway->update($location, $data);
                echo json_encode([
                    "message" => "location $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "location $id - Deleted",
                    "rows" => $rows
                ]);
                break;
            default:
                $this->logRepository->create(
                    "Location Request",
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
                //No errors create a location
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "location Was Created",
                    "ID" => $id,
                ]);
                break;
            default: //Only allow GET and POST responses
                $this->logRepository->create(
                    "Location Request",
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

        return $errors;
    }
}
