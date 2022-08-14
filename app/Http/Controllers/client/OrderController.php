<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function checkout(Request $request){
        if ($request->isMethod('get')) {
            if (Auth::check()) {
                if (Session::has('cart')) {
                    $payments = Payment::where('status',1)->get();
                    $productsIdAdded = Session::get('cart');
                    $brokenProductAndQuantity = array_count_values($productsIdAdded);
                    $cartData = $this->handingProductAndQuantity($brokenProductAndQuantity);
                    $listIdProductsCart = $cartData['item'];
                    $productsCart = Product::whereIn('id', $listIdProductsCart)->paginate(config('showitem.cart_item'));

                    return view('client.orders.index', compact('payments','productsCart', 'brokenProductAndQuantity'));
                }

                return view('client.carts.index');
            }

            return redirect()->route('client.users.login')->with('error', 'message.must_login_to_order');
        }
        if ($request->isMethod('post')) {
            $productInCart = Session::get('cart');
            $brokenProductAndQuantity = array_count_values($productInCart);
            $cartData = $this->handingProductAndQuantity($brokenProductAndQuantity);
            $listIdProductsCart = $cartData['item'];

            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->payment_id = $request->payment;
            $order->notes = $request->notes;
            $order->status = 1;
            $order->save();

            $orderProducts = [];
            foreach ($listIdProductsCart as $productId) {
                foreach ($brokenProductAndQuantity as $key => $value) {
                    if ($key == $productId) {
                        $orderProducts[] = [
                            'order_id' => $order->id,
                            'product_id' => $productId,
                            'quantity' => $value,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                }
            }
            OrderDetail::insert($orderProducts);

            Session::put('cart', null);
            Session::put('cart-item-number', 0);

            return redirect()->route('client.orders.success');
        }
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

    public function success(){
        return view('client.orders.success');
    }
}
