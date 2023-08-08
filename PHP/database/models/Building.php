<?php
include_once "Campus.php";
include_once "Location.php";
include_once "Details.php";

class Building implements JsonSerializable
{

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __construct(
        private int $id,
        private bool $enabled = true,
        private ?Campus $campus = null,
        private ?Location $location = null,
        private ?Details $details = null,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setCampus($campus);
        $this->setLocation($location);
        $this->setDetails($details);
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

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function getDetails(): ?Details
    {
        return $this->details;
    }

    // Setters
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setCampus(?Campus $campus): void
    {
        $this->campus = $campus;
    }

    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }

    public function setDetails(?Details $details): void
    {
        $this->details = $details;
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
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
