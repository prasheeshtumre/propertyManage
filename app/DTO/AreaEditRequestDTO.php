<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use DB;

class AreaEditRequestDTO
{

    public $country;
    public $state;
    public $city;
    public $area;
    public $id;

    public function __construct(Request $request)
    {

        $this->state = $request->input('state');
        $this->country = $request->input('country');
        $this->city = $request->input('city');
        $this->area = $request->input('area');
        $this->id = $request->input('id');
        $request->validate([
            'country' => 'required',
            'state' => 'required',
            'area' => [
                'required',
                'string',
                'max:100',
                Rule::unique('areas', 'name')->where(function ($query) use ($request) {
                    return $query->where('city_id', $request->city)->whereRaw('LOWER(name) = ?', [strtolower($request->area)]);
                })->ignore($request->id), // Assuming you have an 'id' field for updating
                function ($attribute, $value, $fail) use ($request) {
                    // Custom validation to check for case sensitivity
                    $existingAreas = DB::table('areas')
                        ->where('id', '<>', $request->id) // Exclude the current record for update
                        ->where('city_id', $request->city)
                        ->whereRaw('LOWER(name) = ?', [strtolower($value)])
                        ->get();
        
                    if ($existingAreas->isNotEmpty()) {
                        $fail('Area name must be unique (case-insensitive).');
                    }
                },
            ],
        ],
        [
            'area.required' => 'Area field is required',
        ]);
    }

    public function toArray(): array
    {
        return [
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'area' => $this->area,
        ];
    }
}
