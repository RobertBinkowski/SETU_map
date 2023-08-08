<?php
include_once "Coordinates.php";

class Location implements JsonSerializable
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
        private ?Coordinates $coordinates = null,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
        $this->setCoordinates($coordinates);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function getCoordinates(): ?Coordinates
    {
        return $this->coordinates;
    }


    public function isEnabled(): bool
    {
        return $this->enabled;
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
    public function setCoordinates(?Coordinates $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "enabled" => $this->isEnabled(),
            "coordinates" => $this->getCoordinates()->toArray() ?? null,
        ];
    }
}
