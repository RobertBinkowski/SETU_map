<?php

class BuildingRepository
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM buildings WHERE enabled = 1";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createBuilding(array $data): string
    {
        $sql = "INSERT INTO buildings (enabled, name, abbreviation, info, size, campus_id) 
                VALUES (:enabled, :name, :abbreviation, :info, :size, :campus_id)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", 1, PDO::PARAM_BOOL);
        $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $data["abbreviation"], PDO::PARAM_STR);
        $statement->bindValue(":info", $data["info"], PDO::PARAM_STR);
        $statement->bindValue(":size", $data["size"], PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $data["campus_id"], PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function getBuilding(string $id): array|false
    {
        $sql = "SELECT * FROM buildings WHERE id = :id AND enabled = 1";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $data !== false ? $data : false;
    }

    public function updateBuilding(string $id, array $data): bool
    {
        $sql = "UPDATE buildings SET name = :name, abbreviation = :abbreviation, info = :info, 
                size = :size, campus_id = :campus_id WHERE id = :id AND enabled = 1";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $data["abbreviation"], PDO::PARAM_STR);
        $statement->bindValue(":info", $data["info"], PDO::PARAM_STR);
        $statement->bindValue(":size", $data["size"], PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $data["campus_id"], PDO::PARAM_STR);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function disableBuilding(string $id): bool
    {
        $sql = "UPDATE buildings SET enabled = 0 WHERE id = :id AND enabled = 1";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function deleteBuilding(string $id): bool
    {
        $sql = "DELETE FROM buildings WHERE id = :id AND enabled = 1";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }
}
