<?php

class CampusRepository extends BaseRepository
{
    private CoordinatesRepository $coordinatesRepository;
    private DetailsRepository $detailsRepository;

    public function __construct(
        Database $conn,
        CoordinatesRepository $coordinatesRepository,
        DetailsRepository $detailsRepository
    ) {
        parent::__construct($conn);
        $this->coordinatesRepository = $coordinatesRepository;
        $this->detailsRepository = $detailsRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM campuses";
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

    public function create(Campus $data): string
    {
        $sql = "INSERT INTO campuses (enabled, name, abbreviation, info, size) VALUES (:enabled, :name, :abbreviation, :info, :size)";

        $this->execute($sql, [
            ':enabled' => $data->isEnabled(),
        ]);

        return $this->lastInsertId();
    }

    public function get(string $id): Campus|null
    {
        $sql = "SELECT * FROM campuses WHERE ID = :ID";

        $data = $this->fetch($sql, [':ID' => $id]);

        if (!$data) {
            return null;
        }

        return $this->hydrateRow($data);
    }
    public function disable(Campus $current, bool $enabled = false): bool
    {
        $sql = "UPDATE campuses SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $current->getId()
        ]);
    }
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM campuses WHERE ID = :ID";

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

    private function hydrateRow(array $row): Campus
    {
        if ($row['coordinates'] !== null) {
            $coordinates = $this->coordinatesRepository->get($row['coordinates']);
        } else {
            $coordinates = null;
        }

        if ($row['entrance'] !== null) {
            $entrance = $this->coordinatesRepository->get($row['entrance']);
        } else {
            $entrance = null;
        }

        if ($row['details'] !== null) {
            $details = $this->detailsRepository->get($row['details']);
        } else {
            $details = null;
        }
        return new Campus(
            $row['id'],
            $row['enabled'],
            $coordinates,
            $entrance,
            $details
        );
    }
}
