<?php

class userGateway
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM Users";

        $statement = $this->conn->query($sql);

        $data = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $row["enabled"] = (bool)$row["enabled"]; // Set to Boolean
            $data[] = $row;
        }
        return $data;
    }
    public function create(array $data): string
    {
        $sql = "INSERT INTO users (enabled ,username, email, password, privileges) VALUES (enabled,:username, :email, :password, :privileges)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":username", $data["username"], PDO::PARAM_STR);
        $statement->bindValue(":email", $data["email"], PDO::PARAM_STR);
        $statement->bindValue(":password", $data["password"], PDO::PARAM_STR);
        $statement->bindValue(":privileges", $data["privileges"], PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
        }

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE users SET username = :username, password = :password, email = :email, enabled = :enabled, privileges = :privileges WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":username", $new["username"] ?? $current["username"], PDO::PARAM_STR);
        $statement->bindValue(":password", $new["password"] ?? $current["password"], PDO::PARAM_STR);
        $statement->bindValue(":email", $new["email"] ?? $current["email"], PDO::PARAM_STR);
        $statement->bindValue(":enabled", $new["enabled"] ?? $current["enabled"], PDO::PARAM_BOOL);
        $statement->bindValue(":privileges", $new["privileges"] ?? $current["privileges"], PDO::PARAM_STR);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE users SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM users WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }
}
