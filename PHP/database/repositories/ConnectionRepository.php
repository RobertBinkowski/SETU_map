<?php

class ConnectionRepository extends BaseRepository
{
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM connections";

        if (!$disabled) {
            $sql .= " WHERE enabled =1";
        }

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO connections (enabled , distance, node_one_id, node_two_is) VALUES (enabled,:distance, :node_one_id, :node_two_is)";

        return $this->execute($sql, [
            ':distance' => $data["distance"],
            ':node_one_id' => $data["node_one_id"],
            ':node_two_is' => $data["node_two_is"],
        ]);
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM connections WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);


        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
        }

        return $data;
    }

    public function update(Connection $current, array $new): int
    {
        $sql = "UPDATE connections SET distance = :distance, node_one_id = :node_one_id, node_two_is = :node_two_is, enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':node_one_id' => $new["node_one_id"] ?? $current->getNodeOne(),
            ':node_two_is' => $new["node_two_is"] ?? $current->getNodeTwo(),
            ':ID' => $current->getId(),
        ]);
    }

    public function disable(array $current, bool $enabled = false): int
    {
        $sql = "UPDATE connections SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current["ID"],
        ]);
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM connections WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
