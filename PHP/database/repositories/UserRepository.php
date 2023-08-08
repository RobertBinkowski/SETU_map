<?php

class UserRepository extends BaseRepository
{

    private CampusRepository $campusRepository;
    private PrivilegesRepository $privilegesRepository;

    public function __construct(
        Database $conn,
        CampusRepository $campusRepository,
        PrivilegesRepository $privilegesRepository
    ) {
        parent::__construct($conn);
        $this->campusRepository = $campusRepository;
        $this->privilegesRepository = $privilegesRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM users";
        $params = [];

        if (!$disabled) {
            $sql .= " WHERE enabled = :enabled";
            $params = ['enabled' => 1];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydrate($data);
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


    public function get(string $id): User
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $this->hydrateRow($data);
    }


    // public function findByEmail(string $email): User|false
    // {
    //     $sql = "SELECT * FROM users WHERE email = :email";

    //     $data = $this->fetch($sql, [':email' => $email]);

    //     if ($data !== false) {
    //         $data["enabled"] = (bool)$data["enabled"];
    //         return new User(
    //             $data['id'],
    //             $data['enabled'] ?? true,
    //             $data['email'] ?? "",
    //             $data['name'] ?? "",
    //             $data['password'] ?? "",
    //             $data['created'] ?? "",
    //             $data['privileges'] ?? "",
    //             $data['campus'] ?? null,
    //         );
    //     }

    //     return false;
    // }
    // public function update(User $current, array $new): bool
    // {
    //     $sql = "UPDATE users SET username = :username, password = :password, email = :email, enabled = :enabled, privileges = :privileges WHERE ID =:ID";

    //     return $this->execute($sql, [
    //         ':username' => $new['username'] ?? $current->getUsername(),
    //         ':password' => $new['password'] ?? $current->getPassword(),
    //         ':email' => $new['email'] ?? $current->getEmail(),
    //         ':enabled' => $new['enabled'] ?? $current->isEnabled(),
    //         ':privileges' => $new['privileges'] ?? $current->getPrivileges(),
    //         ':ID' => $current->getID(),
    //     ]);
    // }

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

    private function hydrate(array $data): array
    {
        $output = [];
        foreach ($data as $row) {
            $output[] = $this->hydrateRow($row);
        }
        return $output;
    }

    private function hydrateRow(array $row): User
    {

        $campus = null;
        $privileges = null;
        if ($row['campus'] !== null) {
            $campus = $this->campusRepository->get($row['campus']);
        }
        if ($row['privileges'] !== null) {
            $privileges = $this->privilegesRepository->get($row['privileges']);
        }

        return new User(
            $row['id'],
            $row['enabled'] ?? true,
            $row['email'] ?? "",
            $row['name'] ?? "",
            $row['password'] ?? "",
            $row['created'] ?? "",
            $privileges,
            $campus,
        );
    }
}
