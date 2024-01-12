<?php

namespace App\Services;

use App\DTO\{AreaEditRequestDTO, AreaRequestDTO, CityEditRequestDTO};
use App\DTO\CityResponseDTO;
use App\Models\Area;
use App\Repositories\IAreaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AreaService
{
    private $areaRepository;

    public function __construct(IAreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAreas(Request $request)
    {
        return $this->areaRepository->areas($request);
    }
    public function createArea(AreaRequestDTO $areaRequestDTO)
    {
        return $this->areaRepository->create($areaRequestDTO);
    }

    public function updateArea(int $id, AreaEditRequestDTO $areaEditRequestDTO)
    {
        return $this->areaRepository->update($id, $areaEditRequestDTO);
    }

    public function editArea(int $id)
    {
        return $this->areaRepository->edit($id);
    }

    public function areasByCity(int $id)
    {
        return $this->areaRepository->areasByCity($id);
    }

    public function destroyArea(int $id)
    {
        return $this->areaRepository->destroy($id);
    }

}
