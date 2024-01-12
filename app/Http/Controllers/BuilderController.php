<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Builder;

class BuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->searchbyId??'';
        $builders = Builder::when($searchTerm, function ($query, $searchTerm) {
        return $query->where('name', 'LIKE', '%' . $searchTerm . '%');})->orderBy('id', 'DESC')->paginate(50);
        if ($request->ajax()) {
            return view('builder.builder_paginate', get_defined_vars());
        }
        return view('builder.index',compact('builders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('builder.create');
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
        $builder = ['id'=>$request->builder_id];
        Builder::updateOrCreate($builder,['name'=> $request->name]);
        return redirect()->back()->with('message', 'Builder Successfully Created');
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
        $builder = Builder::find($id);
        if($builder){
            Builder::destroy($id);
            return redirect()->back()->with('message', 'Builder Removed Successfully');
        }
        return redirect()->back()->with('message', 'Builder Not Found');
    }
    
    public function details(){
        return view('builder.details');
    }
}
