<?php


class ImageRepository extends BaseRepository
{
    public function __construct(
        Database $conn,
        private CampusRepository $campusRepository,
        private BuildingRepository $buildingRepository,
        private RoomRepository $roomRepository
    ) {
        parent::__construct($conn);
        $this->campusRepository = $campusRepository;
        $this->buildingRepository = $buildingRepository;
        $this->roomRepository = $roomRepository;
    }
    public function getAll(bool $disabled = false): array
    {
        $sql = "SELECT * FROM images";

        if (!$disabled) {
            $sql .= " WHERE enabled = 1";
        }

        $result = $this->conn->query($sql);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        // return $data;
        $images = [];

        foreach ($data as $row) {
            $image = new Image(
                $row['id'],
                $row['name'] ?? "",
                $row['src'] ?? "",
                $row['enabled'] ?? true,
            );
            $images[] = $image;
        }

        return $images;
    }
    public function create(Image $data): bool
    {
        $sql = "INSERT INTO images (enabled ,name, src,) 
        VALUES (enabled,:name, :src)";

        return $this->execute(
            $sql,
            [
                ':enable' => 1,
                ':name' => $data->getName(),
                ':src' => $data->getSrc(),
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
                $data['name'] ?? "",
                $data['info'] ?? "",
                $data['src'] ?? "",
                $data['enabled'] ?? true,
            );
        }

        return null;
    }

    public function update(Image $current, array $new): bool
    {
        $sql = "UPDATE images SET name = :name, src = :src, info = :info, enabled = :enabled WHERE ID =:ID";

        return $this->execute($sql, [
            ':name' => $new['name'] ?? $current->getName(),
            ':src' => $new['src'] ?? $current->getSrc(),
            ':enabled' => $new['enabled'] ?? $current->isEnabled(),
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
