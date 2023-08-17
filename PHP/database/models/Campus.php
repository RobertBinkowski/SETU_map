<?php

include_once "Coordinates.php";
include_once "Details.php";

class Campus implements JsonSerializable
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
        private ?Coordinates $coordinates = null,
        private ?Coordinates $entrance = null,
        private ?Details $details = null,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setCoordinates($coordinates);
        $this->setEntrance($entrance);
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

    public function getCoordinates(): ?Coordinates
    {
        return $this->coordinates;
    }

    public function getDetails(): ?Details
    {
        return $this->details;
    }
    public function setEntrance(?Coordinates $entrance): void
    {
        $this->entrance = $entrance;
    }


    // Setters
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setCoordinates(?Coordinates $Coordinates): void
    {
        $this->coordinates = $Coordinates;
    }

    public function setDetails(?Details $details): void
    {
        $this->details = $details;
    }
    public function getEntrance(): ?Coordinates
    {
        return $this->entrance;
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
        ];
        if ($this->coordinates) {
            $data['coordinates'] = $this->getCoordinates()->toArray();
        }
        if ($this->entrance) {
            $data['entrance'] = $this->getEntrance()->toArray();
        }
        if ($this->details) {
            $data['details'] = $this->getDetails()->toArray();
        }

        return $data;
    }
}
