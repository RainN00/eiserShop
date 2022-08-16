<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();

        $user = User::select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        $labels_user = [];
        $data_user = [];
        foreach ($user as $key => $value) {
            $labels_user[]=$key;
            $data_user[]=count($value);
        }

        $orders = Order::where('status','=',3)->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        $labels_product = [];
        $data_product = [];
        // foreach ($orders as $order) {
        //     $labels_product[]=$key;
        //     foreach ($order->orderDetail as $value2) {
        //         dd($value2);
        //         $data_product[]=$value2->views;
        //     }
        // }

        return view('admin.dashboard', compact('users','labels_user','data_user','labels_product','data_product'));
    }

    public function login(Request $request){
        if ($request->isMethod('get')) {
            return view('admin.user.login');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'urlString' => "/eiser/dashboard"
                ]);
            }
            return response()->json([
                'messages' => "Wrong email or password"
            ]);
        }
    }

    public function logout(){
        Session::flush();

        Auth::logout();

        return redirect()->route('admin.user.login');
    }
}
