<?php

class Room
{
    private int $id;
    private string $type;
    private string $name;
    private string $info;
    private float $size;
    private bool $enabled;
    private int $building;
    private int $location;
    private int $floor;

    public function __construct(
        int $id,
        string $type,
        string $name,
        string $info,
        float $size,
        int $building,
        int $location,
        int $floor,
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
        $this->setName($name);
        $this->setInfo($info);
        $this->setSize($size);
        $this->setBuilding($building);
        $this->setLocation($location);
        $this->setFloor($floor);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getBuilding(): int
    {
        return $this->building;
    }

    public function getLocation(): int
    {
        return $this->location;
    }

    public function getFloor(): int
    {
        return $this->floor;
    }

    // Setters
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    public function setSize(float $size): void
    {
        $this->size = $size;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setBuilding(int $building): void
    {
        $this->building = $building;
    }

    public function setLocation(int $location): void
    {
        $this->location = $location;
    }

    public function setFloor(int $floor): void
    {
        $this->floor = $floor;
    }

    // To Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "name" => $this->getName(),
            "info" => $this->getInfo(),
            "size" => $this->getSize(),
            "enabled" => $this->isEnabled(),
            "building" => $this->getBuilding(),
            "location" => $this->getLocation(),
            "floor" => $this->getFloor(),
        ];
    }
}
