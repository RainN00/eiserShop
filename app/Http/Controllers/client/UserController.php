<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('get')) {
            return view('client.users.login');
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
                    'urlString' => "/"
                ]);
            }
            return response()->json([
                'messages' => "Wrong email or password"
            ]);
        }
    }

    public function register(Request $request){
        if ($request->isMethod('get')) {
            return view('client.users.register');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'firstname' =>['required','string'],
                'lastname' =>['required','string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed']
            ]);

            $data = $request->all();
            $check = $this->create($data);

            return response()->json([
                'urlString' => "/user/login"
            ]);
        }
    }

    public function create(array $data)
    {
        $role = Role::where('name','customer')->first();

        return User::create([
            'role_id' => $role->id,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => 'images/users/default.png'
        ]);
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->back();
    }

    public function profile(Request $request){
        if ($request->isMethod('get')) {
            return view('client.users.profile');
        }
        if ($request->isMethod('post')) {
            $foundUser = User::findOrFail(Auth::user()->id);

            if ($foundUser) {
                $userUpdated = $this->updateProfile(Auth::user()->id, $request);
                if ($userUpdated) {
                    return back()->with('success', 'update success');
                }

                return back()->with('error', 'update fail');
            }

            return back()->with('error', 'update fail');
        }
    }

    public function updateProfile($id, $request)
    {
        $foundUser = User::findOrFail($id);
        $userDataUpdate = $request->all();
        if ($foundUser) {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $destinationPath = 'images/users/';
                $avatarName = time().'_'.$request->avatar->getClientOriginalName();
                $avatar->move($destinationPath, $avatarName);
                $userDataUpdate['avatar'] = $destinationPath.$avatarName;
            } else {
                $userDataUpdate['avatar'] = $foundUser->avatar;
            }
            // dd($request->avatar->extension());
            $updatedUser = $foundUser->update($userDataUpdate);
            if ($updatedUser) {
                return true;
            }

             return false;
        }

        return false;
    }

    public function historyCart(){
        $orders = Order::where('user_id','=',Auth::user()->id)->where('status','>',0)->get();

        return view('client.users.history-cart', compact('orders'));
    }
}
