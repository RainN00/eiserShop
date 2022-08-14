<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request){
        $productDetail = Product::findOrFail($request->productId);

        if ($productDetail) {
            $postComment = Comment::create([
                'product_id' => $request->productId,
                'content' => $request->content,
                'user_id' => Auth::id(),
                'status' => 1
            ]);
            if ($postComment) {
                $html = view('client.products.comment')->with(compact('productDetail'))->render();

                return response()->json(
                    [
                        'success' => 200,
                        'html'    => $html
                    ]
                );
            }
        }

        return back()->with('error', 'message.must_login');
    }
}
