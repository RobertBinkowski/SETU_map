<?php

class UserRepository extends BaseRepository
{

    public function __construct(
        Database $conn,
    ) {
        parent::__construct($conn);
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT users.*, campuses.id as campus
                FROM users
                LEFT JOIN campuses ON users.campus = campuses.id
                ";

        // if (!$disabled) {
        //     $sql .= " WHERE enabled = 1";
        // }

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;

        $users = [];

        foreach ($data as $row) {
            $user = new User(
                $row['id'],
                $row['enabled'] ?? true,
                $row['email'] ?? "",
                $row['name'] ?? "",
                $row['password'] ?? "",
                $row['created'] ?? "",
                $row['privileges'] ?? "",
                $row['campus'] ?? null,
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
                $data['enabled'] ?? true,
                $data['email'] ?? "",
                $data['name'] ?? "",
                $data['password'] ?? "",
                $data['created'] ?? "",
                $data['privileges'] ?? "",
                $data['campus'] ?? null,
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
                $data['enabled'] ?? true,
                $data['email'] ?? "",
                $data['name'] ?? "",
                $data['password'] ?? "",
                $data['created'] ?? "",
                $data['privileges'] ?? "",
                $data['campus'] ?? null,
            );
        }

        return false;
    }

    public function findByEmail(string $email): User|false
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $data = $this->fetch($sql, [':email' => $email]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new User(
                $data['id'],
                $data['enabled'] ?? true,
                $data['email'] ?? "",
                $data['name'] ?? "",
                $data['password'] ?? "",
                $data['created'] ?? "",
                $data['privileges'] ?? "",
                $data['campus'] ?? null,
            );
        }

        return false;
    }
    public function update(User $current, array $new): bool
    {
        $sql = "UPDATE users SET username = :username, password = :password, email = :email, enabled = :enabled, privileges = :privileges WHERE ID =:ID";

        return $this->execute($sql, [
            ':username' => $new['username'] ?? $current->getUsername(),
            ':password' => $new['password'] ?? $current->getPassword(),
            ':email' => $new['email'] ?? $current->getEmail(),
            ':enabled' => $new['enabled'] ?? $current->isEnabled(),
            ':privileges' => $new['privileges'] ?? $current->getPrivileges(),
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
