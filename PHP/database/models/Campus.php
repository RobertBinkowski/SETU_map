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
        string $name,
        string $layout = "",
        string $info = "",
        float $size = 0,
        float $height = 0,
        float $width = 0,
        string $abbreviation = "",
        bool $enabled = true,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setName($name);
        $this->setAbbreviation($abbreviation);
        $this->setInfo($info);
        $this->setSize($size);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLayout($layout);
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
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
            'name' => $this->getName(),
            'abbreviation' => $this->getAbbreviation(),
            'info' => $this->getInfo(),
            'size' => $this->getSize(),
            'height' => $this->getHeight(),
            'width' => $this->getWidth(),
            'layout' => $this->getLayout(),
        ];
    }
}
