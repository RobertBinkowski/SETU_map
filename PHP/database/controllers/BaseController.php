<?php

abstract class BaseController
{
    abstract protected function getRepository();

    public function getAll()
    {
        $items = $this->getRepository()->getAll();

        return array_map(function ($item) {
            return $item->toArray();
        }, $items);
    }

    public function request(string $method, ?string $id): void
    {
        if ($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    abstract protected function processResourceRequest(string $method, string $id): void;

    abstract protected function processCollectionRequest(string $method): void;
}
