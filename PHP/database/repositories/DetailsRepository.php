<?php

class DetailsRepository extends BaseRepository
{

    public function __construct(
        Database $conn,
    ) {
        parent::__construct($conn);
    }

    public function getAll(): array|null
    {
        $sql = "SELECT * FROM details";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        return $this->hydrate($data);
    }

    public function get(string $id): Details|null
    {
        $sql = "SELECT * FROM details WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);
        if (!$data) {
            return null;
        }
        return $this->hydrateRow($data);
    }

    private function delete(int $id)
    {
        $sql = "DELETE FROM details WHERE id = :id";

        return $this->execute($sql, [':id' => $id]);
    }

    private function create(array $data)
    {
        $sql = "INSERT INTO details (name, abbreviation, info, size) 
                VALUES (:name, :abbreviation, :info, :size)";

        return $this->execute($sql, [
            ':name' => $data['name'],
            ':abbreviation' => $data['abbreviation'],
            ':info' => $data['info'],
            ':size' => $data['size'],
        ]);
    }

    private function update(array $data)
    {
        $sql = "UPDATE details SET name = :name, abbreviation = :abbreviation, info = :info, 
                size = :size WHERE id = :id";

        return $this->execute($sql, [
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':abbreviation' => $data['abbreviation'],
            ':info' => $data['info'],
            ':size' => $data['size'],
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

    private function hydrateRow(array $row): Details
    {
        return new Details(
            $row['id'],
            $row['name'],
            $row['abbreviation'],
            $row['info'],
            $row['size'],
        );
    }
}
