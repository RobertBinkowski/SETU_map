<?php


class Location
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM locations WHERE `enabled`='1'";

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
        $sql = "INSERT INTO locations (enabled , type, geo_longitude, geo_latitude, map_longitude, map_latitude, type) VALUES (enabled,:type, :geo_longitude, :geo_latitude, :map_longitude, :map_latitude, :type)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":type", $data["type"], PDO::PARAM_STR);
        $statement->bindValue(":geo_longitude", $data["geo_longitude"], PDO::PARAM_STR);
        $statement->bindValue(":geo_latitude", $data["geo_latitude"], PDO::PARAM_STR);
        $statement->bindValue(":map_longitude", $data["map_longitude"], PDO::PARAM_STR);
        $statement->bindValue(":map_latitude", $data["map_latitude"], PDO::PARAM_STR);
        $statement->bindValue(":type", $data["type"], PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM locations WHERE id = :id";

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
        $sql = "UPDATE locations SET type = :type, geo_longitude = :geo_longitude, geo_latitude = :geo_latitude, enabled = :enabled, map_longitude = :map_longitude, map_latitude= :map_latitude, type = :type WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":type", $new["type"] ?? $current["type"], PDO::PARAM_STR);
        $statement->bindValue(":geo_longitude", $new["geo_longitude"] ?? $current["geo_longitude"], PDO::PARAM_STR);
        $statement->bindValue(":geo_latitude", $new["geo_latitude"] ?? $current["geo_latitude"], PDO::PARAM_STR);
        $statement->bindValue(":enabled", $new["enabled"] ?? $current["enabled"], PDO::PARAM_BOOL);
        $statement->bindValue(":map_longitude", $new["map_longitude"] ?? $current["map_longitude"], PDO::PARAM_STR);
        $statement->bindValue(":map_latitude", $new["map_latitude"], PDO::PARAM_STR);
        $statement->bindValue(":type", $new["type"], PDO::PARAM_STR);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE locations SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM locations WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount();
    }
}
