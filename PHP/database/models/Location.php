<?php

class Location
{

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
    public function __construct(
        private int $id,
        private string $type = "",
        private float $longitude = 0,
        private float $latitude = 0,
        private int $altitude = 0,
        private bool $enabled = true
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
        $this->setLongitude($longitude);
        $this->setLatitude($latitude);
        $this->setAltitude($altitude);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }


    public function isEnabled(): bool
    {
        return $this->enabled;
    }
    public function getAltitude(): int
    {
        return $this->altitude;
    }

    // Setters
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setAltitude(int $altitude): void
    {
        $this->altitude = $altitude;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "longitude" => $this->getLongitude(),
            "latitude" => $this->getLatitude(),
            "altitude" => $this->getAltitude(),
            "enabled" => $this->isEnabled(),
        ];
    }
}
