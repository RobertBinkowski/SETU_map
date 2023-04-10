<?php


class ImageRepository extends BaseRepository
{
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM images";

        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }

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
                ':campus_id' => $data->getCampus(),
                ':building_id' => $data->getBuilding(),
                ':room_id' => $data->getBuilding(),

            ]
        );
    }

    public function get(string $id): Image|null
    {
        $sql = "SELECT * FROM images WHERE id = :id";

        $data = $this->fetch($sql, [':id' => $id]);

        if ($data !== false) {
            $data["enabled"] = (bool)$data["enabled"];
            return new Image(
                $data['id'],
            );
        }

        return null;
    }

    public function update(Image $current, array $new): bool
    {
        $sql = "UPDATE images SET name = :name, src = :src, info = :info, enabled = :enabled, campus_id = :campus_id, building_id = :building_id , room_id= :room_id WHERE ID =:ID";

        return $this->execute($sql, [
            ':name' => $new['name'] ?? $current->getName(),
            ':src' => $new['src'] ?? $current->getSrc(),
            ':info' => $new['info'] ?? $current->getInfo(),
            ':enabled' => $new['enabled'] ?? $current->isEnabled(),
            ':campus_id' => $new['campus'] ?? $current->getCampus(),
            ':building_id' => $new['building'] ?? $current->getBuilding(),
            ':room_id' => $new['room'] ?? $current->getRoom(),
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
