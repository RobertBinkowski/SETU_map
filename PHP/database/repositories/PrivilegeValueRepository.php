<?php

class PrivilegeValueRepository extends BaseRepository
{

    public function __construct(
        Database $conn,
    ) {
        parent::__construct($conn);
    }

    public function getAll(): array|null
    {
        $sql = "SELECT * FROM privilege_values";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        return $this->hydrate($data);
    }

    public function get(string $id): PrivilegeValue|null
    {
        $sql = "SELECT * FROM privilege_values WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);
        if (!$data) {
            return null;
        }
        return $this->hydrateRow($data);
    }

    private function delete(int $id)
    {
        $sql = "DELETE FROM privilege_values WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    private function create(array $data)
    {
        $sql = "INSERT INTO privilege_values (value) 
                VALUES (:value)";

        return $this->execute($sql, [
            ':value' => $data['value'],
        ]);
    }

    private function update(array $data)
    {
        $sql = "UPDATE privilege_values SET value = :value WHERE id = :id";

        return $this->execute($sql, [
            ':value' => $data['value'],
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

    private function hydrateRow(array $row): PrivilegeValue
    {

        return new PrivilegeValue(
            $row['id'],
            $row['value']
        );
    }
}
