<?php

class Location
{
    private int $id;
    private string $type;
    private float $geoLongitude;
    private float $geoLatitude;
    private float $mapLongitude;
    private float $mapLatitude;
    private int $altitude;
    private bool $enabled;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
    public function __construct(
        int $id,
        string $type,
        float $geoLongitude,
        float $geoLatitude,
        float $mapLongitude,
        float $mapLatitude,
        int $altitude = 0,
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
        $this->setGeoLongitude($geoLongitude);
        $this->setGeoLatitude($geoLatitude);
        $this->setMapLatitude($mapLatitude);
        $this->setMapLongitude($mapLongitude);
        $this->setMapAltitude($altitude);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGeoLongitude(): float
    {
        return $this->geoLongitude;
    }

    public function getGeoLatitude(): float
    {
        return $this->geoLatitude;
    }

    public function getMapLongitude(): float
    {
        return $this->mapLongitude;
    }

    public function getMapLatitude(): float
    {
        return $this->mapLatitude;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
    public function getMapAltitude(): int
    {
        return $this->altitude;
    }

    // Setters
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setGeoLongitude(float $longitude): void
    {
        $this->geoLongitude = $longitude;
    }

    public function setGeoLatitude(float $latitude): void
    {
        $this->geoLatitude = $latitude;
    }

    public function setMapLongitude(float $longitude): void
    {
        $this->mapLongitude = $longitude;
    }

    public function setMapLatitude(float $latitude): void
    {
        $this->mapLatitude = $latitude;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setMapAltitude(int $altitude): void
    {
        $this->altitude = $altitude;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "geoLongitude" => $this->getGeoLongitude(),
            "geoLatitude" => $this->getGeoLatitude(),
            "mapLongitude" => $this->getMapLongitude(),
            "mapLatitude" => $this->getMapLatitude(),
            "mapAltitude" => $this->getMapAltitude(),
            "enabled" => $this->isEnabled(),
        ];
    }
}
