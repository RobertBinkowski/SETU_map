<?php


class Building
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM buildings WHERE `enabled`='1'";

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
        $sql = "INSERT INTO buildings (enabled ,name, abbreviation, info, size, campus_id) VALUES (enabled,:name, :abbreviation, :info, :size, :campus_id)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $data["abbreviation"], PDO::PARAM_STR);
        $statement->bindValue(":info", $data["info"], PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $data["campus_id"], PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM buildings WHERE id = :id";

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
        $sql = "UPDATE buildings SET name = :name, info = :info, abbreviation = :abbreviation, enabled = :enabled, size = :size WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $new["name"] ?? $current["name"], PDO::PARAM_STR);
        $statement->bindValue(":info", $new["info"] ?? $current["info"], PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $new["abbreviation"] ?? $current["abbreviation"], PDO::PARAM_STR);
        $statement->bindValue(":enabled", $new["enabled"] ?? $current["enabled"], PDO::PARAM_BOOL);
        $statement->bindValue(":size", $new["size"] ?? $current["size"], PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $new["campus_id"] ?? $current["campus_id"], PDO::PARAM_STR);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE buildings SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM buildings WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }
}
