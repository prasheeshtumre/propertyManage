<?php

namespace App\Services;

use App\DTO\{CityRequestDTO, CityEditRequestDTO};
use App\DTO\CityResponseDTO;
use App\Repositories\ICityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityService
{
    private $cityRepository;

    public function __construct(ICityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getCities(Request $request)
    {
        $response = $this->cityRepository->cities($request);
        return  $response ?? [];
    }
    public function createCity(CityRequestDTO $cityRequestDTO): CityResponseDTO
    {
        return $this->cityRepository->create($cityRequestDTO);
    }

    public function updateCity(int $id, CityEditRequestDTO $cityEditRequestDTO): CityResponseDTO
    {
        return $this->cityRepository->update($id, $cityEditRequestDTO);
    }

    public function editCity(int $id)
    {
        return $this->cityRepository->edit($id);
    }

    public function citiesByState(int $id)
    {
        return $this->cityRepository->citiesByState($id);
    }

    public function destroyCity(int $id)
    {
        return $this->cityRepository->destroy($id);
    }
   
}
