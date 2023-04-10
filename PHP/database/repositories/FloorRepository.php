<?php

class FloorRepository extends BaseRepository
{
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM floors";

        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO floors (enabled , info, size, building_id, floor) VALUES (enabled, :info, :size, :building_id, :floor)";

        return $this->execute($sql, [
            ':size' => $data["size"],
            ':building_id' => $data["building_id"],
            ':floor' => $data["floor"],
        ]);
    }

    public function get(string $id): null|Floor
    {
        $sql = "SELECT * FROM floors WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Floor(
                $data['id'],
                $data['size'] ?? 0,
                $data['floor'] ?? 0,
                $data['building_id'] ?? null,
            );
        }

        return null;
    }

    public function update(Floor $current, array $new): int
    {
        $sql = "UPDATE floors SET info = :info, enabled = :enabled, size = :size, building_id= :building_id, floor = :floor WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $new["enabled"] ?? $current->isEnabled(),
            ':size' => $new["size"] ?? $current->getSize(),
            ':building_id' => $new["building_id"] ?? $current->getBuilding(),
            ':floor' => $new["floor"] ?? $current->getFloor(),
            ':ID' => $current->getId(),
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
