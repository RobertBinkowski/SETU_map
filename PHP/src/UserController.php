<?php

class UserController
{
    public function userRequest(string $method, ?string $id): void
    {
        if ($id) {
            $this->processResourceRequest($method, $id);
        }else{
            $this->processCollectionRequest($method);
        }
    }
    private function processResourceRequest(string $method, string $id): void
    {
    }
    private function processCollectionRequest($method): void
    {
        switch ($method){
            case "GET":
                echo json_encode(["id"=> 123]);
                break;
        }
    }
}
