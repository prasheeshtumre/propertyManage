<?php

namespace App\Repositories;

use App\DTO\constructionPartnerRequestDTO;
use App\DTO\ConstructionPartnerResponseDTO;
use App\Models\{ConstructionPartner};

class ConstructionPartnerRepository implements IConstructionPartnerRepository
{
    public function create(constructionPartnerRequestDTO $constructionPartnerRequestDTO): ConstructionPartnerResponseDTO
    {
        $construction_partner = ConstructionPartner::create($constructionPartnerRequestDTO->toArray());
        return new ConstructionPartnerResponseDTO($construction_partner);
    }

    public function update($id, constructionPartnerRequestDTO $constructionPartnerRequestDTO): ConstructionPartnerResponseDTO
    {
        $construction_partner = ConstructionPartner::findOrFail($id);

        $construction_partner->update($constructionPartnerRequestDTO->toArray());
        return new ConstructionPartnerResponseDTO($construction_partner);
    }

    public function show()
    {
        return ConstructionPartner::where('status', 1)->paginate(2);
    }
}
