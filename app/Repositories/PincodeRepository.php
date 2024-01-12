<?php

namespace App\Repositories;

use App\DTO\PincodeRequestDTO;
use App\DTO\PincodeResponseDTO;
use App\Models\{Pincode};

class PincodeRepository implements IPincodeRepository
{
    public function create(PincodeRequestDTO $pincodeRequestDTO): PincodeResponseDTO
    {
        $pincode = Pincode::create($pincodeRequestDTO->toArray());
        return new PincodeResponseDTO($pincode);
    }

    public function update(PincodeRequestDTO $pincodeRequestDTO): PincodeResponseDTO
    {
        // dd($pincodeRequestDTO->id);
        $pincode = Pincode::findOrFail($pincodeRequestDTO->id);

        $pincode->update($pincodeRequestDTO->toArray());
        return new PincodeResponseDTO($pincode);
    }

    public function show()
    {
        return Pincode::where('status', 1)->paginate(2);
    }

    
}
