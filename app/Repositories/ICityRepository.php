<?php

namespace App\Repositories;

use App\DTO\{CityRequestDTO, CityEditRequestDTO};
use App\DTO\CityResponseDTO;
// use App\Models\GeoID;
use Illuminate\Http\Request;

interface ICityRepository
{
    public function create(CityRequestDTO $cityRequestDTO): CityResponseDTO;
    
    public function update(int $id, CityEditRequestDTO $cityEditRequestDTO): CityResponseDTO;

    public function edit($id);

    public function destroy($id);

    public function cities(Request $request);

    public function citiesByState($stateId);
    
}