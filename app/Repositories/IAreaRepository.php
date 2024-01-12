<?php

namespace App\Repositories;

use App\DTO\{CityRequestDTO, AreaEditRequestDTO, AreaRequestDTO};
use App\DTO\AreaResponseDTO;
// use App\Models\GeoID;
use Illuminate\Http\Request;

interface IAreaRepository
{
    public function create(AreaRequestDTO $areaRequestDTO);
    
    public function update(int $id, AreaEditRequestDTO $cityEditRequestDTO);

    public function edit($id);

    public function destroy($id);

    public function areas(Request $request);

    public function areasByCity($cityId); 
}