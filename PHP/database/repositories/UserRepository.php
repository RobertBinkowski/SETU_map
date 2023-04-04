<?php


class UserRepository
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM users WHERE `enabled`='1'";

        $statement = $this->conn->query($sql);

        $data = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $row["enabled"] = (bool)$row["enabled"]; // Set to Boolean
            $data[] = new User(
                $row["id"],
                $row["enabled"],
                $row["username"],
                $row["email"],
                $row["password"],
                $row["privileges"]
            );
        }
        $data = array_map(function (User $user) {
            return $user->toArray();
        }, $data);
        return $data;
    }
    public function create(User $user): bool
    {
        $sql = "INSERT INTO users (enabled ,username, email, password, privileges) VALUES (enabled,:username, :email, :password, :privileges)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $statement->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $statement->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $statement->bindValue(":privileges", $user->getPrivileges(), PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId() > 0;
    }

    public function get(int $id): User|false
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new User(
                $data["id"],
                $data["enabled"],
                $data["username"],
                $data["email"],
                $data["password"],
                $data["privileges"]
            );
        }

        return false;
    }

    public function update(User $current, User $new): bool
    {
        $sql = "UPDATE users SET username = :username, password = :password, email = :email, enabled = :enabled, privileges = :privileges WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":username", $new->getUsername() ?? $current->getUsername(), PDO::PARAM_STR);
        $statement->bindValue(":password", $new->getPassword() ?? $current->getPassword(), PDO::PARAM_STR);
        $statement->bindValue(":email", $new->getEmail() ?? $current->getEmail(), PDO::PARAM_STR);
        $statement->bindValue(":enabled", $new->getEnabled() ?? $current->getEnabled(), PDO::PARAM_BOOL);
        $statement->bindValue(":privileges", $new->getPrivileges() ?? $current->getPrivileges(), PDO::PARAM_STR);

        $statement->bindValue(":ID", $current->getID(), PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE users SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM users WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }
}
