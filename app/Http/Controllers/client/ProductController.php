<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rate;

class ProductController extends Controller
{
    public function index($id){
        $productDetail = Product::find($id);
        $product = Product::where('id',$productDetail->id)->update(['views'=>($productDetail->views + 1)]);
        $rates = Rate::where('product_id',$id)->get();

        $sumRating = 0;
        foreach ($rates as $rate) {
            $sumRating += $rate->rating;
        }

        return view('client.products.index',compact('productDetail','rates','sumRating'));
    }

    public function postRating(Request $request){
        $postRating = Rate::create([
            'fullname' => $request->fullname,
            'product_id' => $request->productId,
            'content' => $request->content,
            'rating' => $request->rating
        ]);
        if ($postRating) {
            $rates = Rate::where('product_id',$request->productId)->get();
            $sumRating = 0;
            foreach ($rates as $rate) {
                $sumRating += $rate->rating;
            }

            $html = view('client.products.rating')->with(compact('rates','sumRating'))->render();

            return response()->json(
                [
                    'success' => 200,
                    'html'    => $html
                ]
            );
        }

        return back()->with('error', 'message.must_login');
    }
}
