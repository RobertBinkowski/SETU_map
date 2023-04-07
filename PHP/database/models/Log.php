<?php
class Log
{
    private int $id;
    private string $title;
    private string $type;
    private string $info;

    public function __construct(
        int $id,
        string $title,
        string $type,
        string $info
    ) {
        $this->setId($id);
        $this->setInfo($info);
        $this->setTitle($title);
        $this->setType($type);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function getInfo(): string
    {
        return $this->info;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    // to Array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "title" => $this->getTitle(),
            "info" => $this->getInfo()
        ];
    }
}
