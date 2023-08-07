<?php


class CampusRepository extends BaseRepository
{
    public function getAll(bool $disabled = false): array
    {
        // $sql = "SELECT * FROM campuses";

        $sql = "SELECT 
                    campuses.*,
                    coordinates.*,
                    details.*,
                    images.enabled as photo_enabled,
                    images.name as photo_name,
                    images.src as photo_src,
                    images.details as photo_details_id
                FROM campuses 
                LEFT JOIN coordinates ON campuses.coordinates = coordinates.id
                LEFT JOIN details ON campuses.details = details.id
                LEFT JOIN images ON details.id = images.details";

        // if (!$disabled) {
        //     $sql .= " WHERE enabled=1";
        // }

        $result = $this->conn->query($sql);


        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;

        $campuses = [];

        foreach ($data as $row) {
            $row["enabled"] = (bool)$row["enabled"];
            $campus = new Campus(
                $row['id'],
                $row['name'] ?? "",
                $row['abbreviation'] ?? "",
                $row['info'] ?? "",
                $row['size'] ?? 0,
                $row['latitude'] ?? 0,
                $row['longitude'] ?? 0,
                $row['enabled'] ?? true
            );
            $campuses[] = $campus;
        }

        return $campuses;
    }

    public function create(Campus $data): string
    {
        $sql = "INSERT INTO campuses (enabled, name, abbreviation, info, size) VALUES (:enabled, :name, :abbreviation, :info, :size)";

        $this->execute($sql, [
            ':enabled' => $data->isEnabled(),
            ':name' => $data->getName(),
            ':abbreviation' => $data->getAbbreviation(),
            ':info' => $data->getInfo(),
            ':size' => $data->getSize()
        ]);

        return $this->lastInsertId();
    }

    public function get(int $id): Campus|null
    {
        $sql = "SELECT * FROM campuses WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Campus(
                $data['id'],
                $data['name'] ?? "",
                $data['abbreviation'] ?? "",
                $data['info'] ?? "",
                $data['size'] ?? 0,
                $data['latitude'] ?? 0,
                $data['longitude'] ?? 0,
                $data['enabled'] ?? true
            );
        }
        return null;
    }

    public function update(Campus $current, array $new): bool
    {
        $sql = "UPDATE campuses SET name = :name, abbreviation = :abbreviation, info = :info, enabled = :enabled, size = :size WHERE ID =:ID";

        return $this->execute($sql, [
            ':name' => $new['name'] ?? $current->getName(),
            ':abbreviation' => $new['abbreviation'] ?? $current->getAbbreviation(),
            ':info' => $new['info'] ?? $current->getInfo(),
            ':enabled' => $new['enabled'] ?? $current->isEnabled(),
            ':size' => $new['size'] ?? $current->getSize(),
            ':ID' => $current->getId()
        ]);
    }

    public function disable(Campus $current, bool $enabled = false): bool
    {
        $sql = "UPDATE campuses SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current->getId()
        ]);
    }
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM campuses WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
