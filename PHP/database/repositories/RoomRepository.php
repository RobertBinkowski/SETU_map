<?php


class RoomRepository extends BaseRepository
{
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM rooms";

        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(Room $data): string
    {
        $sql = "INSERT INTO rooms (enabled , type, name, info, size, building_id, location_id, floor_id) VALUES (enabled,:type, :name, :info, :size, :building_id, :location_id, :floor_id)";

        $this->execute($sql, [
            ":type" => $data->getType(),
            ":name" => $data->getName(),
            ":info" => $data->getInfo(),
            ":size" => $data->getSize(),
            ":building_id" => $data->getBuilding(),
            ":location_id" => $data->getLocation(),
            ":floor_id" => $data->getFloor()
        ]);

        return $this->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM rooms WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return $data;
        }
        return false;
    }

    public function update(Room $current, array $new): bool
    {
        $sql = "UPDATE rooms SET type = :type, name = :name, info = :info, enabled = :enabled, size = :size, building_id= :building_id, location_id = :location_id, floor_id = :floor_id WHERE ID =:ID";


        return $this->execute($sql, [
            ":type" => $new['type'] ?? $current->getType(),
            ":name" => $new['name'] ?? $current->getName(),
            ":info" => $new['info'] ?? $current->getInfo(),
            ":size" => $new['size'] ?? $current->getSize(),
            ":building_id" => $new['building'] ?? $current->getBuilding(),
            ":location_id" => $new['location'] ?? $current->getLocation(),
            ":floor_id" => $new['floor'] ?? $current->getFloor(),
            ":ID" => $current->getId()
        ]);
    }

    public function disable(Room $current, bool $enabled = false): bool
    {
        $sql = "UPDATE rooms SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current->getId()
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM rooms WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
