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

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(Location $data): string
    {
        $sql = "INSERT INTO locations (enabled , type, geo_longitude, geo_latitude, map_longitude, map_latitude, type) 
        VALUES (enabled,:type, :geo_longitude, :geo_latitude, :map_longitude, :map_latitude, :type)";

        $this->execute($sql, [

            ":type" => $data->getType(),
            ":geo_longitude" => $data->getGeoLongitude(),
            ":geo_latitude" => $data->getGeoLatitude(),
            ":x" => $data->getMapLongitude(),
            ":y" => $data->getMapLatitude(),
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
                $data['geo_latitude'] ?? 0,
                $data['geo_longitude'] ?? 0,
                $data['x'] ?? 0,
                $data['y'] ?? 0,
                $data['z'] ?? 0,
                $data["enabled"],
            );
        }
        return null;
    }

    public function update(Location $current, array $new): bool
    {
        $sql = "UPDATE locations SET type = :type, geo_longitude = :geo_longitude, geo_latitude = :geo_latitude, enabled = :enabled, map_longitude = :map_longitude, map_latitude= :map_latitude, type = :type WHERE ID =:ID";

        return $this->execute($sql, [

            ":type" => $new['type'] ?? $current->getType(),
            ":geo_longitude" => $new['geo_longitude'] ?? $current->getGeoLongitude(),
            ":geo_latitude" => $new['geo_latitude'] ?? $current->getGeoLatitude(),
            ":map_longitude" => $new['map_longitude'] ?? $current->getMapLongitude(),
            ":map_latitude" => $new['map_latitude'] ?? $current->getMapLatitude(),
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
