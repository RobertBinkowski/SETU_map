<?php
class Log
{
    private int $id;
    private string $title;
    private string $type;
    private string $info;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->title = $data['title'];
        $this->type = $data['type'];
        $this->info = $data['info'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function setInfo(string $info): void
    {
        $this->info = $info;
    }
}
