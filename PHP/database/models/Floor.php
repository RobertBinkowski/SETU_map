<?php

class Floor
{

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private int $id,
        private bool $enabled = true,
        private int $floor = 0,
        private ?Building $building = null,
        private ?Details $details = null,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setBuilding($building);
        $this->setFloor($floor);
        $this->setDetails($details);
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

    public function getFloor(): string
    {
        return $this->floor;
    }
    public function getBuilding(): ?Building
    {
        return $this->building;
    }
    public function getDetails(): ?Details
    {
        return $this->details;
    }

    // Setters

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setBuilding(?Building $building): void
    {
        $this->building = $building;
    }

    public function setDetails(?Details $details): void
    {
        $this->details = $details;
    }

    public function setFloor(int $floor): void
    {
        $this->floor = $floor;
    }

    // To Array
    function toArray(): array
    {
        $data = [
            "id" => $this->getId(),
            "enabled" => $this->isEnabled(),
            "floor" => $this->getFloor(),
        ];
        if ($this->building) {
            $data['building'] = $this->getBuilding()->toArray();
        }
        if ($this->details) {
            $data['details'] = $this->getDetails()->toArray();
        }
        return $data;
    }
}
