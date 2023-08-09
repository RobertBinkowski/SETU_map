<?php

class LogRepository extends BaseRepository
{

    private DetailsRepository $detailsRepository;

    public function __construct(
        Database $conn,
        DetailsRepository $detailsRepository
    ) {
        parent::__construct($conn);
        $this->detailsRepository = $detailsRepository;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM logs";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydrate($data);
    }

    public function create(string $title, string $info, string $type): bool
    {
        // $sql = "INSERT INTO logs (info ,title, type, date, device) VALUES (:info ,:title, :type, :date, :device)";

        // return $this->execute($sql, [
        //     ':info' => $log->getInfo(),
        //     ':title' => $log->getTitle(),
        //     ':type' =>  $log->getType(),
        //     ':date' =>  date('Y-m-d H:i:s'),
        //     ':device' => $log->getDevice()
        // ]);
        return true;
    }


    public function get(string $id): Log
    {
        $sql = "SELECT * FROM logs WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        return $this->hydrateRow($data);
    }

    public function disable(int $id, bool $enabled = false): bool
    {
        $sql = "UPDATE logs SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':ID' => $id,
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM logs WHERE ID = :ID";

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

    private function hydrateRow(array $row): Log
    {
        $device = null;
        if ($row['device'] !== null) {
            $device = $this->detailsRepository->get($row['device']);
        }

        return new Log(
            $row['id'],
            $row['title'],
            $row['type'],
            $row['info'],
            $row['date'],
            $device
        );
    }
}
