<?php

class Connection
{
    private int $id;
    private bool $enabled;
    private int $nodeOne;
    private int $nodeTwo;

    public function __construct(
        int $id,
        int $nodeOne,
        int $nodeTwo,
        bool $enabled = true,

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


    public function getNodeOne(): int
    {
        return $this->nodeOne;
    }

    public function getNodeTwo(): int
    {
        return $this->nodeTwo;
    }

    // Setters
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setNodeOne(int $nodeOne): void
    {
        $this->nodeOne = $nodeOne;
    }

    public function setNodeTwo(int $nodeTwo): void
    {
        $this->nodeTwo = $nodeTwo;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "nodeOne" => $this->getNodeOne(),
            "nodeTwo" => $this->getNodeTwo(),
            "enabled" => $this->isEnabled(),
        ];
    }
}
