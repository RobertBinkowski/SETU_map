<?php
require_once "Campus.php";

class Privileges implements JsonSerializable
{

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private int $id,
        private string $name = "",
        private ?PrivilegeValue $users = null,
        private ?PrivilegeValue $logs = null,
        private ?PrivilegeValue $searches = null,
        private ?PrivilegeValue $details = null,
        private ?PrivilegeValue $images = null,
    ) {
        $this->id = $id;
        $this->setName($name);
        $this->setUsers($users);
        $this->setLogs($logs);
        $this->setSearches($searches);
        $this->setDetails($details);
        $this->setImages($images);
    }


    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getUsers(): ?string
    {
        return $this->users->getValue();
    }
    public function getLogs(): ?string
    {
        return $this->logs->getValue();
    }
    public function getSearches(): ?string
    {
        return $this->searches->getValue();
    }
    public function getDetails(): ?string
    {
        return $this->details->getValue();
    }
    public function getImages(): ?string
    {
        return $this->images->getValue();
    }



    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setUsers(?PrivilegeValue $users): void
    {
        $this->users = $users;
    }
    public function setLogs(?PrivilegeValue $logs): void
    {
        $this->logs = $logs;
    }
    public function setSearches(?PrivilegeValue $searches): void
    {
        $this->searches = $searches;
    }
    public function setDetails(?PrivilegeValue $details): void
    {
        $this->details = $details;
    }
    public function setImages(?PrivilegeValue $images): void
    {
        $this->images = $images;
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "users" => $this->getUsers(),
            "logs" => $this->getLogs(),
            "searches" => $this->getSearches(),
            "details" => $this->getDetails(),
            "images" => $this->getImages(),
        ];

        return $data;
    }
}
