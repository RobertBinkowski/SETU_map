<?php
class Building
{
    private int $id;
    private bool $enabled;
    private string $name;
    private string $abbreviation;
    private string $info;
    private string $size;
    private int $campusId;

    public function __construct(int $id, bool $enabled, string $name, string $abbreviation, string $info, string $size, int $campusId)
    {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->info = $info;
        $this->size = $size;
        $this->campusId = $campusId;
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

    public function getCampusId(): int
    {
        return $this->campusId;
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

    public function setCampusId(int $campusId): void
    {
        $this->campusId = $campusId;
    }

    // To Array
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'enabled' => $this->enabled,
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'info' => $this->info,
            'size' => $this->size,
            'campus' => $this->campusId,
        ];
    }
}
