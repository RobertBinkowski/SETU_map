<?php

class RoomRepository extends BaseRepository
{
    private LocationRepository $locationRepository;
    private DetailsRepository $detailsRepository;

    private BuildingRepository $buildingRepository;

    private FloorRepository $floorRepository;

    public function __construct(
        Database $conn,
        LocationRepository $locationRepository,
        DetailsRepository $detailsRepository,
        BuildingRepository $buildingRepository,
        FloorRepository $floorRepository,
    ) {
        parent::__construct($conn);
        $this->locationRepository = $locationRepository;
        $this->detailsRepository = $detailsRepository;
        $this->buildingRepository = $buildingRepository;
        $this->floorRepository = $floorRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM rooms";
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

    public function get(string $id): Room|null
    {
        $sql = "SELECT * FROM rooms WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $this->hydrateRow($data);
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE rooms SET enabled = :enabled WHERE id = :id";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM rooms WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    private function hydrate(array $data): array
    {
        $rooms = [];
        foreach ($data as $row) {
            $rooms[] = $this->hydrateRow($row);
        }
        return $rooms;
    }

    private function hydrateRow(array $row): Room
    {
        $location = null;
        $details = null;
        $building = null;
        $floor = null;

        if ($row['location']) {
            $location = $this->locationRepository->get($row['location']);
        }
        if ($row['details']) {
            $details = $this->detailsRepository->get($row['details']);
        }
        if ($row['building']) {
            $building = $this->buildingRepository->get($row['building']);
        }
        if ($row['floor']) {
            $floor = $this->floorRepository->get($row['floor']);
        }

        return new Room(
            $row['id'],
            $row['enabled'],
            $row['type'],
            $building,
            $location,
            $floor,
            $details,
        );
    }
}
