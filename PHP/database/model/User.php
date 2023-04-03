<?php

class User
{
    private int $id;
    private bool $enabled;
    private string $username;
    private string $email;
    private string $password;
    private string $privileges;

    public function __construct(int $id, bool $enabled, string $username, string $email, string $password, string $privileges)
    {
        $this->id = $id;
        $this->enabled = $enabled;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->privileges = $privileges;
    }


    // Getters
    public function getID()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPrivileges()
    {
        return $this->privileges;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getEnabled()
    {
        return $this->enabled;
    }

    // Setters
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPrivileges($privileges)
    {
        $this->privileges = $privileges;
    }
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}
