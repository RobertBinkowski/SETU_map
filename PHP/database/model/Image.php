<?php

class Image
{
    private int $id;
    private string $name;
    private string $info;
    private string $src;
    private bool $enabled;
    private int $campusId;
    private int $buildingId;
    private int $roomId;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->name = $data['name'];
        $this->info = $data['info'];
        $this->src = $data['src'];
        $this->enabled = (bool)$data['enabled'];
        $this->campusId = (int)$data['campus_id'];
        $this->buildingId = (int)$data['building_id'];
        $this->roomId = (int)$data['room_id'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getCampusId(): int
    {
        return $this->campusId;
    }

    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setCampusId(int $campusId): void
    {
        $this->campusId = $campusId;
    }

    public function setBuildingId(int $buildingId): void
    {
        $this->buildingId = $buildingId;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }
}
