<?php

class Connection
{
    private int $id;
    private bool $enabled;
    private float $distance;
    private int $nodeOneId;
    private int $nodeTwoId;

    public function __construct(int $id, bool $enabled, float $distance, int $nodeOneId, int $nodeTwoId)
    {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->distance = $distance;
        $this->nodeOneId = $nodeOneId;
        $this->nodeTwoId = $nodeTwoId;
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

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function getNodeOneId(): int
    {
        return $this->nodeOneId;
    }

    public function getNodeTwoId(): int
    {
        return $this->nodeTwoId;
    }

    // Setters
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    public function setNodeOneId(int $nodeOneId): void
    {
        $this->nodeOneId = $nodeOneId;
    }

    public function setNodeTwoId(int $nodeTwoId): void
    {
        $this->nodeTwoId = $nodeTwoId;
    }
}
