<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','unique:categories'],
        ],[
            'name.required' => "Category name is required",
            'name.string' => "Category name is string",
            'name.unique' => "This category name is already taken"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                $path = "images/brands";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);
                Brand::insert([
                    'name' => $request->name,
                    'thumbnail' => $path.'/'.$file_name,
                    'description' => $request->description
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create brand successfully"
                ]);
            } else {
                $file_name = "images/noimages.jpg";
                Brand::insert([
                    'name' => $request->name,
                    'thumbnail' => $file_name,
                    'description' => $request->description
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create brand successfully"
                ]);
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
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit',compact('brand'));
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
        $brand = Brand::find($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
        ],[
            'name.required' => "Brand name is required",
            'name.string' => "Brand name is string"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                if (filter_var($brand->thumbnail, FILTER_VALIDATE_URL) === false) {
                    unlink($brand->thumbnail);
                }
                $path = "images/brands";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);


                $brand->name = $request->name;
                $brand->thumbnail = $path.'/'.$file_name;
                $brand->description = $request->description;
                $brand->save();

                return response()->json([
                    'code' => 1,
                    'msg' => "Update brand successfully"
                ]);
            } else {
                $file_name = $brand->thumbnail;
                $brand->name = $request->name;
                $brand->thumbnail = $file_name;
                $brand->description = $request->description;
                $brand->save();
                return response()->json([
                    'code' => 1,
                    'msg' => "Update brand successfully"
                ]);
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
        $brand = Brand::find($id);
        unlink($brand->thumbnail);
        $brand->delete($id);

        return response()->json([
            'msg' => 'Record deleted successfully!'
        ]);
    }
}
