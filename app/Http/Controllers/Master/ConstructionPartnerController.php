<?php

namespace App\Http\Controllers\Master;

use App\DTO\ConstructionPartnerRequestDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConstructionPartner;
use App\Services\ConstructionPartnerService;

class ConstructionPartnerController extends Controller
{
    public $construction_partner;
    public function __construct(ConstructionPartnerService $constructionPartnerService)
    {
        $this->construction_partner = $constructionPartnerService;
    }

    public function index(Request $request)
    {

        $searchTerm = $request->searchbyId ?? '';
        $construction_partners = ConstructionPartner::where('status', 1)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        if ($request->ajax()) {
            return view('master.construction_partner.construction_partner_paginate', get_defined_vars());
        }

        return view('master.construction_partner.index', get_defined_vars());
    }

    public function store(ConstructionPartnerRequestDTO $constructionPartnerRequestDTO)
    {
        $this->construction_partner->createConstructionPartner($constructionPartnerRequestDTO);
        return redirect()
            ->back()
            ->with('message', 'Construction Partner Successfully Created');
    }
    public function update($id, Request $request)
    {
        $validator = validator(
            $request->all(),
            [
                'construction_partner' => ['required', 'unique:construction_partners,name,' . $id],
            ],
            [
                'construction_partner.required' => 'Construction Partner Field is Required',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->getMessageBag()->toArray(),
            ], 422);
        }

        $construction_partner = ConstructionPartner::find($id);
        if ($construction_partner) {
            try {
                $update_construction_partner = ConstructionPartner::where('id', $id)->update([
                    'name' => $request->construction_partner,
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
        $pincode = ConstructionPartner::find($id);
        if (isset($pincode) && !empty($pincode)) {
            $delete_pincode = ConstructionPartner::where('id', $id)->update([
                'status' => 0,
            ]);
        }

        return redirect()
            ->back()
            ->with('message', 'Construction Partner Successfully deleted');
    }
}
