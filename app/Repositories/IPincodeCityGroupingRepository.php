<?php

namespace App\Repositories;

use App\DTO\{CityRequestDTO, CityEditRequestDTO, PincodeCityGroupRequestDTO, PincodeCityGroupEditRequestDTO};
use App\DTO\CityResponseDTO;
// use App\Models\GeoID;
use Illuminate\Http\Request;

interface IPincodeCityGroupingRepository
{
    public function cities(Request $request);

    public function createGroup(PincodeCityGroupRequestDTO $pincodeCityGroupRequestDTO);

    public function updateGroup(int $id, PincodeCityGroupEditRequestDTO $pincodeCityGroupEditRequestDTO);

    public function edit(int $id);
}