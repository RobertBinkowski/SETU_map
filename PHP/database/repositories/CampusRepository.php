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
        $coordinates = $this->coordinatesRepository->get($row['coordinates']);

        $details = $this->detailsRepository->get($row['details']);

        return new Campus(
            $row['id'],
            $row['enabled'] == 1 ? true : false,
            $coordinates,
            $details,
        );
    }
}
