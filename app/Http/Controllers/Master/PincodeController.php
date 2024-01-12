<?php

namespace App\Http\Controllers\Master;

use App\DTO\PincodeRequestDTO;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityPincode;
use App\Models\Pincode;
use App\Services\PincodeService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PincodeController extends Controller
{
    public $pincodeService;
    public function __construct(PincodeService $pincodeService)
    {
        $this->pincodeService = $pincodeService;
    }
    public function index(Request $request)
    {
        $searchTerm = $request->searchbyId ?? '';
        $pincodes = Pincode::where('status', 1)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('pincode', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        if ($request->ajax()) {
            return view('master.pincode.pincode_paginate', get_defined_vars());
        }

        return view('master.pincode.index', get_defined_vars());
    }

    public function store(PincodeRequestDTO $pincodeRequestDTO)
    {
        $this->pincodeService->createPincode($pincodeRequestDTO);
        return redirect()
            ->back()
            ->with('message', 'Pincode Successfully Created');
    }
    public function update($id, Request $request)
    {

        $validator = validator(
            $request->all(),
            [
                'pincode' => ['required', 'integer', 'digits:6', 'unique:pincodes,pincode,' . $id],
            ],
            [
                'pincode.required' => 'Pincode Field is Required',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->getMessageBag()->toArray(),
            ], 422);
        }

        $pincode = Pincode::find($id);
        if ($pincode) {
            try {
                $update_pincode = Pincode::where('id', $id)->update([
                    'pincode' => $request->pincode,
                ]);
                return response()->json([
                    'message' => 'Updated Successfully.'
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'Something went wrong.'
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $pincode = Pincode::find($id);
        if (isset($pincode) && !empty($pincode)) {
            $delete_pincode = Pincode::where('id', $id)->update([
                'status' => 0,
            ]);
        }

        return redirect()
            ->back()
            ->with('message', 'Pincode Successfully deleted');
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1); // Default to page 1

        $perPage = 10; // Number of records per page
        $skip = ($page - 1) * $perPage;

        $pincodes = Pincode::where('pincode', 'LIKE', '%' . $query . '%')
            ->skip($skip)
            ->take($perPage)
            ->get(['id', 'pincode']);

        $suggestions = $pincodes->map(function ($pincode) {
            return [
                'label' => $pincode->pincode,
                'value' => $pincode->pincode,
            ];
        });

        return response()->json($suggestions);
    }

    public function getPincodeSuggestions(Request $request)
    {
        try {
            $pincode = $request->input('pincode');
            $groupedPincodesArr = CityPincode::plucK('pincode_id')->toArray();
            $suggestions = Pincode::whereNotIn('id', $groupedPincodesArr)->where('pincode', 'like', "$pincode%")->paginate(10);

            return view('master.pincode.partials.suggestions', ['suggestions' => $suggestions]);
        } catch (\Exception $e) {
            exception_logging($e);
        }
    }

    public function getEditPincodeSuggestions(Request $request)
    {
        try {
            $pincode = $request->input('pincode');
            $city = City::where('id', $request->city)->first();
            $pincodesArr = [];
            $pincodesArr = CityPincode::plucK('pincode_id')->toArray();
            $suggestions = Pincode::whereNotIn('id', $pincodesArr)->where('pincode', 'like', "$pincode%")->paginate(10);
            return view('master.pincode.partials.suggestions', ['suggestions' => $suggestions, 'city' => $city]);
        } catch (\Exception $e) {
            exception_logging($e);
        }
    }
}
