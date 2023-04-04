<?php


class CampusRepository
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM campuses WHERE `enabled`='1'";

        $statement = $this->conn->query($sql);

        $data = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $row["enabled"] = (bool)$row["enabled"]; // Set to Boolean
            $data[] = new Campus(
                $row["id"],
                $row["enabled"],
                $row["name"],
                $row["abbreviation"],
                $row["info"],
                $row["size"],
            );
        }
        return $data;
    }
    public function create(Campus $data): string
    {
        $sql = "INSERT INTO campuses (enabled ,name, abbreviation, info, size) VALUES (enabled,:name, :abbreviation, :info, :size)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $data->getName(), PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $data->getAbbreviation(), PDO::PARAM_STR);
        $statement->bindValue(":info", $data->getInfo(), PDO::PARAM_STR);
        $statement->bindValue(":size", $data->getSize(), PDO::PARAM_STR);

        $statement->execute();

        return $this->conn->lastInsertId();
    }

    public function get(int $id): Campus|false
    {
        $sql = "SELECT * FROM campuses WHERE id = :id";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Campus(
                $data["id"],
                $data["enabled"],
                $data["name"],
                $data["abbreviation"],
                $data["info"],
                $data["size"],
            );
        }

        return false;
    }

    public function update(Building $current, Building $new): bool
    {
        $sql = "UPDATE campuses SET name = :name, abbreviation = :abbreviation, info = :info, enabled = :enabled, size = :size WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":name", $new->getName() ?? $current->getName(), PDO::PARAM_STR);
        $statement->bindValue(":abbreviation", $new->getAbbreviation() ?? $current->getAbbreviation(), PDO::PARAM_STR);
        $statement->bindValue(":info", $new->getInfo() ?? $current->getInfo(), PDO::PARAM_STR);
        $statement->bindValue(":size", $new->getSize() ?? $current->getSize(), PDO::PARAM_STR);

        $statement->bindValue(":ID", $current->getId(), PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function disable(array $current, bool $enabled = false): bool
    {
        $sql = "UPDATE campuses SET enabled = :enabled WHERE ID =:ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":enabled", $enabled, PDO::PARAM_BOOL);

        $statement->bindValue(":ID", $current["ID"], PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM campuses WHERE ID = :ID";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":ID", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    }
}
