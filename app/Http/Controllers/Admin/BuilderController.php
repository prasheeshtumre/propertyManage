<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Builder, BuilderSubGroup};
use App\DTO\BuilderRequestDTO;
use App\Services\BuilderService;
use Illuminate\Http\JsonResponse;

class BuilderController extends Controller
{
    private $builderService;

    public function __construct(BuilderService $builderService)
    {
        $this->builderService = $builderService;
    }

    public function index(Request $request){
        $searchTerm = $request->searchbyId??'';
        $builders = Builder::when($searchTerm, function ($query, $searchTerm) {
                                return $query->where('name', 'LIKE', '%' . $searchTerm . '%');}
                            )
                            ->orderBy('id', 'DESC')
                            ->paginate(50);
        if ($request->ajax()) {
            return view('builder.builder_paginate', get_defined_vars());
        }
        return view('builder.index',compact('builders'));
    }

    public function create(){
        return view('builder.create');
    }
    // public function store(Request $request){
    //     dd( $request->all());
    // }

    public function store(Request $request): JsonResponse
    {
    
        $builderRequestDTO = new BuilderRequestDTO($request);
 
        $builder = $this->builderService->createBuilder($builderRequestDTO);

        $image = $request->file('group_logo');
        if($image){
            $file_name = uniqid() . "." . $image->getClientOriginalExtension();
            if($image->move(public_path('/uploads/builders/'), $file_name)){
                $this->builderService->storeCompanyLogo($builder->id, $file_name);
            }
        }
        
        return response()->json(['msg'  => 'Builder details Added Successfully', 'return_url' => url('admin/builder')], 200);
    }

    public function details($id){
        $builder = Builder::with('sub_groups')->find($id);
        if($builder){
            return view('builder.details', get_defined_vars());
        }else{
            abort(404);
        }
        
    }

    public function edit($id){
        $builder = Builder::with(['sub_groups' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->find($id);
        if($builder){
            return view('builder.edit', get_defined_vars());
        }else{
            abort(404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $builderRequestDTO = new BuilderRequestDTO($request);
        $builder = $this->builderService->updateBuilder($id, $builderRequestDTO);
        $image = $request->file('group_logo');
        if($image && $image !== null){
            $file_name = uniqid() . "." . $image->getClientOriginalExtension();
            if($image->move(public_path('/uploads/builders/'), $file_name)){
                $this->builderService->storeCompanyLogo($builder->id, $file_name);
            }
        }
        return response()->json(['msg'  => 'Builder details Added Successfully', 'return_url' => url('admin/builder/details', $id)], 200);
    }

    public function destroy_sub_group($id){
        $builder = BuilderSubGroup::find($id);
        if($builder){
            BuilderSubGroup::destroy($id);
            return response()->json(['msg'  => 'Builder-Group Removed Successfully'], 200);
        }
        return response()->json(['msg'  => 'Builder-Group Not Found'], 404);
    }

}
