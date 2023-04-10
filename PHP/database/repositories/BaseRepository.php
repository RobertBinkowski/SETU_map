<?php

class BaseRepository
{
    protected PDO $conn;


    public function __construct(
        Database $database,
    ) {
        $this->conn = $database->getConnection();
    }

    protected function execute(string $sql, array $params = []): bool
    {
        $statement = $this->conn->prepare($sql);
        return $statement->execute($params);
    }

    protected function fetch(string $sql, array $params = []): array|false
    {
        $statement = $this->conn->prepare($sql);
        $statement->execute($params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    protected function fetchAll(string $sql, array $params = []): array
    {
        $statement = $this->conn->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function lastInsertId(): string
    {
        return $this->conn->lastInsertId();
    }
}
