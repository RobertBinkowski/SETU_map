<?php


class ImageRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM images WHERE `enabled`='1'";

        $result = $this->conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(Image $data): bool
    {
        $sql = "INSERT INTO images (enabled ,name, info, src, campus_id,building_id, room_id) 
        VALUES (enabled,:name, :info, :src, :campus_id, :building_id ,:room_id)";

        return $this->execute(
            $sql,
            [
                ':enable' => 1,
                ':name' => $data->getName(),
                ':info' => $data->getInfo(),
                ':src' => $data->getSrc(),
                ':campus_id' => $data->getCampusId(),
                ':building_id' => $data->getBuildingId(),
                ':room_id' => $data->getBuildingId(),

            ]
        );
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT * FROM images WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return $data;
        }

        return false;
    }

    public function update(Image $current, Image $new): bool
    {
        $sql = "UPDATE images SET name = :name, src = :src, info = :info, enabled = :enabled, campus_id = :campus_id, building_id = :building_id , room_id= :room_id WHERE ID =:ID";

        return $this->execute($sql, [
            ':name' => $new->getName() ?? $current->getName(),
            ':src' => $new->getSrc() ?? $current->getSrc(),
            ':info' => $new->getInfo() ?? $current->getInfo(),
            ':enabled' => $new->isEnabled() ?? $current->isEnabled(),
            ':campus_id' => $new->getCampusId() ?? $current->getCampusId(),
            ':building_id' => $new->getBuildingId() ?? $current->getBuildingId(),
            ':room_id' => $new->getRoomId() ?? $current->getRoomId(),
            ':id' => $current->getId(),
        ]);
    }

    public function disable(int $id, bool $enabled = false): int
    {
        $sql = "UPDATE images SET enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':enabled' => $enabled,
            ':id' => $id,
        ]);;
    }

    public function delete(int $id): int
    {
        $sql = "DELETE FROM images WHERE ID = :ID";


        return $this->execute($sql, [':id' => $id]);
    }
}
