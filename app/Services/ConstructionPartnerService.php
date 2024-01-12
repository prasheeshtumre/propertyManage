<?php

namespace App\Services;

use App\DTO\ConstructionPartnerRequestDTO;
use App\DTO\ConstructionPartnerResponseDTO;
use App\Repositories\IConstructionPartnerRepository;

class ConstructionPartnerService
{
    private $constructionPartnerRepository;

    public function __construct(IConstructionPartnerRepository $constructionPartnerRepository)
    {
        $this->constructionPartnerRepository = $constructionPartnerRepository;
    }

    public function createConstructionPartner(ConstructionPartnerRequestDTO $ConstructionPartnerRequestDTO): ConstructionPartnerResponseDTO
    {
        return $this->constructionPartnerRepository->create($ConstructionPartnerRequestDTO);
    }
    public function updateConstructionPartner($id, ConstructionPartnerRequestDTO $ConstructionPartnerRequestDTO): ConstructionPartnerResponseDTO
    {
        return $this->constructionPartnerRepository->update($id, $ConstructionPartnerRequestDTO);
    }

    public function showConstructionPartners()
    {
        return $this->constructionPartnerRepository->show();
    }
}
