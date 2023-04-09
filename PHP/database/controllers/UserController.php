<?php

class UserController extends BaseController
{
    public function __construct(private UserRepository $gateway)
    {
    }

    protected function getRepository()
    {
        return $this->gateway;
    }

    protected function processResourceRequest(string $method, string $id)
    {
        $user = $this->gateway->get($id);

        if (!$user) {
            http_response_code(404);
            return json_encode(["message" => "User Not found"]);
        }

        if ($method == "GET") {
            return json_encode($user->toArray());
        }
        if ($method == "PATCH") {
            $data = (array) json_decode(file_get_contents("php://input"), true);

            // Check if any errors
            $errors = $this->getValidationErrors($data, false);
            if (!empty($errors)) {
                http_response_code(422);
                return json_encode(["errors" => $errors]);
            }

            // Update user
            http_response_code(200);
            $rows = $this->gateway->update($user, $data);
            return json_encode([
                "message" => "User $id - Updated",
                "rows affected" => $rows,
            ]);
        }
        if ($method == "DELETE") {
            $rows = $this->gateway->delete($id);
            return json_encode([
                "message" => "User $id - Deleted",
                "rows" => $rows
            ]);
        }
        http_response_code(405);
        header("Allowed: GET, PATCH, DELETE");
    }

    protected function processCollectionRequest(string $method)
    {
        switch ($method) {
            case "GET":
                return json_encode($this->getAll());
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                // Check if any errors
                $errors = $this->getValidationErrors($data);
                if (!empty($errors)) {
                    http_response_code(422);
                    return json_encode(["errors" => $errors]);
                }
                $user = new User(
                    0,
                    $data['username'],
                    $data['email'],
                    $data['password'],
                    $data['privileges'],
                    $data['campus']
                );
                // No errors create a user
                http_response_code(201);
                $id = $this->gateway->create($user);
                return json_encode([
                    "message" => "User Was Created",
                    "ID" => $id,
                ]);
            default: // Only allow GET and POST responses
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
        if ($is_new && empty($data["username"])) {
            $errors[] = "Username is required";
        }
        if ($is_new && empty($data["password"])) {
            $errors[] = "Password is required";
        }
        return $errors;
    }
}
