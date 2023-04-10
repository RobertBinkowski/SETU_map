<?php

class Floor
{
    private int $id;
    private bool $enabled;
    private string $size;
    private ?int $building;
    private int $floor;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        int $id,
        string $size,
        int $floor,
        ?int $building = null,
        bool $enabled = true,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setSize($size);
        $this->setBuilding($building);
        $this->setFloor($floor);
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

    public function getSize(): string
    {
        return $this->size;
    }

    public function getBuilding(): ?int
    {
        return $this->building;
    }

    public function getFloor(): string
    {
        return $this->floor;
    }

    // Setters

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function setBuilding(?int $building = null): void
    {
        $this->building = $building;
    }

    public function setFloor(int $floor): void
    {
        $this->floor = $floor;
    }

    // To Array
    function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "enabled" => $this->isEnabled(),
            "size" => $this->getSize(),
            // "building" => $this->getBuilding(),
            "floor" => $this->getFloor(),
        ];
    }
}
