<?php


class User
{

    private ?Campus $campus;

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function __construct(
        private CampusRepository $campusRepository,
        private int $id,
        private string $username = "",
        private string $email = "",
        private string $password = "",
        private string $privileges = "",
        ?int $campus = null,
        private string $created = "",
        private bool $enabled = true,
    ) {
        $this->campusRepository = $campusRepository;

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
    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    // Setters
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPrivileges(string $privileges): void
    {
        $this->privileges = $privileges;
    }
    public function setEnabled(bool $enabled = true): void
    {
        $this->enabled = $enabled;
    }
    public function setCampus(?int $campus): void
    {
        if ($campus != null) {
            $this->campus = $this->campusRepository->get($campus);
        } else {
            $this->campus = null;
        }
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
            'privileges' => $this->getPrivileges(),
            'created' => $this->getCreated(),
        ];
        if ($this->campus) {
            $data['campus'] = $this->getCampus()->toArray();
        }

        return $data;
    }
}
