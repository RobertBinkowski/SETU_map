<?php

class CoordinatesRepository extends BaseRepository
{

    public function __construct(
        Database $conn,
    ) {
        parent::__construct($conn);
    }

    public function getAll(): array|null
    {
        $sql = "SELECT * FROM coordinates";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->hydrate($data);
    }

    public function get(string $id): Coordinates|null
    {
        $sql = "SELECT * FROM coordinates WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if (!$data) {
            return null;
        }

        return $this->hydrateRow($data);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM coordinates WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    public function create(Coordinates $coordinates): bool
    {
        $sql = "INSERT INTO coordinates (latitude, longitude, altitude, zoom) 
                VALUES (:latitude, :longitude, :altitude, :zoom)";

        return $this->execute($sql, [
            ':latitude' => $coordinates->getLatitude(),
            ':longitude' => $coordinates->getLongitude(),
            ':altitude' => $coordinates->getAltitude(),
            ':zoom' => $coordinates->getZoom(),
        ]);
    }

    public function update(Coordinates $coordinates): bool
    {
        $sql = "UPDATE coordinates SET latitude = :latitude, longitude = :longitude, altitude = :altitude, zoom = :zoom
                WHERE id = :id";

        return $this->execute($sql, [
            ':id' => $coordinates->getId(),
            ':latitude' => $coordinates->getLatitude(),
            ':longitude' => $coordinates->getLongitude(),
            ':altitude' => $coordinates->getAltitude(),
            ':zoom' => $coordinates->getZoom(),
        ]);
    }

    private function hydrate(array $data): array
    {
        $output = [];

        foreach ($data as $row) {
            $output[] = $this->hydrateRow($row);
        }
        return $output;
    }

    private function hydrateRow(array $row): Coordinates
    {
        return new Coordinates(
            $row['id'],
            $row['latitude'],
            $row['longitude'],
            $row['altitude'],
            $row['zoom'],
        );
    }
}
