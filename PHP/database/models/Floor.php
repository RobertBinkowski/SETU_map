<?php

class Floor
{
    private int $id;
    private bool $enabled;
    private string $info;
    private string $size;
    private int $buildingId;
    private string $floor;

    public function __construct(int $id, bool $enabled, string $info, string $size, int $buildingId, string $floor)
    {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->info = $info;
        $this->size = $size;
        $this->buildingId = $buildingId;
        $this->floor = $floor;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    public function getFloor(): string
    {
        return $this->floor;
    }

    // Setters
    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function setBuildingId(int $buildingId): void
    {
        $this->buildingId = $buildingId;
    }

    public function setFloor(string $floor): void
    {
        $this->floor = $floor;
    }
}
