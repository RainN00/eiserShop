<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
                $path = "images/categories";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);
                Category::insert([
                    'name' => $request->name,
                    'thumbnail' => $path.'/'.$file_name,
                    'description' => $request->description
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create category successfully"
                ]);
            } else {
                $file_name = "images/noimages.jpg";
                Category::insert([
                    'name' => $request->name,
                    'thumbnail' => $file_name,
                    'description' => $request->description
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create category successfully"
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit',compact('category'));
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
        $category = Category::find($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
        ],[
            'name.required' => "Category name is required",
            'name.string' => "Category name is string"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                $path = "images/categories";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);


                $category->name = $request->name;
                $category->thumbnail = $path.'/'.$file_name;
                $category->description = $request->description;
                $category->save();

                return response()->json([
                    'code' => 1,
                    'msg' => "Update category successfully"
                ]);
            } else {
                $file_name = $category->thumbnail;
                $category->name = $request->name;
                $category->thumbnail = $file_name;
                $category->description = $request->description;
                $category->save();
                return response()->json([
                    'code' => 1,
                    'msg' => "Update category successfully"
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
        $category = Category::find($id);

        $category->delete($id);

        return response()->json([
            'msg' => 'Record deleted successfully!'
        ]);
    }
}
