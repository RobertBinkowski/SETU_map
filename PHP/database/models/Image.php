<?php
include_once "Details.php";

class Image
{

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private int $id,
        private bool $enabled = true,
        private string $name = "",
        private string $src = "",
        private ?Details $details = null,
    ) {
        $this->id = $id;
        $this->setEnabled($enabled);
        $this->setName($name);
        $this->setSrc($src);
        $this->setDetails($details);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
    public function getDetails(): ?Details
    {
        return $this->details;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
    public function setDetails(?Details $details): void
    {
        $this->details = $details;
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            "id" => $this->getId(),
            "enabled" => $this->isEnabled(),
            "name" => $this->getName(),
            "src" => $this->getSrc(),
        ];
        if ($this->details) {
            $data["details"] = $this->getDetails()->toArray();
        }

        return $data;
    }
}
