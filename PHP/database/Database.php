<?php


class Database
{
    public function __construct(private string $host, private string $database, private string $username, private string $password)
    {
    }
    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8";
        return new PDO($dsn, $this->username, $this->password, [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
        ]);
    }

    public function getTables()
    {
        $sql = "SHOW TABLES";
        $output = $this->getConnection()->prepare($sql);
        $output->execute();
        return $output;
    }
}
