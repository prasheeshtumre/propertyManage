<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloorUnitCategory;
use Auth;

class FloorUnitCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->searchbyId ?? '';
        $categories = FloorUnitCategory::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        })
            ->where('category_code', 2)
            ->orderBy('id', 'DESC')
            ->paginate(50);
        $parent_categories = FloorUnitCategory::where('category_code', 1)
            ->orderBy('id', 'ASC')
            ->get();
        $category_code = 2;
        $category_code_name = 'category';
        $category_code_title = 'categories';
        $parent_id = 2;
        if ($request->ajax()) {
            return view('floor_unit_category.category_paginate', get_defined_vars());
        }

        return view('floor_unit_category.index', get_defined_vars());
    }
    public function subCategories(Request $request)
    {
        // dd($request->all());
        $subcategory = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $searchTerm = $request->searchbyId ?? '';
        $searchCategory = $request->searchBYCategory ?? '';
        $categories = FloorUnitCategory::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%');
        })
            ->when($searchCategory, function ($query, $searchCategory) {
                return $query->where('parent_id', $searchCategory);
            })
            ->where('category_code', 3)
            ->orderBy('id', 'DESC')
            ->paginate(50);

        $parent_categories = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $category_code = 3;
        $category_code_name = 'sub category';
        $category_code_title = 'sub categories';
        if ($request->ajax()) {
            return view('floor_unit_category.category_paginate', get_defined_vars());
        }

        return view('floor_unit_category.index', get_defined_vars());
    }
    public function brands(Request $request)
    {
        // dd($request->all());
        $subcategory = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $subctgry = FloorUnitCategory::where('category_code', 3)
            ->orderBy('id', 'ASC')
            ->get();
        $searchTerm = $request->searchbyId ?? '';
        $searchCategory = $request->searchCategory ?? '';
        $searchBySubCat = $request->searchBySubCategory ?? '';

        if ($searchBySubCat) {
            $searchBySubCategory = [$searchBySubCat];
        } else {
            if ($searchCategory) {
                $searchCategoryid = ['parent_id' => $searchCategory];
            } else {
                $searchCategoryid = [];
            }
            $searchBySubCategory = FloorUnitCategory::with('children')
                ->where('category_code', 3)
                ->where($searchCategoryid)
                ->pluck('id')
                ->toArray();
        }

        $categories = FloorUnitCategory::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        })
            ->whereIn('parent_id', $searchBySubCategory)
            ->where('category_code', 4)
            ->orderBy('id', 'DESC')
            ->paginate(50);

        $parent_categories = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $category_code = 4;
        $category_code_name = 'brand';
        $category_code_title = 'Brands';
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
        if ($request->category_code_name == 'category') {
            $request->validate(
                [
                    // "parent_id" => 'required',
                    'name' => 'required',
                    'title' => 'required',
                ],
                [
                    'parent_id.required' => 'Category Field is Required',
                ],
            );
        } elseif ($request->category_code_name == 'sub category') {
            $request->validate(
                [
                    'parent_id' => 'required',
                    'name' => 'required',
                ],
                [
                    'parent_id.required' => 'Category Field is Required',
                ],
            );
        } elseif ($request->category_code_name == 'brand') {
            // return 'hii';
            $validator = $request->validate(
                [
                    'parent_id' => 'required',

                    'category' => 'required',

                    'name' => 'required',
                ],
                [
                    'parent_id.required' => 'SubCategory Field is Required',
                ],
            );
        }
        // dd($validator);
        $category = ['id' => $request->category_id];
        FloorUnitCategory::updateOrCreate($category, [
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'parent_id' => $request->parent_id ?? 0,
            'category_code' => $request->category_code,
            'title' => $request->title,
        ]);
        if ($request->category_id != 0) {
            return redirect()
                ->back()
                ->with('message', $request->category_code_name . ' Successfully Updated');
        }
        return redirect()
            ->back()
            ->with('message', $request->category_code_name . ' Successfully Created');
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
    public function edit($subcat_id, $type)
    {
        if ($type == 'sub-category') {
            $parent_categories = FloorUnitCategory::where('category_code', 2)
                ->orderBy('id', 'DESC')
                ->get();
            $sub_category = FloorUnitCategory::find($subcat_id);
        } elseif ($type == 'brand') {
            $parent_categories = FloorUnitCategory::where('category_code', 2)
                ->orderBy('id', 'DESC')
                ->get();
            $brand = FloorUnitCategory::find($subcat_id);
        }
        return view('floor_unit_category.edit_sub_category', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSubCat(Request $request, $subcat_id)
    {
        $request->validate(
            [
                'parent_id' => 'required',
                'name' => 'required',
            ],
            [
                'parent_id.required' => 'Category Field is Required',
            ],
        );
        $sub_category = FloorUnitCategory::find($subcat_id);
        if ($sub_category) {
            $sub_category->parent_id = $request->parent_id;
            $sub_category->name = $request->name;
            $sub_category->save();
            return redirect()
                ->back()
                ->with('message', ' Successfully Updated');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Record Not Found');
        }
    }
    public function updateBrand(Request $request, $brand_id)
    {
        $request->validate(
            [
                'parent_id' => 'required',
                'sub_category' => 'required',
                'name' => 'required',
            ],
            [
                'parent_id.required' => 'Category Field is Required',
            ],
        );
        $brand = FloorUnitCategory::find($brand_id);
        if ($brand) {
            $brand->parent_id = $request->sub_category;
            $brand->name = $request->name;
            $brand->save();
            return redirect()
                ->back()
                ->with('message', ' Successfully Updated');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Record Not Found');
        }
    }
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = FloorUnitCategory::find($id);
        if ($category) {
            FloorUnitCategory::destroy($id);
            return redirect()
                ->back()
                ->with('message', 'Category Successfully Removed');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Category Not Found');
        }
    }
    public function fetch_subcategory(Request $request)
    {
        $subcategory = FloorUnitCategory::where('parent_id', $request->category_id)->get();
        return response()->json($subcategory);
        // foreach($subcategory as $category)
        // {
        //     $searchbyparentid = FloorUnitCategory::where("parent_id",$category->parent_id)->get();
        //     return response()->json($searchbyparentid);
        // }
    }
    public function fetchbrands(Request $request)
    {
        $data['brands'] = FloorUnitCategory::where('parent_id', $request->category_id)->get();
        return response()->json($data);
    }
}
