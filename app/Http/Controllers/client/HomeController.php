<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $feature_products = Product::where('status',1)->where('quantity','>','sold')->take(3)->get();
        $hot_products = Product::where('status',1)->where('quantity','>','sold')->orderBy('views','DESC')->take(8)->get();
        $bestseller_products = Product::where('status',1)->where('quantity','>','sold')->orderBy('sold','DESC')->take(8)->get();

        return view('client.home.index', compact(['feature_products','hot_products','bestseller_products']));
    }
}
