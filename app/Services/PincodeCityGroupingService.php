<?php

namespace App\Services;

use App\DTO\{PincodeCityGroupRequestDTO, PincodeCityGroupEditRequestDTO};
use App\Repositories\IPincodeCityGroupingRepository;
use Illuminate\Http\Request;


class PincodeCityGroupingService
{
    private $pincodeCityGroupingRepository;

    public function __construct(IPincodeCityGroupingRepository $pincodeCityGroupingRepository)
    {
        $this->pincodeCityGroupingRepository = $pincodeCityGroupingRepository;
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function getCities(Request $request)
    {
        return $this->pincodeCityGroupingRepository->cities($request);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function createGroup(PincodeCityGroupRequestDTO $pincodeCityGroupRequestDTO)
    {
        return $this->pincodeCityGroupingRepository->createGroup($pincodeCityGroupRequestDTO);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function updateGroup(int $id, PincodeCityGroupEditRequestDTO $pincodeCityGroupEditRequestDTO)
    {
        return $this->pincodeCityGroupingRepository->updateGroup($id, $pincodeCityGroupEditRequestDTO);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function edit(int $id)
    {
        return $this->pincodeCityGroupingRepository->edit($id);
    }
}
