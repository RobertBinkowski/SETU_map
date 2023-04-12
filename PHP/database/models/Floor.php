<?php

class Floor
{
    private ?Building $building;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private BuildingRepository $buildingRepository,
        private int $id,
        private string $size = "",
        private int $floor = 0,
        private string $layout = "",
        ?int $building = null,
        private bool $enabled = true,
    ) {
        $this->buildingRepository = $buildingRepository;
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setSize($size);
        $this->setLayout($layout);
        $this->setBuilding($building);
        $this->setFloor($floor);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function getFloor(): string
    {
        return $this->floor;
    }
    public function getLayout(): ?string
    {
        return $this->layout;
    }

    // Setters

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function setBuilding(?int $building = null): void
    {
        if ($building != null) {
            $this->building = $this->buildingRepository->get($building);
        } else {
            $this->building = null;
        }
    }

    public function setFloor(int $floor): void
    {
        $this->floor = $floor;
    }

    // To Array
    function toArray(): array
    {
        $data = [
            "id" => $this->getId(),
            "enabled" => $this->isEnabled(),
            "size" => $this->getSize(),
            "floor" => $this->getFloor(),
            'layout' => $this->getLayout(),
        ];
        if ($this->building) {
            $data['building'] = $this->getBuilding()->toArray();
        }
        return $data;
    }
}
