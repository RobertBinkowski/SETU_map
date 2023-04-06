<?php


class LogRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM logs";

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(Log $data): string
    {
        $sql = "INSERT INTO logs (title, type, info) VALUES (:title, :type, :info)";

        $this->execute($sql, [
            ':title' => $data->getTitle(),
            ':type' => $data->getType(),
            ':info' => $data->getInfo(),
        ]);

        return $this->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM logs WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            return $data;
        }
        return false;
    }

    public function update(Log $current, Log $new): bool
    {
        $sql = "UPDATE logs SET title = :title, type = :type, info = :info WHERE ID =:ID";

        return $this->execute($sql, [
            ':title' => $new->getTitle() ?? $current->getTitle(),
            ':type' => $new->getType() ?? $current->getType(),
            ':info' => $new->getInfo() ?? $current->getInfo(),
        ]);
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM logs WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
