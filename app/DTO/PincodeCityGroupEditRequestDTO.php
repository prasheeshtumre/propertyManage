<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class PincodeCityGroupEditRequestDTO
{
    public $city;
    public $oldCity;
    public $pincodes;
    public $assignedPincodesLength;

    public function __construct(Request $request)
    {
        // dd($request->all());
        $this->city = $request->input('city');
        $this->pincodes = $request->input('pincodes');
        $this->oldCity = $request->input('old_city');
        // $this->assignedPincodesLength = $request->input('assigned_pincodes_length');
        $request->validate(
            [
                'city' => 'required',
                'pincodes' => 'required',
                // 'assigned_pincodes_length' => 'sometimes|min:1'
            ],
            [
                'city.required' => 'City Field is Required',
                'pincodes.required' => 'pincodes Field is Required',
            ],
        );
    }

    public function toArray(): array
    {
        return [
            'city' => $this->city,
            'city' => $this->oldCity,
            'pincodes' => $this->pincodes,
        ];
    }
}
