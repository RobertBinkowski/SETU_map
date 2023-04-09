<?php

class UserRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM users";

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach ($data as $row) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['password'],
                $row['privileges'],
                $row['campus_id'],
                (string)$row['created'],
                $row['enabled'],
            );
            $users[] = $user;
        }

        return $users;
    }

    public function create(User $user): bool
    {
        $sql = "INSERT INTO users (enabled ,username, email, password, privileges) VALUES (enabled,:username, :email, :password, :privileges)";

        return $this->execute($sql, [
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':privileges' => $user->getPrivileges(),
        ]);
    }

    public function get(int $id): User|false
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new User(
                $data['id'],
                $data['username'],
                $data['email'],
                $data['password'],
                $data['privileges'],
                $data['campus_id'],
                (string)$data['created'],
                $data['enabled'],
            );
        }

        return false;
    }

    public function getByCampus(int $id): User|false
    {
        $sql = "SELECT * FROM users WHERE campus_id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new User(
                $data['id'],
                $data['username'],
                $data['email'],
                $data['password'],
                $data['privileges'],
                $data['campus_id'],
                (string)$data['created'],
                $data['enabled'],
            );
        }

        return false;
    }
    public function update(User $current, User $new): bool
    {
        $sql = "UPDATE users SET username = :username, password = :password, email = :email, enabled = :enabled, privileges = :privileges WHERE ID =:ID";

        return $this->execute($sql, [
            ':username' => $new->getUsername() ?? $current->getUsername(),
            ':password' => $new->getPassword() ?? $current->getPassword(),
            ':email' => $new->getEmail() ?? $current->getEmail(),
            ':enabled' => $new->isEnabled() ?? $current->isEnabled(),
            ':privileges' => $new->getPrivileges() ?? $current->getPrivileges(),
            ':ID' => $current->getID(),
        ]);
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE users SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $id,
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM users WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
