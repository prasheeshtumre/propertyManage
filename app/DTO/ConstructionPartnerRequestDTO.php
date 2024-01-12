<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use DB;

class ConstructionPartnerRequestDTO
{
    public $construction_partner;

    public function __construct(Request $request)
    {
        // dd($request->all());
        $this->construction_partner = $request->input('construction_partner');
        $request->validate(
            [
                'construction_partner' => [
                    'required',
                    //  'unique:construction_partners,name',
                    Rule::unique('construction_partners', 'name')->where(function ($query) use ($request) {
                        return $query->whereRaw('LOWER(name) = ?', [strtolower($request->construction_partner)]);
                    })->ignore($request->id), // Assuming you have an 'id' field for updating
                    function ($attribute, $value, $fail) use ($request) {
                        // Custom validation to check for case sensitivity
                        $existingAreas = DB::table('construction_partners')
                            ->where('id', '<>', $request->id) // Exclude the current record for update
                            ->whereRaw('LOWER(name) = ?', [strtolower($value)])
                            ->get();

                        if ($existingAreas->isNotEmpty()) {
                            $fail('Area name must be unique (case-insensitive).');
                        }
                    },
                ],
            ],
            [
                'construction_partner.required' => 'Construction Partner Name Field is Required',
            ],
        );
    }

    private function validate(Request $request): Validator
    {
        $rules = [
            'construction_partner' => 'required|unique:construction_partners,name',
        ];
        return validator($request->all(), $rules);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->construction_partner,
        ];
    }
}
