<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloorUnitSubCategory;
use Auth;

class FloorUnitSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $categories = FloorUnitSubCategory::paginate(10);
        if ($request->ajax()) {
            return view('floor_unit_category.category_paginate', get_defined_vars());
        }
        return view('floor_unit_category.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surveyor.builder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required'
        ]);
        
        $category = ['id'=>$request->category_id];
        FloorUnitSubCategory::updateOrCreate($category,['name'=> $request->name, 'created_by'=> Auth::user()->id, 'parent_id' => $request->parent_id ?? 0]);
        return redirect()->back()->with('message', 'Category Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = FloorUnitSubCategory::find($id);
        if($category){
            FloorUnitSubCategory::destroy($id);
            return redirect()->back()->with('message', 'Category Successfully Removed');
        }else{
            return redirect()->back()->with('message', 'Category Not Found');
        }
    }
}