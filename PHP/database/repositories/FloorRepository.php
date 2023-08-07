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

    public function create(array $data): string
    {
        $sql = "INSERT INTO floors (enabled , info, size, building_id, floor) VALUES (enabled, :info, :size, :building_id, :floor)";

        return $this->execute($sql, [
            ':size' => $data["size"],
            ':building_id' => $data["building_id"],
            ':floor' => $data["floor"],
        ]);
    }



    public function update(Floor $current, array $new): int
    {
        $sql = "UPDATE floors SET info = :info, enabled = :enabled, size = :size, building_id= :building_id, floor = :floor WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $new["enabled"] ?? $current->isEnabled(),
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
        $details = $this->detailsRepository->getByFloor($row['details']);
        $locationOne = $this->buildingRepository->getById($row['location']);

        return new Connection(
            $row['id'],
            $row['enabled'] == 1 ? true : false,
            $locationOne,
            $locationTwo,
        );
    }
}
