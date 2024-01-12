<?php

namespace App\Repositories;

use App\DTO\BuilderRequestDTO;
use App\DTO\BuilderResponseDTO;
// use App\Models\GeoID;

interface IBuilderRepository
{
    public function create(BuilderRequestDTO $builderRequestDTO): BuilderResponseDTO;
    
    public function update(int $id, BuilderRequestDTO $builderRequestDTO): BuilderResponseDTO;

    public function saveCompanyLogo(int $id, $file_name);
    
}