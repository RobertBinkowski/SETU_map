<?php

class Room
{
    private ?Building $building = null;
    private ?Location $location = null;
    private ?Floor $floor = null;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * 
     * Constructs a new instance of a Room object
     * 
     * @param int $id 
     * @param string $type 
     * @param string $name 
     * @param string $info 
     * @param float $size 
     * @param int $building 
     * @param int $location 
     * @param int $floor 
     * @param bool $enabled
     * @return void
     */
    public function __construct(
        private BuildingRepository $buildingRepository,
        private LocationRepository $locationRepository,
        private FloorRepository $floorRepository,
        private int $id,
        private string $type = "",
        private string $name = "",
        private string $info = "",
        private float $size = 0,
        private string $layout = "",
        ?int $building = null,
        ?int $location = null,
        ?int $floor = null,
        private bool $enabled = true,
    ) {
        $this->buildingRepository = $buildingRepository;
        $this->locationRepository = $locationRepository;
        $this->floorRepository = $floorRepository;

        $this->id = $id;
        $this->setEnabled($enabled);

        $this->setType($type);
        $this->setName($name);
        $this->setInfo($info);
        $this->setSize($size);
        $this->setLayout($layout);
        $this->setBuilding($building);
        $this->setLocation($location);
        $this->setFloor($floor);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function getFloor(): ?Floor
    {
        return $this->floor;
    }
    public function getLayout(): ?string
    {
        return $this->layout;
    }

    // Setters
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    public function setSize(float $size): void
    {
        $this->size = $size;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function setBuilding(?int $building = null): void
    {
        if ($building !== null) {
            $this->building =  $this->buildingRepository->get($building);
        } else {
            $this->building = null;
        }
    }

    public function setLocation(?int $location = null): void
    {
        if ($location !== null) {
            $this->location = $this->locationRepository->get($location);
        } else {
            $this->location = null;
        }
    }

    public function setFloor(?int $floor = null): void
    {
        if ($floor !== null) {
            $this->floor = $this->floorRepository->get($floor);
        } else {
            $this->floor = null;
        }
    }

    // To Array
    public function toArray(): array
    {
        $data =  [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "name" => $this->getName(),
            "info" => $this->getInfo(),
            "size" => $this->getSize(),
            "enabled" => $this->isEnabled(),
            "layout" => $this->getLayout(),
        ];
        if ($this->building) {
            $data["building"] = $this->getBuilding()->toArray();
        }
        if ($this->location) {
            $data["location"] = $this->getLocation()->toArray();
        }
        if ($this->floor) {
            $data["floor"] = $this->getFloor()->toArray();
        }
        return $data;
    }
}
