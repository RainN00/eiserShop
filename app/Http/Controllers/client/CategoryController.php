<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Nation;

class CategoryController extends Controller
{
    public $sorting;

    public function filter(){
        if ($this->sorting == "date") {
            $products = Product::where('status','>',0)->orderBy('created_at','DESC')->paginate(9);
        }else if ($this->sorting == "name") {
            $products = Product::where('status','>',0)->orderBy('name','ASC')->paginate(9);
        }else if ($this->sorting == "name-desc") {
            $products = Product::where('status','>',0)->orderBy('name','DESC')->paginate(9);
        }else if ($this->sorting == "price") {
            $products = Product::where('status','>',0)->orderBy('price','ASC')->paginate(9);
        }else if ($this->sorting == "price-desc") {
            $products = Product::where('status','>',0)->orderBy('price','DESC')->paginate(9);
        }else{
            $products = Product::where('status','>',0)->paginate(9);

        }
    }

    public function render(){
        $html = view('client.carts.cart-render')->with(compact('products'))->render();

        return response()->json(
            [
                'success' => 200,
                'html'    => $html
            ]
        );
    }

    public function index(){
        $categories = $this->breadcrum1();
        $brands = $this->breadcrum2();
        $nations = $this->breadcrum3();

        $products = Product::where('status',1)->where('quantity','>','sold')->paginate(9);

        return view('client.categories.index',compact('categories','products','brands','nations'));
    }

    public function detail($id){
        $categories = $this->breadcrum1();
        $brands = $this->breadcrum2();
        $nations = $this->breadcrum3();
        $categoryBreadCrum = $this->breadcrum4($id);

        $products = Product::where('category_id',$id)
        ->where('status', 1)
        ->where('quantity','>', 'sold')
        ->distinct()
        ->paginate(9);

        return view('client.categories.index',compact('categories','categoryBreadCrum','products','brands','nations'));
    }
    public function brand($id){
        $categories = $this->breadcrum1();
        $brands = $this->breadcrum2();
        $nations = $this->breadcrum3();
        $categoryBreadCrum = $this->breadcrum4($id);

        $products = Product::where('brand_id',$id)
        ->where('status', 1)
        ->where('quantity','>', 'sold')
        ->distinct()
        ->paginate(9);

        return view('client.categories.index',compact('categories','categoryBreadCrum','products','brands','nations'));
    }
    public function nation($id){
        $categories = $this->breadcrum1();
        $brands = $this->breadcrum2();
        $nations = $this->breadcrum3();
        $categoryBreadCrum = $this->breadcrum4($id);

        $products = Product::where('nation_id',$id)
        ->where('status', 1)
        ->where('quantity','>', 'sold')
        ->distinct()
        ->paginate(9);

        return view('client.categories.index',compact('categories','categoryBreadCrum','products','brands','nations'));
    }

    public function breadcrum1(){
        $categories = Category::join('products', 'categories.id', '=', 'products.category_id')
        ->where('products.status', 1)
        ->where('products.quantity','>', 'products.sold')
        ->select('categories.*')
        ->distinct()
        ->get();

        return $categories;
    }
    public function breadcrum2(){
        $brands = Brand::join('products', 'brands.id', '=', 'products.brand_id')
        ->where('products.status', 1)
        ->where('products.quantity','>', 'products.sold')
        ->select('brands.*')
        ->distinct()
        ->get();

        return $brands;
    }
    public function breadcrum3(){
        $nations = Nation::join('products', 'nations.id', '=', 'products.nation_id')
        ->where('products.status', 1)
        ->where('products.quantity','>', 'products.sold')
        ->select('nations.*')
        ->distinct()
        ->get();

        return $nations;
    }
    public function breadcrum4($id){
        $categoryBreadCrum = Category::findOrFail($id);

        return $categoryBreadCrum;
    }

}
