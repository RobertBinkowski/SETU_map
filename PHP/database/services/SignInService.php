<?php

class SignInService
{
    public function __construct(private UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($credentials)
    {
        // Validate the user
        $user = $this->validateCredentials($credentials);
        $token = $this->generateToken();

        if ($user) {
            // Return the authentication token to the client
            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode(["token" => $token, "user" => $user]);
        } else {
            // Return an error message to the client
            http_response_code(401);
            header("Content-Type: application/json");
            echo json_encode(["message" => "Invalid email or password"]);
        }
    }

    private function validateCredentials($credentials): User|false
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        // No user found
        if (!$user) {
            return false;
        }

        if ($user->getEmail() === $credentials["email"] && $user->getPassword() === $credentials["password"]) {
            return $user;
        }

        return false;
    }

    private function generateToken()
    {
        // Generate a token
        return bin2hex(random_bytes(16));
    }
}
