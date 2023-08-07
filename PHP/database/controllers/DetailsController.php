<?php

class DetailsController extends BaseController
{
    public function __construct(
        private DetailsRepository $detailsRepository,
        private LogRepository $logRepository
    ) {
        $this->logRepository = $logRepository;
        $this->detailsRepository = $detailsRepository;
    }

    protected function getRepository()
    {
        return $this->detailsRepository;
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
        // $this->logRepository->create(
        //     "Details Request with ID",
        //     "Attempting to get data from details with " . $method . " id: " . $id,
        //     "Info"
        // );

        $detail = $this->detailsRepository->get($id);

        if (!$detail) {
            http_response_code(404);
            echo json_encode(["message" => "Details not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($detail->toArray());
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

                //Update detail
                http_response_code(200);
                $rows = $this->detailsRepository->update($detail, $data);
                echo json_encode([
                    "message" => "Detail $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->detailsRepository->delete($id);
                echo json_encode([
                    "message" => "Detail $id - Deleted",
                    "rows" => $rows
                ]);
                break;
            default:
                http_response_code(405);
                $this->logRepository->create(
                    "Details Request",
                    "Attempting to use an invalid method " . $method . " id: " . $id,
                    "Error"
                );
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

                //No errors, create a detail
                http_response_code(201);
                $id = $this->detailsRepository->create($data);
                echo json_encode([
                    "message" => "Detail was created",
                    "ID" => $id,
                ]);
                break;
            default:
                $this->logRepository->create(
                    "Details Request",
                    "Attempting to use an invalid method " . $method,
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

        // Validation checks
        // if ($is_new && empty($data["description"])) {
        //     $errors[] = "Description is required";
        // }

        $this->logRepository->create(
            "Validation Error",
            "Errors Found: " . json_encode($errors),
            "Error"
        );

        return $errors;
    }
}
