<?php

class Connection
{
    private ?Location $nodeOne;
    private ?Location $nodeTwo;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private LocationRepository $locationRepository,
        private int $id,
        ?int $nodeOne = null,
        ?int $nodeTwo = null,
        private bool $enabled = true,

    ) {
        $this->locationRepository = $locationRepository;
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

    public function setNodeOne(?int $nodeOne): void
    {
        if ($nodeOne != null) {
            $this->nodeOne = $this->locationRepository->get($nodeOne);
        } else {
            $this->nodeOne = null;
        }
    }

    public function setNodeTwo(?int $nodeTwo): void
    {
        if ($nodeTwo != null) {
            $this->nodeTwo = $this->locationRepository->get($nodeTwo);
        } else {
            $this->nodeTwo = null;
        }
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
