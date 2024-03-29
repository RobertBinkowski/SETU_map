<?php

class Details implements JsonSerializable
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
        private ?string $name,
        private ?string $abbreviation,
        private ?string $info,
        private ?float $size,
        private ?string $src,
    ) {
        $this->id = $id;
        $this->setName($name);
        $this->setAbbreviation($abbreviation);
        $this->setInfo($info);
        $this->setSize($size);
        $this->setSrc($src);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    // Setters

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setAbbreviation(?string $abbreviation): void
    {
        $this->abbreviation = $abbreviation;
    }

    public function setInfo(?string $info): void
    {
        $this->info = $info;
    }

    public function setSize(?float $size): void
    {
        $this->size = $size;
    }

    public function setSrc(?string $src): void
    {
        $this->src = $src;
    }


    // to Array
    public function toArray(): array
    {

        $data =  [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "abbreviation" => $this->getAbbreviation(),
            "info" => $this->getInfo(),
            "size" => $this->getSize(),
            "src" => $this->getSrc(),
        ];

        return $data;
    }
}
