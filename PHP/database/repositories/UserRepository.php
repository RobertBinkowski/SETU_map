<?php

class UserRepository extends BaseRepository
{
    private CampusRepository $campusRepository;

    public function __construct(
        Database $conn,
        CampusRepository $campusRepository
    ) {
        parent::__construct($conn);
        $this->campusRepository = $campusRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM users";

        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach ($data as $row) {
            $user = new User(
                $this->campusRepository,
                $row['id'],
                $row['username'] ?? "",
                $row['email'] ?? "",
                $row['password'] ?? "",
                $row['privileges'] ?? "",
                $row['campus_id'] ?? 0,
                $row['created'] ?? "",
                $row['enabled'] ?? true,
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
                $this->campusRepository,
                $data['id'],
                $data['username'] ?? "",
                $data['email'] ?? "",
                $data['password'] ?? "",
                $data['privileges'] ?? "",
                $data['campus_id'] ?? 0,
                $data['created'] ?? "",
                $data['enabled'] ?? true,
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
                $this->campusRepository,
                $data['id'],
                $data['username'] ?? "",
                $data['email'] ?? "",
                $data['password'] ?? "",
                $data['privileges'] ?? "",
                $data['campus_id'] ?? 0,
                $data['created'] ?? "",
                $data['enabled'] ?? true,
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
