<?php

class BuildingRepository extends BaseRepository
{
    private CampusRepository $campusRepository;
    private LocationRepository $locationRepository;
    private DetailsRepository $detailsRepository;

    public function __construct(
        Database $conn,
        CampusRepository $campusRepository,
        LocationRepository $locationRepository,
        DetailsRepository $detailsRepository
    ) {
        parent::__construct($conn);
        $this->campusRepository = $campusRepository;
        $this->locationRepository = $locationRepository;
        $this->detailsRepository = $detailsRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM buildings";
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

    public function get(string $id): Building
    {
        $sql = "SELECT * FROM buildings WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $data;
    }

    // public function create(Building $data): bool
    // {
    //     $sql = "INSERT INTO buildings (enabled, name, abbreviation, info, size, campus_id) 
    //             VALUES (:enabled, :name, :abbreviation, :info, :size, :campus_id)";

    //     return $this->execute($sql, [
    //         ':enabled' => 1,
    //     ]);
    // }

    // public function update(Building $current, array $new): bool
    // {
    //     $sql = "UPDATE buildings SET name = :name, abbreviation = :abbreviation, info = :info, 
    //             size = :size, campus_id = :campus_id WHERE id = :id";

    //     return $this->execute($sql, [
    //         ':campus_id' => $new['campius'] ?? $current->getCampus(),
    //         ':id' => $current->getId(),
    //     ]);
    // }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE buildings SET enabled = :enabled WHERE id = :id";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM buildings WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    private function hydrate(array $data): array
    {
        $buildings = [];
        foreach ($data as $row) {
            $buildings[] = $this->hydrateRow($row);
        }
        return $buildings;
    }

    private function hydrateRow(array $row): Building
    {
        $campus = $this->campusRepository->get($row['campus']);

        $location = $this->locationRepository->get($row['location']);

        $details = $this->detailsRepository->get($row['details']);

        return new Building(
            $row['id'],
            $row['enabled'] == 1 ? true : false,
            $campus,
            $location,
            $details
        );
    }
}
