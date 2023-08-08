<?php

class FloorRepository extends BaseRepository
{
    public function __construct(
        Database $conn,
        private BuildingRepository $buildingRepository,
        private DetailsRepository $detailsRepository
    ) {
        parent::__construct($conn);
        $this->buildingRepository = $buildingRepository;
        $this->detailsRepository = $detailsRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM floors";
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

    public function get(string $id): Floor
    {
        $sql = "SELECT * FROM floors WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $this->hydrateRow($data);
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

    private function hydrate(array $data): array
    {
        $output = [];
        foreach ($data as $row) {
            $output[] = $this->hydrateRow($row);
        }
        return $output;
    }

    private function hydrateRow(array $row): Floor
    {
        $details = null;
        $building = null;
        if ($row['details'] != null) {
            $details = $this->detailsRepository->get($row['details']);
        }
        if ($row['building'] != null) {
            $building = $this->buildingRepository->get($row['building']);
        }

        return new Floor(
            $row['id'],
            $row['enabled'],
            $row['floor'],
            $building,
            $details,
        );
    }
}
