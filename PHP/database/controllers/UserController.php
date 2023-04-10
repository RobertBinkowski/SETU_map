<?php

class UserController extends BaseController
{
    public function __construct(
        private UserRepository $gateway,
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
            "User Request",
            "Attempting to get data from User with " . $method,
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
            "User Request with ID",
            "Attempting to get data from User with " . $method . " id: " . $id,
            "Info"
        );
        $user = $this->gateway->get($id);

        if (!$user) {
            http_response_code(404);
            echo json_encode(["message" => "User Not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($user->toArray());
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

                //Update user
                http_response_code(200);
                $rows = $this->gateway->update($user, $data);
                echo json_encode([
                    "message" => "User $id - Updated",
                    "rows affected" => $rows,
                ]);
                break;
            case "DELETE":
                $rows = $this->gateway->delete($id);
                echo json_encode([
                    "message" => "User $id - Deleted",
                    "rows" => $rows
                ]);
                break;
            default:
                $this->logRepository->create(
                    "User Request",
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
                //No errors create a user
                http_response_code(201);
                $id = $this->gateway->create($data);
                echo json_encode([
                    "message" => "User Was Created",
                    "ID" => $id,
                ]);
                break;
            default: //Only allow GET and POST responses
                $this->logRepository->create(
                    "User Request",
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
     * @param bool is new
     * 
     * @return array
     */
    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];

        if ($is_new && empty($data["email"])) {
            $errors[] = "Email is required";
        }
        if ($is_new && empty($data["username"])) {
            $errors[] = "Username is required";
        }
        if ($is_new && empty($data["password"])) {
            $errors[] = "Password is required";
        }
        $this->logRepository->create(
            "Validation Error",
            "Errors Found:  " . $errors,
            "Error"
        );
        return $errors;
    }
}
