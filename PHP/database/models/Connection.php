<?php
require_once "Location.php";

class Connection
{

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private int $id,
        private bool $enabled = true,
        private ?Location $nodeOne = null,
        private ?Location $nodeTwo = null,

    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setNodeOne($nodeOne);
        $this->setNodeTwo($nodeTwo);
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


    public function getNodeOne(): ?Location
    {
        return $this->nodeOne;
    }

    public function getNodeTwo(): ?Location
    {
        return $this->nodeTwo;
    }

    // Setters
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setNodeOne(?Location $nodeOne): void
    {
        $this->nodeOne = $nodeOne;
    }

    public function setNodeTwo(?Location $nodeTwo): void
    {
        $this->nodeTwo = $nodeTwo;
    }

    // to Array
    public function toArray(): array
    {
        $data =  [
            "id" => $this->getId(),
            "enabled" => $this->isEnabled(),
        ];
        if ($this->nodeOne) {
            $data['locationOne'] = $this->getNodeOne()->toArray();
        }
        if ($this->nodeTwo) {
            $data['locationTwo'] = $this->getNodeTwo()->toArray();
        }

        return $data;
    }
}
