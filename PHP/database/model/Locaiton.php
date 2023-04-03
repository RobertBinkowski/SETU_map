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

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->type = $data['type'];
        $this->geoLongitude = (float)$data['geo_longitude'];
        $this->geoLatitude = (float)$data['geo_latitude'];
        $this->mapLongitude = (float)$data['map_longitude'];
        $this->mapLatitude = (float)$data['map_latitude'];
        $this->enabled = (bool)$data['enabled'];
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
}
