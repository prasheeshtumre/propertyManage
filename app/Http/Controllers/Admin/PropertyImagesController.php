<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyImagesRequest;
use App\Http\Requests\UpdatePropertyImagesRequest;

class PropertyImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyImagesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImages $propertyImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImages $propertyImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyImagesRequest $request, PropertyImages $propertyImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        
        $property_img = PropertyImage::find($id);
        if ($property_img) {
            PropertyImage::destroy($id);
                return response()->json(array(
                    'success' => true,
                    'message' => 'Property image Deleted Successfully'
                ), 200);
            } else {
                return response()->json(array(
                    'success' => false,
                    'message' => 'Please Try Again Later'
                ), 400);
            }
        
       
        // return $id;
    }
}
