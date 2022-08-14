<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::join('products', 'categories.id', '=', 'products.category_id')
        ->where('products.status', 1)
        ->where('products.quantity','>', 'products.sold')
        ->select('categories.*')
        ->distinct()
        ->get();

        $products = Product::where('status',1)->where('quantity','>','sold')->paginate(9);

        return view('client.categories.index',compact('categories','products'));
    }

    public function detail($id){
        $categories = Category::join('products', 'categories.id', '=', 'products.category_id')
        ->where('products.status', 1)
        ->where('products.quantity','>', 'products.sold')
        ->select('categories.*')
        ->distinct()
        ->get();
        $categoryBreadCrum = Category::findOrFail($id);

        $products = Product::where('category_id',$id)
        ->where('status', 1)
        ->where('quantity','>', 'sold')
        ->distinct()
        ->paginate(9);

        return view('client.categories.index',compact('categories','categoryBreadCrum','products'));
    }

}
