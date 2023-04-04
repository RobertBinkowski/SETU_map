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

    public function create(Building $data): bool
    {
        $sql = "INSERT INTO buildings (enabled, name, abbreviation, info, size, campus_id) 
                VALUES (:enabled, :name, :abbreviation, :info, :size, :campus_id)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", 1, PDO::PARAM_BOOL);
        $statement->bindValue(":name", $data->getName(), PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $data->getAbbreviation(), PDO::PARAM_STR);
        $statement->bindValue(":info", $data->getInfo(), PDO::PARAM_STR);
        $statement->bindValue(":size", $data->getSize(), PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $data->getCampusId(), PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId() > 0;
    }

    public function get(string $id): Building|false
    {
        $sql = "SELECT * FROM buildings WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Building(
                $data["id"],
                $data["enabled"],
                $data["name"],
                $data["abbreviation"],
                $data["info"],
                $data["size"],
                $data["campusId"],
            );
        }

        return false;
    }

    public function update(Building $current, Building $new): bool
    {
        $sql = "UPDATE buildings SET name = :name, abbreviation = :abbreviation, info = :info, 
                size = :size, campus_id = :campus_id WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $new->getName() ?? $current->getName(), PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $new->getAbbreviation() ?? $current->getAbbreviation(), PDO::PARAM_STR);
        $statement->bindValue(":info", $new->getInfo() ?? $current->getInfo(), PDO::PARAM_STR);
        $statement->bindValue(":size", $new->getSize() ?? $current->getSize(), PDO::PARAM_STR);
        $statement->bindValue(":campus_id", $new->getCampusId() ?? $current->getCampusId(), PDO::PARAM_INT);

        $statement->bindValue(":id", $current->getId(), PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE buildings SET enabled = :enabled WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM buildings WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }
}
