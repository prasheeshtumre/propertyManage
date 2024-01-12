<?php

namespace App\Services;

use App\DTO\BuilderRequestDTO;
use App\DTO\BuilderResponseDTO;
use App\Repositories\IBuilderRepository;
use Illuminate\Http\JsonResponse;

class BuilderService
{
    private $builderRepository;

    public function __construct(IBuilderRepository $builderRepository)
    {
        $this->builderRepository = $builderRepository;
    }

    public function createBuilder(BuilderRequestDTO $builderRequestDTO): BuilderResponseDTO
    {
        return $this->builderRepository->create($builderRequestDTO);
    }

    public function updateBuilder(int $id, BuilderRequestDTO $builderRequestDTO): BuilderResponseDTO
    {
        return $this->builderRepository->update($id, $builderRequestDTO);
    }  
    
    public function storeCompanyLogo(int $builder_id, $file_name): JsonResponse
    {
        try{ 
            $builder_company_logo = $this->builderRepository->saveCompanyLogo($builder_id, $file_name);
            return response()->json($builder_company_logo);
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()], 422);
        }
    }
   
}
