<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        if (Session::get('cart')) {
            // Get all id product current user added to cart
            $productsIdAdded = Session::get('cart');
            // Broken it to array as id_product => number_added
            $brokenProductAndQuantity = array_count_values($productsIdAdded);
            // Handing data and return all id product and all id product => number_added
            $cartData = $this->handingProductAndQuantity($brokenProductAndQuantity);
            $listIdProductsCart = $cartData['item'];
            // Get all product added to cart
            $productsCart = Product::whereIn('id', $listIdProductsCart)->get();

            return view('client.carts.index', compact('productsCart', 'brokenProductAndQuantity'));
        }

        return view('client.carts.index');
    }

    public function addQuantityItem(Request $request)
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

            $productsIdAdded = Session::get('cart');
            $brokenProductAndQuantity = array_count_values($productsIdAdded);
            $cartData = $this->handingProductAndQuantity($brokenProductAndQuantity);
            $listIdProductsCart = $cartData['item'];
            $productsCart = Product::whereIn('id', $listIdProductsCart)->get();

            $html = view('client.carts.cart-render')->with(compact('productsCart', 'brokenProductAndQuantity'))->render();

            return response()->json(
                [
                    'success' => 200,
                    'html'    => $html
                ]
            );
        }
    }

    public function pushItemToCart(array $array): void
    {
        foreach ($array as $item) {
            Session::push('cart', $item);
        }
    }

    public function removeItemCart(Request $request)
    {
        $itemId = $request->itemId;
        $listItem = Session::get('cart');
        $listItem = array_diff($listItem, [$itemId]);
        $numberItem = $this->removeDuplicateAndCount($listItem);
        Session::put('cart', $listItem);

        Session::put('cart-item-number', $numberItem);
        $productsIdAdded = Session::get('cart');
        $brokenProductAndQuantity = array_count_values($productsIdAdded);
        $cartData = $this->handingProductAndQuantity($brokenProductAndQuantity);
        $listIdProductsCart = $cartData['item'];
        $productsCart = Product::whereIn('id', $listIdProductsCart)->get();

        $html = view('client.carts.cart-render')->with(compact('productsCart', 'brokenProductAndQuantity'))->render();

        return response()->json(
            [
                'success' => 200,
                'html'    => $html
            ]
        );
    }

    public function removeQuantityItem(Request $request)
    {
        $itemId = $request->itemId;
        $listItemsId = Session::get('cart');
        foreach ($listItemsId as $key => $value) {
            if ($value == $itemId) {
                unset($listItemsId[$key]);
                break;
            }
        }
        Session::put('cart', $listItemsId);
        $numberItem = $this->removeDuplicateAndCount($listItemsId);
        Session::put('cart-item-number', $numberItem);

        $productsIdAdded = Session::get('cart');
        $brokenProductAndQuantity = array_count_values($productsIdAdded);
        $cartData = $this->handingProductAndQuantity($brokenProductAndQuantity);
        $listIdProductsCart = $cartData['item'];
        $productsCart = Product::whereIn('id', $listIdProductsCart)->get();

        $html = view('client.carts.cart-render')->with(compact('productsCart', 'brokenProductAndQuantity'))->render();

        return response()->json(
            [
                'success' => 200,
                'html'    => $html
            ]
        );
    }

    public function handingProductAndQuantity(array $cartData): array
    {
        $resolvedCart = [];
        $resolvedCart["cart"] = [];
        $resolvedCart["item"] = [];

        foreach ($cartData as $key => $value) {
            $singleItem = [
                'product_id' => $key,
                'product_quantity' => $value,
            ];
            $singleItemId = $key;
            array_push($resolvedCart["cart"], $singleItem);
            array_push($resolvedCart["item"], $singleItemId);
        }

        return $resolvedCart;
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
