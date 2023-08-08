<?php

class ImageRepository extends BaseRepository
{

    private DetailsRepository $detailsRepository;

    public function __construct(
        Database $conn,
        DetailsRepository $detailsRepository,
    ) {
        parent::__construct($conn);
        $this->detailsRepository = $detailsRepository;
    }

    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM images";
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

    public function get(string $id): Details|null
    {
        $sql = "SELECT * FROM images WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $this->hydrateRow($data);
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE images SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $id,
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM images WHERE ID = :ID";

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

    private function hydrateRow(array $row): Details
    {

        $details = null;
        if ($row['details']) {
            $details = $this->detailsRepository->get($row['details']);
        }
        return new Details(
            $row['id'],
            $row['enabled'],
            $row['name'],
            $row['src'],
            $details,
        );
    }
}
