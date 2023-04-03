<?php
class Campus
{
    private int $id;
    private bool $enabled;
    private string $name;
    private string $abbreviation;
    private string $info;
    private string $size;

    public function __construct(int $id, bool $enabled, string $name, string $abbreviation, string $info, string $size)
    {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->info = $info;
        $this->size = $size;
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
}
