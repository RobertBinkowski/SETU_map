<?php
require_once "Campus.php";

class User implements JsonSerializable
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
        private bool $enabled = true,
        private string $email = "",
        private string $name = "",
        private string $password = "",
        private string $created = "",
        private ?Privileges $privileges = null,
        private ?Campus $campus = null,
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->setEnabled($enabled);
        $this->setUsername($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPrivileges($privileges);
        $this->setCampus($campus);
    }


    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getUsername(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPrivileges(): Privileges|null
    {
        return $this->privileges;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
    public function getCreated(): string
    {
        return $this->created;
    }
    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    // Setters
    public function setUsername(string $username): void
    {
        $this->name = $username;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPrivileges(?Privileges $privileges): void
    {
        $this->privileges = $privileges;
    }
    public function setEnabled(bool $enabled = true): void
    {
        $this->enabled = $enabled;
    }

    public function setCampus(?Campus $campus = null): void
    {
        $this->campus = $campus;
    }

    // To Array
    public function toArray(): array
    {
        $data = [
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'created' => $this->getCreated(),
        ];

        if ($this->getCampus()) {
            $data['campus'] = $this->getCampus()->toArray();
        }

        if ($this->getPrivileges()) {
            $data['privileges'] = $this->getPrivileges()->toArray();
        }

        return $data;
    }
}
