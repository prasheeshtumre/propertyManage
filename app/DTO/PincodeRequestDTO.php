<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class PincodeRequestDTO
{
    public $pincode;

    public function __construct(Request $request)
    {
        // dd($request->all());
        $this->pincode = $request->input('pincode');
        $request->validate(
            [
                'pincode' => 'required|integer|digits:6|unique:pincodes,pincode',
            ],
            [
                'pincode.required' => 'Pincode Field is Required',
            ],
        );
    }

    private function validate(Request $request): Validator
    {
        $rules = [
            'pincode' => 'required|integer|digits:6|unique:pincodes,pincode',
        ];
        return validator($request->all(), $rules);
    }

    public function toArray(): array
    {
        return [
            'pincode' => $this->pincode,
        ];
    }
}
