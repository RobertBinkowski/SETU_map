<?php

class Coordinates implements JsonSerializable
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
        private float $latitude = 0,
        private float $longitude = 0,
        private float $altitude = 0,
        private float $zoom = 0,
    ) {
        $this->id = $id;
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setAltitude($altitude);
        $this->setZoom($zoom);
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getLatitude(): float
    {
        return $this->latitude;
    }
    public function getLongitude(): float
    {
        return $this->longitude;
    }
    public function getAltitude(): float
    {
        return $this->altitude;
    }
    public function getZoom(): float
    {
        return $this->zoom;
    }


    // Setters
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }
    public function setAltitude(float $altitude): void
    {
        $this->altitude = $altitude;
    }
    public function setZoom(float $zoom): void
    {
        $this->zoom = $zoom;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "latitude" => $this->getLatitude(),
            "longitude" => $this->getLongitude(),
            "altitude" => $this->getAltitude(),
            "zoom" => $this->getZoom(),
        ];
    }
}
