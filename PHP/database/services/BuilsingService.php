<?php

class BuildingService
{
    private BuildingRepository $buildingRepo;
    private CampusRepository $campusRepo;

    public function __construct(BuildingRepository $buildingRepo, CampusRepository $campusRepo)
    {
        $this->buildingRepo = $buildingRepo;
        $this->campusRepo = $campusRepo;
    }

    public function getAllBuildings(): array
    {
        return $this->buildingRepo->getAll();
    }

    public function getBuildingById(string $id): Building|false
    {
        return $this->buildingRepo->get($id);
    }

    // Other methods for handling buildings and campuses
}
