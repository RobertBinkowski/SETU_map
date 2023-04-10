<?php


class LogRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM logs";

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $logs = [];

        foreach ($data as $row) {
            $log = new log(
                $row['id'],
                $row['title'] ?? "",
                $row['type'] ?? "",
                $row['info'] ?? "",
            );
            $logs[] = $log;
        }

        return $logs;
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

    public function get(string $id): Log|null
    {
        $sql = "SELECT * FROM logs WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            return new Log(
                $data['id'],
                $data['title'] ?? "",
                $data['type'] ?? "",
                $data['info'] ?? "",
            );
        }
        return null;
    }

    public function update(Log $current, array $new): bool
    {
        $sql = "UPDATE logs SET title = :title, type = :type, info = :info WHERE ID =:ID";

        return $this->execute($sql, [
            ':title' => $new['title'] ?? $current->getTitle(),
            ':type' => $new['type'] ?? $current->getType(),
            ':info' => $new['info'] ?? $current->getInfo(),
        ]);
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM logs WHERE ID = :ID";

        return $this->execute($sql, [':ID' => $id]);
    }
}
