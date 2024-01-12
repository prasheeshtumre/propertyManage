<?php

namespace App\Repositories;

use App\DTO\PincodeRequestDTO;
use App\DTO\PincodeResponseDTO;

interface IPincodeRepository
{
    public function create(PincodeRequestDTO $pincodeRequestDTO): PincodeResponseDTO;

    public function update(PincodeRequestDTO $pincodeRequestDTO): PincodeResponseDTO;

    public function show();

}
