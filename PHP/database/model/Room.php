<?php

class Room
{
    private int $id;
    private string $type;
    private string $name;
    private string $info;
    private float $size;
    private bool $enabled;
    private int $buildingId;
    private int $locationId;
    private int $floorId;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->info = $data['info'];
        $this->size = (float)$data['size'];
        $this->enabled = (bool)$data['enabled'];
        $this->buildingId = (int)$data['building_id'];
        $this->locationId = (int)$data['location_id'];
        $this->floorId = (int)$data['floor_id'];
    }

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

    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function getFloorId(): int
    {
        return $this->floorId;
    }

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

    public function setBuildingId(int $buildingId): void
    {
        $this->buildingId = $buildingId;
    }

    public function setLocationId(int $locationId): void
    {
        $this->locationId = $locationId;
    }

    public function setFloorId(int $floorId): void
    {
        $this->floorId = $floorId;
    }
}
