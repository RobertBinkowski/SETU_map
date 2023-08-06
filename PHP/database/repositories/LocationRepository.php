<?php


class LocationRepository extends BaseRepository
{
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM locations";

        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $locations = [];

        foreach ($data as $row) {
            $location = new Location(
                $row['id'],
                $row['type'] ?? "",
                $row['latitude'] ?? 0,
                $row['longitude'] ?? 0,
                $row['altitude'] ?? 0,
                $row["enabled"],
            );
            $locations[] = $location;
        }

        return $locations;
    }
    public function create(Location $data): string
    {
        $sql = "INSERT INTO locations (enabled , type, longitude, latitude, type) 
        VALUES (enabled,:type, :longitude, :latitude, :type)";

        $this->execute($sql, [

            ":type" => $data->getType(),
            ":longitude" => $data->getLongitude(),
            ":latitude" => $data->getLatitude()
        ]);

        return $this->lastInsertId();
    }

    public function get(string $id): null|Location
    {
        $sql = "SELECT * FROM locations WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Location(
                $data['id'],
                $data['type'] ?? "",
                $data['latitude'] ?? 0,
                $data['longitude'] ?? 0,
                $data['altitude'] ?? 0,
                $data["enabled"],
            );
        }
        return null;
    }

    public function update(Location $current, array $new): bool
    {
        $sql = "UPDATE locations SET type = :type, longitude = :longitude, latitude = :latitude, enabled = :enabled, type = :type WHERE ID =:ID";

        return $this->execute($sql, [

            ":type" => $new['type'] ?? $current->getType(),
            ":longitude" => $new['longitude'] ?? $current->getLongitude(),
            ":latitude" => $new['latitude'] ?? $current->getLatitude(),
            ":enabled" => $new['enabled'] ?? $current->isEnabled(),
            'ID' => $current->getId()
        ]);
    }

    public function disable(Location $location, bool $enabled = false): int
    {
        $sql = "UPDATE locations SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $location->getId()
        ]);
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM locations WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
