<?php

class Image
{
    private int $id;
    private string $name;
    private string $info;
    private string $src;
    private bool $enabled;
    private int $campus;
    private int $building;
    private int $room;

    public function __construct(
        int $id,
        string $name,
        string $info,
        string $src,
        int $campus,
        int $building,
        int $room,
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->setName($name);
        $this->setInfo($info);
        $this->setSrc($src);
        $this->setEnabled($enabled);
        $this->setCampus($campus);
        $this->setBuilding($building);
        $this->setRoom($room);
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

    public function getCampus(): int
    {
        return $this->campus;
    }

    public function getBuilding(): int
    {
        return $this->building;
    }

    public function getRoom(): int
    {
        return $this->room;
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

    public function setCampus(int $campus): void
    {
        $this->campus = $campus;
    }

    public function setBuilding(int $building): void
    {
        $this->building = $building;
    }

    public function setRoom(int $room): void
    {
        $this->room = $room;
    }

    // To Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "info" => $this->getInfo(),
            "src" => $this->getSrc(),
            "enabled" => $this->isEnabled(),
            "campus" => $this->getCampus(),
            "building" => $this->getBuilding(),
            "room" => $this->getRoom(),
        ];
    }
}
