<?php

class Location
{
    private int $id;
    private string $type;
    private float $geoLongitude;
    private float $geoLatitude;
    private float $mapLongitude;
    private float $mapLatitude;
    private bool $enabled;
    private string $created;

    public function __construct(
        int $id,
        string $type,
        float $geoLongitude,
        float $geoLatitude,
        float $mapLongitude,
        float $mapLatitude,
        string $created,
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
        $this->setGeoLongitude($geoLongitude);
        $this->setGeoLatitude($geoLatitude);
        $this->setMapLatitude($mapLatitude);
        $this->setMapLongitude($mapLongitude);
        $this->setCreated($created);
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
    public function getCreated(): string
    {
        return $this->created;
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

    public function setCreated(string $created): void
    {
        $this->created = $created;
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
            "enabled" => $this->isEnabled(),
        ];
    }
}
