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
        bool $enabled,
        string $username,
        string $email,
        string $password,
        string $privileges,
        string $created,
        int $campus,
    ) {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->privileges = $privileges;
        $this->created = $created;
        $this->campus = $campus;
    }


    // Getters
    public function getID(): int
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

    // Setters
    public function setUsername($username): void
    {
        $this->username = $username;
    }
    public function setPassword($password): void
    {
        $this->password = $password;
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

    // To Array
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'enabled' => $this->enabled,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'privileges' => $this->privileges,
            'created' => $this->created,
        ];
    }
}
