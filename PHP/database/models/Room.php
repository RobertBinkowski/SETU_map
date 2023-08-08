<?php
require_once "Building.php";
require_once "Location.php";
require_once "Floor.php";

class Room implements JsonSerializable
{

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __construct(
        private int $id,
        private bool $enabled = true,
        private string $type = "",
        private ?int $building = null,
        private ?int $location = null,
        private ?int $floor = null,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
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

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function getFloor(): ?Floor
    {
        return $this->floor;
    }

    // Setters
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
    public function setBuilding(?Building $building = null): void
    {
        $this->building = $building;
    }

    public function setLocation(?Location $location = null): void
    {
        $this->location = $location;
    }

    public function setFloor(?Floor $floor = null): void
    {
        $this->floor = $floor;
    }

    // To Array
    public function toArray(): array
    {
        $data =  [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "enabled" => $this->isEnabled(),
        ];
        if ($this->building) {
            $data["building"] = $this->getBuilding()->toArray();
        }
        if ($this->location) {
            $data["location"] = $this->getLocation()->toArray();
        }
        if ($this->floor) {
            $data["floor"] = $this->getFloor()->toArray();
        }
        return $data;
    }
}
