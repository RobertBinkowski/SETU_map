<?php
class Campus
{
    private int $id;
    private bool $enabled;
    private string $name;
    private string $abbreviation;
    private string $info;
    private float $size;
    private float $height;
    private float $width;
    private string $layout;


    public function __construct(
        int $id,
        bool $enabled = true,
        string $name = "",
        string $abbreviation = "",
        string $info = "",
        float $size = 0,
        float $height = 0,
        float $width = 0,
        string $layout = ""
    ) {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->info = $info;
        $this->size = $size;
        $this->height = $height;
        $this->width = $width;
        $this->layout = $layout;
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

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getLayout(): string
    {
        return $this->layout;
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

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
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
            'height' => $this->height,
            'width' => $this->width,
            'layout' => $this->layout,
        ];
    }
}
