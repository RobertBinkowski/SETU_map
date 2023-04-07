<?php
class Building
{
    private int $id;
    private bool $enabled;
    private string $name;
    private string $abbreviation;
    private string $info;
    private string $size;
    private int $campus;

    public function __construct(
        int $id,
        string $name,
        string $abbreviation,
        string $info,
        string $size,
        int $campus,
        bool $enabled = true,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setName($name);
        $this->setAbbreviation($abbreviation);
        $this->setInfo($info);
        $this->setSize($size);
        $this->setCampus($campus);
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

    public function getCampus(): int
    {
        return $this->campus;
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

    public function setCampus(int $campus): void
    {
        $this->campus = $campus;
    }

    // To Array
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
            'name' => $this->getName(),
            'abbreviation' => $this->getAbbreviation(),
            'info' => $this->getInfo(),
            'size' => $this->getSize(),
            'campus' => $this->getCampus(),
        ];
    }
}
