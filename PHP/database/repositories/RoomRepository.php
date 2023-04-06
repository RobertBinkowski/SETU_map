<?php


class RoomRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM rooms WHERE `enabled`='1'";

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(Room $data): string
    {
        $sql = "INSERT INTO rooms (enabled , type, name, info, size, building_id, location_id, floor_id) VALUES (enabled,:type, :name, :info, :size, :building_id, :location_id, :floor_id)";

        $statement = $this->conn->prepare($sql);

        $statement->bindValue(":type", $data["type"], PDO::PARAM_STR);
        $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindValue(":info", $data["info"], PDO::PARAM_STR);
        $statement->bindValue(":size", $data["size"], PDO::PARAM_STR);
        $statement->bindValue(":building_id", $data["building_id"], PDO::PARAM_STR);
        $statement->bindValue(":location_id", $data["location_id"], PDO::PARAM_STR);
        $statement->bindValue(":floor_id", $data["floor_id"], PDO::PARAM_STR);

        $this->execute($sql, [
            ":type" => $data->getType(),
            ":name" => $data->getName(),
            ":info" => $data->getInfo(),
            ":size" => $data->getSize(),
            ":building_id" => $data->getBuildingId(),
            ":location_id" => $data->getLocationId(),
            ":floor_id" => $data->getFloorId()
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

    public function update(Room $current, Room $new): bool
    {
        $sql = "UPDATE rooms SET type = :type, name = :name, info = :info, enabled = :enabled, size = :size, building_id= :building_id, location_id = :location_id, floor_id = :floor_id WHERE ID =:ID";


        return $this->execute($sql, [
            ":type" => $new->getType() ?? $current->getType(),
            ":name" => $new->getName() ?? $current->getName(),
            ":info" => $new->getInfo() ?? $current->getInfo(),
            ":size" => $new->getSize() ?? $current->getSize(),
            ":building_id" => $new->getBuildingId() ?? $current->getBuildingId(),
            ":location_id" => $new->getLocationId() ?? $current->getLocationId(),
            ":floor_id" => $new->getFloorId() ?? $current->getFloorId(),
            ":ID" => $current->getId()
        ]);
    }

    public function disable(Room $current, bool $enabled = false): int
    {
        $sql = "UPDATE rooms SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current->getId()
        ]);
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM rooms WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
