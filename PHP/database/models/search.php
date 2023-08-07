<?php
require_once "Location.php";
require_once "Device.php";

class Search
{
    private ?string $timestamp;
    public function __construct(
        private int $id,
        private ?string $search = "",
        private ?Location $location = null,
        private ?Device $device = null,
    ) {
        $this->setId($id);
        $this->setSearch($search);
        $this->setLocation($location);
        $this->setDevice($device);
        $this->timestamp = date('Y-m-d H:i:s');
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getSearch(): string
    {
        return $this->search;
    }
    public function getLocation(): ?Location
    {
        return $this->location;
    }
    public function getDevice(): ?Device
    {
        return $this->device;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setSearch(string $search): void
    {
        $this->search = $search;
    }
    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }
    public function setDevice(?Device $device): void
    {
        $this->device = $device;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "search" => $this->getSearch(),
            "location" => $this->getLocation(),
            "device" => $this->getDevice(),
            "TimeStamp" => $this->getTimestamp(),
        ];
    }
}
