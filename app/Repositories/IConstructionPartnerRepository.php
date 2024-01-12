<?php

namespace App\Repositories;

use App\DTO\ConstructionPartnerRequestDTO;
use App\DTO\ConstructionPartnerResponseDTO;

interface IConstructionPartnerRepository
{
    public function create(ConstructionPartnerRequestDTO $constructionPartnerRequestDTO): ConstructionPartnerResponseDTO;

    public function update($id, ConstructionPartnerRequestDTO $constructionPartnerRequestDTO): ConstructionPartnerResponseDTO;

    public function show();
}
