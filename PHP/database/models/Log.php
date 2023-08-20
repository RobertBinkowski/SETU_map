<?
class Log implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __construct(
        private int $id,
        private string $title = "",
        private string $type = "info",
        private string $info = "",
        private ?string $timestamp = "",
    ) {
        $this->setId($id);
        $this->setInfo($info);
        $this->setTitle($title);
        $this->setType($type);
        $this->timestamp = $timestamp;
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

    public function getTimestamp(): string
    {
        return $this->timestamp;
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
    public function setTimestamp(?string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    // to Array
    public function toArray(): array
    {
        $data =  [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "title" => $this->getTitle(),
            "info" => $this->getInfo(),
            "TimeStamp" => $this->getTimestamp(),
        ];

        return $data;
    }
}
