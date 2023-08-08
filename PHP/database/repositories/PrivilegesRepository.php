<?php

class PrivilegesRepository extends BaseRepository
{

    private PrivilegeValueRepository $privilegeValueRepository;

    public function __construct(
        Database $conn,
        PrivilegeValueRepository $privilegeValueRepository
    ) {
        parent::__construct($conn);
        $this->privilegeValueRepository = $privilegeValueRepository;
    }

    public function getAll(): array|null
    {
        $sql = "SELECT * FROM privileges";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        return $this->hydrate($data);
    }

    public function get(string $id): Privileges|null
    {
        $sql = "SELECT * FROM privileges WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);
        if (!$data) {
            return null;
        }
        return $this->hydrateRow($data);
    }

    private function delete(int $id)
    {
        $sql = "DELETE FROM privileges WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    private function create(array $data)
    {
        $sql = "INSERT INTO privileges (name, users, logs, searches, details, images) 
                VALUES (:name, :users, :logs, :searches, :details, :images)";

        return $this->execute($sql, [
            ':name' => $data['name'],
            ':users' => $data['users'],
            ':logs' => $data['logs'],
            ':searches' => $data['searches'],
            ':details' => $data['details'],
            ':images' => $data['images'],
        ]);
    }

    private function update(array $data)
    {
        $sql = "UPDATE privileges SET name = :name, users = :users, logs = :logs, 
            searches = :searches, details = :details, images = :images WHERE id = :id";

        return $this->execute($sql, [
            ':name' => $data['name'],
            ':users' => $data['users'],
            ':logs' => $data['logs'],
            ':searches' => $data['searches'],
            ':details' => $data['details'],
            ':images' => $data['images'],
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

    private function hydrateRow(array $row): Privileges
    {
        return new Privileges(
            $row['id'],
            $row['name'],
            $this->privilegeValueRepository->get($row['users']),
            $this->privilegeValueRepository->get($row['logs']),
            $this->privilegeValueRepository->get($row['searches']),
            $this->privilegeValueRepository->get($row['details']),
            $this->privilegeValueRepository->get($row['images'])
        );
    }
}
