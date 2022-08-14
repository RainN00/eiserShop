<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function addToCart(Request $request)
    {
        // Get id products added to cart
        $productsId = $request->productsId;

        if (isset($productsId)) {
            // Put all product id to resolve to show cart
            $this->pushItemToCart([$productsId]);
            $cart = Session::get('cart');
            $numberItem = $this->removeDuplicateAndCount($cart);
            // Put number cart to seesion to show
            Session::put('cart-item-number', $numberItem);
            echo $numberItem;
        }
    }

    public function pushItemToCart(array $array): void
    {
        foreach ($array as $item) {
            Session::push('cart', $item);
        }
    }

    public function removeDuplicateAndCount(array $array): int
    {
        // Remove duplicate products item.
        $removeDuplicateItem = array_unique($array);
        // Get number of all products added has resolved duplicate
        $numberItem = count($removeDuplicateItem);

        return $numberItem;
    }
}
