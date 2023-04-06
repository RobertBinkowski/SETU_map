<?php


class CampusRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM campuses WHERE `enabled`='1'";

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(Campus $data): string
    {
        $sql = "INSERT INTO campuses (enabled, name, abbreviation, info, size) VALUES (:enabled, :name, :abbreviation, :info, :size)";

        $this->execute($sql, [
            ':enabled' => $data->isEnabled(),
            ':name' => $data->getName(),
            ':abbreviation' => $data->getAbbreviation(),
            ':info' => $data->getInfo(),
            ':size' => $data->getSize()
        ]);

        return $this->lastInsertId();
    }

    public function get(int $id): Campus|false
    {
        $sql = "SELECT * FROM campuses WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Campus(
                $data["id"],
                $data["enabled"],
                $data["name"],
                $data["abbreviation"],
                $data["info"],
                $data["size"],
            );
        }

        return false;
    }

    public function update(Campus $current, Campus $new): bool
    {
        $sql = "UPDATE campuses SET name = :name, abbreviation = :abbreviation, info = :info, enabled = :enabled, size = :size WHERE ID =:ID";

        return $this->execute($sql, [
            ':name' => $new->getName() ?? $current->getName(),
            ':abbreviation' => $new->getAbbreviation() ?? $current->getAbbreviation(),
            ':info' => $new->getInfo() ?? $current->getInfo(),
            ':enabled' => $new->isEnabled() ?? $current->isEnabled(),
            ':size' => $new->getSize() ?? $current->getSize(),
            ':ID' => $current->getId()
        ]);
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
}
