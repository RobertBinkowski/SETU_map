<?php


class Room
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM room WHERE `enabled`='1'";

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
        $sql = "INSERT INTO room (enabled , type, name, info, size, building_id, location_id, floor_id) VALUES (enabled,:type, :name, :info, :size, :building_id, :location_id, :floor_id)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":type", $data["type"], PDO::PARAM_STR);
        $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindValue(":info", $data["info"], PDO::PARAM_STR);
        $statement->bindValue(":size", $data["size"], PDO::PARAM_STR);
        $statement->bindValue(":building_id", $data["building_id"], PDO::PARAM_STR);
        $statement->bindValue(":location_id", $data["location_id"], PDO::PARAM_STR);
        $statement->bindValue(":floor_id", $data["floor_id"], PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM room WHERE id = :id";

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
        $sql = "UPDATE room SET type = :type, name = :name, info = :info, enabled = :enabled, size = :size, building_id= :building_id, location_id = :location_id, floor_id = :floor_id WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":type", $new["type"] ?? $current["type"], PDO::PARAM_STR);
        $statement->bindValue(":name", $new["name"] ?? $current["name"], PDO::PARAM_STR);
        $statement->bindValue(":info", $new["info"] ?? $current["info"], PDO::PARAM_STR);
        $statement->bindValue(":enabled", $new["enabled"] ?? $current["enabled"], PDO::PARAM_BOOL);
        $statement->bindValue(":size", $new["size"] ?? $current["size"], PDO::PARAM_STR);
        $statement->bindValue(":building_id", $new["building_id"], PDO::PARAM_STR);
        $statement->bindValue(":location_id", $new["location_id"], PDO::PARAM_STR);
        $statement->bindValue(":floor_id", $new["floor_id"], PDO::PARAM_STR);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE room SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM room WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }
}
