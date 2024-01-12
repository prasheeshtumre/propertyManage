<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class PincodeCityGroupRequestDTO
{
    public $city;
    public $state;
    public $pincodes;

    public function __construct(Request $request)
    {
        // dd($request->all());
        $this->city = $request->input('city');
        $this->state = $request->input('state');
        $this->pincodes = $request->input('pincodes');
        $request->validate(
            [
                'city' => 'required',
                'state' => 'required',
                'pincodes' => 'required',
            ],
            [
                'city.required' => 'City Field is Required',
            ],
        );
    }

    public function toArray(): array
    {
        return [
            'city' => $this->city,
            'state' => $this->state,
            'pincodes' => $this->pincodes,
        ];
    }
}
