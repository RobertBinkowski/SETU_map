<?php


class Image
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM images WHERE `enabled`='1'";

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
        $sql = "INSERT INTO images (enabled ,name, info, src, campus_id,building_id, room_id) VALUES (enabled,:name, :info, :src, :campus_id, :building_id ,:room_id)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindValue(":info", $data["info"], PDO::PARAM_STR);
        $statement->bindValue(":src", $data["src"], PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $data["campus_id"], PDO::PARAM_STR);
        $statement->bindValue(":building_id", $data["building_id"], PDO::PARAM_STR);
        $statement->bindValue(":room_id", $data["room_id"], PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM images WHERE id = :id";

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
        $sql = "UPDATE images SET name = :name, src = :src, info = :info, enabled = :enabled, campus_id = :campus_id WHERE ID =:ID, building_id = :building_id , room_id= :room_id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $new["name"] ?? $current["name"], PDO::PARAM_STR);
        $statement->bindValue(":src", $new["src"] ?? $current["src"], PDO::PARAM_STR);
        $statement->bindValue(":info", $new["info"] ?? $current["info"], PDO::PARAM_STR);
        $statement->bindValue(":enabled", $new["enabled"] ?? $current["enabled"], PDO::PARAM_BOOL);
        $statement->bindValue(":campus_id", $new["campus_id"] ?? $current["campus_id"], PDO::PARAM_STR);
        $statement->bindValue(":building_id", $new["building_id"] ?? $current["building_id"], PDO::PARAM_STR);
        $statement->bindValue(":room_id", $new["room_id"] ?? $current["room_id"], PDO::PARAM_STR);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE images SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM images WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }
}
