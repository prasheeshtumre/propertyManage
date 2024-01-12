<?php

namespace App\Services;

use App\DTO\PincodeRequestDTO;
use App\DTO\PincodeResponseDTO;
use App\Models\Pincode;
use App\Repositories\IPincodeRepository;

class PincodeService
{
    private $pincodeRepository;

    public function __construct(IPincodeRepository $pincodeRepository)
    {
        $this->pincodeRepository = $pincodeRepository;
    }

    public function createPincode(PincodeRequestDTO $pincodeRequestDTO): PincodeResponseDTO
    {
        return $this->pincodeRepository->create($pincodeRequestDTO);
    }

    public function showPincodes()
    {
        return $this->pincodeRepository->show();
    }
}
