<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use DB;

class CityRequestDTO
{
    public $country;
    public $state;
    public $city;

    public function __construct(Request $request)
    {
        // dd($request->all());
        $this->state = $request->input('state');
        $this->country = $request->input('country');
        $this->city = $request->input('city');

        $request->validate([
            'country' => 'required',
            'state' => 'required',
            'city' => [
                'required',
                'alpha', // Only letters are allowed
                'regex:/^[a-zA-Z\s]+$/', // Only letters and spaces are allowed
                'max:100',
                Rule::unique('cities', 'name')->where(function ($query) use ($request) {
                    return $query->whereRaw('LOWER(name) = ?', [strtolower($request->city)]);
                })->ignore($request->id), // Assuming you have an 'id' field for updating
                function ($attribute, $value, $fail) {
                    // Custom validation to check for case sensitivity
                    $existingCities = DB::table('cities')
                        ->whereRaw('LOWER(name) = ?', [strtolower($value)])
                        ->get();
        
                    if ($existingCities->isNotEmpty()) {
                        $fail('City name must be unique (case-insensitive).');
                    }
                },
            ],
        ], [
            'city.required' => 'City Field is Required',
            // 'city.unique' => 'City already exists in the selected state.',
        ]);
        
    }

    private function validate(Request $request): Validator
    {
        $rules = [
            'city' => 'required|unique:cities,name',
        ];
        return validator($request->all(), $rules);
    }

    public function toArray(): array
    {
        return [
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
        ];
    }
}
