<?php

class FloorRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM floors WHERE `enabled`='1'";

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO floors (enabled , info, size, building_id, floor) VALUES (enabled, :info, :size, :building_id, :floor)";

        return $this->execute($sql, [
            ':info' => $data["info"],
            ':size' => $data["size"],
            ':building_id' => $data["building_id"],
            ':floor' => $data["floor"],
        ]);
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM floors WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
        }

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE floors SET info = :info, enabled = :enabled, size = :size, building_id= :building_id, floor = :floor WHERE ID =:ID";

        return $this->execute($sql, [
            ':info' => $new["info"] ?? $current["info"],
            ':enabled' => $new["enabled"] ?? $current["enabled"],
            ':size' => $new["size"] ?? $current["size"],
            ':building_id' => $new["building_id"] ?? $current["building_id"],
            ':floor' => $new["floor"] ?? $current["floor"],
            ':ID' => $current["ID"],
        ]);
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE floors SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current["ID"],
        ]);
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM floors WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
