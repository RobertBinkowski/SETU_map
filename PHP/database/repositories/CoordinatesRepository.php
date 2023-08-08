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

    private function delete(int $id)
    {
        $sql = "DELETE FROM coordinates WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    private function create(array $data)
    {
        $sql = "INSERT INTO coordinates (latitude, longitude, altitude) 
                VALUES (:latitude, :longitude, :altitude)";

        return $this->execute($sql, [
            ':latitude' => $data['latitude'],
            ':longitude' => $data['longitude'],
            ':altitude' => $data['altitude'],
        ]);
    }

    private function update(array $data)
    {
        $sql = "UPDATE coordinates SET latitude = :latitude, longitude = :longitude, altitude = :altitude
            WHERE id = :id";

        return $this->execute($sql, [
            ':id' => $data['id'],
            ':latitude' => $data['latitude'],
            ':longitude' => $data['longitude'],
            ':altitude' => $data['altitude'],
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
            $row['altitude']
        );
    }
}
