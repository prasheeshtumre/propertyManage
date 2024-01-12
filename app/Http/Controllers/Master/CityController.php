<?php

namespace App\Http\Controllers\Master;

use App\DTO\CityRequestDTO;
use App\DTO\CityEditRequestDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CityService;
use App\Models\{City, Country};
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CityController extends Controller
{
    public $cityService;
    public function __construct(CityService $cityService){
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $cities = $this->cityService->getCities($request);

            if ($request->ajax()) {
                return view('master.city.city_paginate', get_defined_vars());
            }

            return view('master.city.index', get_defined_vars());
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('master.city.create', get_defined_vars());
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequestDTO $cityRequestDTO)
    {
        try {
            $this->cityService->createCity($cityRequestDTO);
            return redirect()->back()->with('message', 'City Successfully Created');
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
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
        try {
            $city = $this->cityService->editCity($id);
            return view('master.city.edit', get_defined_vars());
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CityEditRequestDTO $cityEditRequestDTO)
    {
        try {
            $this->cityService->updateCity($id, $cityEditRequestDTO);
            return redirect()->back()->with('message', 'City Successfully Updated');
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function citiesByState(int $id = null)
    {
        try {
            $cities = $this->cityService->citiesByState($id);
            return response()->json(['cities'=>$cities], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->cityService->destroyCity($id);
            return response()->json(['message' => 'City Deleted Successfully.']);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function getCitySuggestions(Request $request)
    {
        try {
            $city = $request->input('city'); 
            $state = $request->input('state');
            $suggestions = City::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($city) . '%'])->where('state_id', $state)->paginate(10);
            return view('master.city.partials.suggestions', ['suggestions' => $suggestions]);
        } catch (\Exception $e) {
            exception_logging($e);
        }
        
    }

}
