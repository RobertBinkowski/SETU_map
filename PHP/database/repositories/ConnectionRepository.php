<?php

class ConnectionRepository extends BaseRepository
{

    public function __construct(
        Database $conn,
        private LocationRepository $locationRepository
    ) {
        parent::__construct($conn);
        $this->locationRepository = $locationRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM connections";

        if (!$disabled) {
            $sql .= " WHERE enabled =1";
        }

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach ($data as $row) {
            $user = new Connection(
                $this->locationRepository,
                $row['id'],
                $row['location_one'] ?? null,
                $row['location_two'] ?? null,
                $row['enabled'] ?? true,
            );
            $users[] = $user;
        }

        return $users;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO connections (enabled , location_one, location_two) VALUES (enabled, :location_one, :location_two)";

        return $this->execute($sql, [
            ':location_one' => $data["node_one_id"],
            ':location_two' => $data["node_two_is"],
        ]);
    }

    public function get(string $id): Connection|null
    {
        $sql = "SELECT * FROM connections WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);


        if ($data !== false) {
            return new Connection(
                $this->locationRepository,
                $data['id'],
                $data['location_one'] ?? null,
                $data['location_two'] ?? null,
                $data['enabled'] ?? true,
            );
        }

        return null;
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
