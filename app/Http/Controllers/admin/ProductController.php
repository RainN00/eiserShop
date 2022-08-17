<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Nation;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $nations = Nation::all();
        return view('admin.product.create',compact('categories','brands','nations'));
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
            'name' => ['required','string','unique:products'],
            'thumbnail' => ['image'],
            'category' => ['required'],
            'brand' => ['required'],
            'nation' => ['required'],
            'short_description' => ['required'],
            'content' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ],[
            'name.required' => "Product name is required",
            'name.string' => "Product name is string",
            'name.unique' => "This Product name is already taken",
            'thumbnail.image' => "This is not a picture",
            'category.required' => "Category has not been selected",
            'brand.required' => "Brand has not been selected",
            'nation.required' => "Nation has not been selected",
            'short_description.required' => "Short description is not empty",
            'content.required' => "Content is not empty",
            'quantity.required' => "Quantity is not empty",
            'price.required' => "Price is not empty",
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                $path = "images/products";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);
                Product::insert([
                    'name' => $request->name,
                    'thumbnail' => $path.'/'.$file_name,
                    'category_id' => $request->category,
                    'brand_id' => $request->brand,
                    'nation_id' => $request->nation,
                    'short_description' => $request->short_description,
                    'content' => $request->content,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'status' => 1,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create product successfully"
                ]);
            } else {
                $file_name = "images/noimages.jpg";
                Product::insert([
                    'name' => $request->name,
                    'thumbnail' => $file_name,
                    'category_id' => $request->category,
                    'brand_id' => $request->brand,
                    'nation_id' => $request->nation,
                    'short_description' => $request->short_description,
                    'content' => $request->content,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'status' => 1,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create product successfully"
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $nations = Nation::all();
        return view('admin.product.edit',compact('product','categories','brands','nations'));
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
        $product = Product::find($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
            'thumbnail' => ['image'],
            'category' => ['required'],
            'brand' => ['required'],
            'nation' => ['required'],
            'short_description' => ['required'],
            'content' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ],[
            'name.required' => "Product name is required",
            'name.string' => "Product name is string",
            'thumbnail.image' => "This is not a picture",
            'category.required' => "Category has not been selected",
            'brand.required' => "Brand has not been selected",
            'nation.required' => "Nation has not been selected",
            'short_description.required' => "Short description is not empty",
            'content.required' => "Content is not empty",
            'quantity.required' => "Quantity is not empty",
            'price.required' => "Price is not empty",
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                if (filter_var($product->thumbnail, FILTER_VALIDATE_URL) === false) {
                    unlink($product->thumbnail);
                }
                $path = "images/products";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);


                $product->name = $request->name;
                $product->thumbnail = $path.'/'.$file_name;
                $product->category_id = $request->category;
                $product->brand_id = $request->brand;
                $product->nation_id = $request->nation;
                $product->short_description = $request->short_description;
                $product->content = $request->content;
                $product->quantity = $request->quantity;
                $product->price = $request->price;
                $product->status = $request->status;
                $product->updated_at = Carbon::now();
                $product->save();

                return response()->json([
                    'code' => 1,
                    'msg' => "Update nation successfully"
                ]);
            } else {
                $file_name = $product->thumbnail;
                $product->name = $request->name;
                $product->thumbnail = $file_name;
                $product->category_id = $request->category;
                $product->brand_id = $request->brand;
                $product->nation_id = $request->nation;
                $product->short_description = $request->short_description;
                $product->content = $request->content;
                $product->quantity = $request->quantity;
                $product->price = $request->price;
                $product->status = $request->status;
                $product->updated_at = Carbon::now();
                $product->save();
                return response()->json([
                    'code' => 1,
                    'msg' => "Update nation successfully"
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
        $product = Product::find($id);
        if (filter_var($product->thumbnail, FILTER_VALIDATE_URL) === false) {
            unlink($product->thumbnail);
        }
        $product->delete($id);

        return response()->json([
            'msg' => 'Record deleted successfully!'
        ]);
    }

    public function active($id)
    {
        $product = Product::where('id',$id)->update('status',1);

        return response()->json([
            'msg' => 'Record actived successfully!'
        ]);
    }
}
