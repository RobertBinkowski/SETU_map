<?php


class LocationRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM locations WHERE `enabled`='1'";

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
            ":map_longitude" => $data->getMapLongitude(),
            ":map_latitude" => $data->getMapLatitude(),
        ]);

        return $this->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM locations WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return $data;
        }
        return false;
    }

    public function update(Location $current, Location $new): bool
    {
        $sql = "UPDATE locations SET type = :type, geo_longitude = :geo_longitude, geo_latitude = :geo_latitude, enabled = :enabled, map_longitude = :map_longitude, map_latitude= :map_latitude, type = :type WHERE ID =:ID";

        return $this->execute($sql, [

            ":type" => $new->getType() ?? $current->getType(),
            ":geo_longitude" => $new->getGeoLongitude() ?? $current->getGeoLongitude(),
            ":geo_latitude" => $new->getGeoLatitude() ?? $current->getGeoLatitude(),
            ":map_longitude" => $new->getMapLongitude() ?? $current->getMapLongitude(),
            ":map_latitude" => $new->getMapLatitude() ?? $current->getMapLatitude(),
            ":enabled" => $new->isEnabled() ?? $current->isEnabled(),
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
