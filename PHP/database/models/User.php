<?php


class User
{
    private int $id;
    private bool $enabled;
    private string $username;
    private string $email;
    private string $password;
    private string $privileges;

    private string $created;
    private int $campus;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $password,
        string $privileges,
        int $campus,
        string $created = "",
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->setEnabled($enabled);

        $this->setUsername($username);
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
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPrivileges(): string
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
    public function getCampus()
    {
        return $this->campus;
    }

    // Setters
    public function setUsername($username): void
    {
        $this->username = $username;
    }
    public function setPassword($password): void
    {
        $this->password = hashPassword($password);
    }
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    public function setPrivileges($privileges): void
    {
        $this->privileges = $privileges;
    }
    public function setEnabled($enabled): void
    {
        $this->enabled = $enabled;
    }
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    // To Array
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'enabled' => $this->isEnabled(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'privileges' => $this->getPrivileges(),
            'created' => $this->getCreated(),
            'campus' => $this->getCampus(),
        ];
    }
}
