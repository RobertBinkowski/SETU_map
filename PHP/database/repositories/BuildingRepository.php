<?php

class BuildingRepository extends BaseRepository
{

    public function __construct(
        Database $conn,
        private CampusRepository $campusRepository,
        private LocationRepository $locationRepository,
    ) {
        parent::__construct($conn);
        $this->campusRepository = $campusRepository;
        $this->locationRepository = $locationRepository;
    }
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM buildings";
        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }
        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $buildings = [];

        foreach ($data as $row) {
            $row["enabled"] = (bool)$row["enabled"];
            $building = new Building(
                $this->campusRepository,
                $this->locationRepository,
                $row['id'],
                $row['name'] ?? "",
                $row['abbreviation'] ?? "",
                $row['info'] ?? "",
                $row['size'] ?? 0,
                $row['layout'] ?? "",
                $row['campus_id'] ?? null,
                $row['location_id'] ?? null,
                $row['enabled'] ?? true,
            );
            $buildings[] = $building;
        }

        return $buildings;
    }

    public function create(Building $data): bool
    {
        $sql = "INSERT INTO buildings (enabled, name, abbreviation, info, size, campus_id) 
                VALUES (:enabled, :name, :abbreviation, :info, :size, :campus_id)";

        return $this->execute($sql, [
            ':enabled' => 1,
            ':name' => $data->getName(),
            ':abbreviation' => $data->getAbbreviation(),
            ':info' => $data->getInfo(),
            ':size' => $data->getSize(),
            ':campus_id' => $data->getCampus(),
        ]);
    }

    public function get(string $id): Building|null
    {
        $sql = "SELECT * FROM buildings WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Building(
                $this->campusRepository,
                $this->locationRepository,
                $data['id'],
                $data['name'] ?? "",
                $data['abbreviation'] ?? "",
                $data['info'] ?? "",
                $data['size'] ?? 0,
                $data['layout'] ?? "",
                $data['campus_id'] ?? null,
                $data['location_id'] ?? null,
                $data['enabled'] ?? true,
            );
        }

        return null;
    }

    public function update(Building $current, array $new): bool
    {
        $sql = "UPDATE buildings SET name = :name, abbreviation = :abbreviation, info = :info, 
                size = :size, campus_id = :campus_id WHERE id = :id";

        return $this->execute($sql, [
            ':name' => $new['name'] ?? $current->getName(),
            ':abbreviation' => $new['abbreviation'] ?? $current->getAbbreviation(),
            ':info' => $new['info'] ?? $current->getInfo(),
            ':size' => $new['size'] ?? $current->getSize(),
            ':campus_id' => $new['campius'] ?? $current->getCampus(),
            ':id' => $current->getId(),
        ]);
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE buildings SET enabled = :enabled WHERE id = :id";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM buildings WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }
}
