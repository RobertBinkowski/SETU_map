<?php
class Building
{
    private ?Campus $campus;
    private ?Location $location;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Constructs a new instance of Building object
     * 
     * @param int $id
     * @param string $name
     * @param string $abbreviation
     * @param string $info
     * @param string $size
     * @param int $campus
     * @param bool $enabled
     */
    public function __construct(
        private CampusRepository $campusRepository,
        private LocationRepository $locationRepository,
        private int $id,
        private string $name = "",
        private string $abbreviation = "",
        private string $info = "",
        private string $size = "",
        ?int $campus = null,
        ?int $location = null,
        private bool $enabled = true,
    ) {
        $this->campusRepository = $campusRepository;
        $this->locationRepository = $locationRepository;
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setName($name);
        $this->setAbbreviation($abbreviation);
        $this->setInfo($info);
        $this->setSize($size);
        $this->setCampus($campus);
        $this->setLocation($location);
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    // Setters
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAbbreviation(string $abbreviation): void
    {
        $this->abbreviation = $abbreviation;
    }

    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function setCampus(?int $campus): void
    {
        if ($campus != null) {
            $this->campus = $this->campusRepository->get($campus);
        } else {
            $this->campus = null;
        }
    }
    public function setLocation(?int $location): void
    {
        if ($location != null) {
            $this->location = $this->locationRepository->get($location);
        } else {
            $this->location = null;
        }
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
            'name' => $this->getName(),
            'abbreviation' => $this->getAbbreviation(),
            'info' => $this->getInfo(),
            'size' => $this->getSize(),
        ];
        if ($this->campus) {
            $data['campus'] = $this->getCampus()->toArray();
        }
        if ($this->location) {
            $data['location'] = $this->getLocation()->toArray();
        }
        return $data;
    }
}
