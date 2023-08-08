<?php

class LocationRepository extends BaseRepository
{

    private CoordinatesRepository $coordinatesRepository;

    public function __construct(
        Database $conn,
        CoordinatesRepository $coordinatesRepository
    ) {
        parent::__construct($conn);
        $this->coordinatesRepository = $coordinatesRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM locations";
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

    public function create(Location $data): string
    {
        $sql = "INSERT INTO locations (enabled, name, abbreviation, info, size) VALUES (:enabled, :name, :abbreviation, :info, :size)";

        $this->execute($sql, [
            ':enabled' => $data->isEnabled(),
        ]);

        return $this->lastInsertId();
    }

    public function get(string $id): Location|null
    {
        $sql = "SELECT * FROM locations WHERE ID = :ID";

        $data = $this->fetch($sql, [':ID' => $id]);

        if (!$data) {
            return null;
        }

        return $this->hydrateRow($data);
    }
    public function disable(Location $current, bool $enabled = false): bool
    {
        $sql = "UPDATE locations SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current->getId()
        ]);
    }
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM locations WHERE ID = :ID";

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

    private function hydrateRow(array $row): Location
    {
        $coordinates = null;
        if ($row['coordinates']) {
            $coordinates = $this->coordinatesRepository->get($row['coordinates']);
        } else {
            $coordinates = null;
        }

        return new Location(
            $row['id'],
            $row['enabled'],
            $row['type'],
            $coordinates
        );
    }
}
