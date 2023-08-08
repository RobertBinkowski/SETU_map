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
        $params = [];
        if (!$disabled) {
            $sql .= " WHERE enabled = :enabled";
            $params = ['enabled' => 1];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydrate($data);
    }

    public function get(string $id): Connection
    {
        $sql = "SELECT * FROM connections WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $this->hydrateRow($data);
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO connections (enabled , location_one, location_two) VALUES (enabled, :location_one, :location_two)";

        return $this->execute($sql, [
            ':location_one' => $data["node_one_id"],
            ':location_two' => $data["node_two_is"],
        ]);
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

    private function hydrate(array $data): array
    {
        $output = [];
        foreach ($data as $row) {
            $output[] = $this->hydrateRow($row);
        }
        return $output;
    }

    private function hydrateRow(array $row): Connection
    {
        $locationOne = null;
        $locationTwo = null;
        if ($row['location_one'] != null) {
            $locationOne = $this->locationRepository->get($row['location_one']);
        }
        if ($row['location_two'] != null) {
            $locationTwo = $this->locationRepository->get($row['location_two']);
        }
        return new Connection(
            $row['id'],
            $row['enabled'] == 1 ? true : false,
            $locationOne,
            $locationTwo,
        );
    }
}
