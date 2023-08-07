<?php

class Device
{
    public function __construct(
        private int $id,
        private ?string $os = "",
        private ?string $name = "",
        private ?string $timestamp = null,
    ) {
        $this->setId($id);
        $this->setOs($os);
        $this->setName($name);
        $this->setTimestamp($timestamp);
        $this->timestamp = date('Y-m-d H:i:s');
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }
    public function getOs(): string
    {
        return $this->os;
    }
    public function getName(): string
    {
        return $this->name;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setTimestamp(?string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
    public function setOs(?string $os): void
    {
        $this->os = $os;
    }
    public function setName(?string $name): void
    {
        $this->name = $name;
    }


    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "os" => $this->getOs(),
            "name" => $this->getName(),
            "TimeStamp" => $this->getTimestamp(),
        ];
    }
}
