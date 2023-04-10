<?php

class Image
{
    private ?Campus $campus;
    private ?Building $building;
    private ?Room $room;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private CampusRepository $campusRepository,
        private BuildingRepository $buildingRepository,
        private RoomRepository $roomRepository,
        private int $id,
        private string $name = "",
        private string $info = "",
        private string $src = "",
        ?int $campus = null,
        ?int $building = null,
        ?int $room = null,
        private bool $enabled = true
    ) {

        $this->campusRepository = $campusRepository;
        $this->buildingRepository = $buildingRepository;
        $this->roomRepository = $roomRepository;

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

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function getRoom(): ?Room
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

    public function setCampus(?int $campus): void
    {
        if ($campus != null) {
            $this->campus = $this->campusRepository->get($campus);
        } else {
            $this->campus = null;
        }
    }

    public function setBuilding(?int $building): void
    {
        if ($building != null) {
            $this->building = $this->buildingRepository->get($building);
        } else {
            $this->building = null;
        }
    }

    public function setRoom(?int $room): void
    {
        if ($room != null) {
            $this->room = $this->roomRepository->get($room);
        } else {
            $this->room = null;
        }
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "info" => $this->getInfo(),
            "src" => $this->getSrc(),
            "enabled" => $this->isEnabled(),
        ];
        if ($this->campus) {
            $data["campus"] = $this->getCampus()->toArray();
        }
        if ($this->building) {
            $data["building"] = $this->getBuilding()->toArray();
        }
        if ($this->room) {
            $data["room"] = $this->getRoom()->toArray();
        }

        return $data;
    }
}
