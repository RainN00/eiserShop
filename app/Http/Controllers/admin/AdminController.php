<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();

        $labels = $users->keys();
        $data = $users->values();
        return view('admin.dashboard', compact('labels', 'data'));
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
