<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use \App\Actions\Fortify\UpdateUserProfileInformation;

use App\Models\ShippingAddress;
use App\Models\Order;

class UserController extends Controller
{
    //
    public function attemptLogin($credentials) {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('my-account');
        }
 
        return back()->withErrors([
            'email' => 'Invalid username or password.',
        ]);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        $this->attemptLogin($credentials);
    }

    public function registerUser($data) {
        $data['password'] = Hash::make($data['password']);
        return User::insertGetId($data);
    }

    public function register(Request $request) {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|exists:users|max:255',
            'password' => 'required|confirmed',
        ]);

        $user_id = $this->registerUser($data);
        $this->attemptLogin([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function myAccount() {
        return view('my_account', [
            'user' => Auth::user(),
        ]);
    }

    public function updateInfo(Request $request) {
        $data = $request->all();

        UpdateUserProfileInformation::update(Auth::user(), $data);

        return redirect()->back()->with('success', 'Your profile was successfully updated');
    }

    public function shipping() {
        $default_shipping = (object) [
            'address' => '',
            'city' => '',
            'postal_code' => '',
            'country' => '',
            'phone' => '',
        ];

        $user = Auth::user();
        $shipping_address = ShippingAddress::where('user_id', $user->id)->first();

        $user->shipping_address = !empty($shipping_address) ? $shipping_address : $default_shipping;

        return view('shipping_address', [
            'user' => $user,
        ]);
    }

    public function updateShippingAddress(Request $request) {
        $user = Auth::user();

        $data = $request->validate([
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'phone' => 'required',
        ]);

        ShippingAddress::updateOrCreate([
            "user_id"           => $user->id,
        ], [
            "user_id"           => $user->id,
            "address"           => $data['address'],
            "city"              => $data['city'],
            "postal_code"       => $data['postal_code'],
            "country"           => $data['country'],    
            "phone"             => $data['phone'],
        ]);

        return redirect()->back()->with('success', 'Your shipping details was successfully updated');
    }

    public function myOrders() {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->get();

        return view('my_orders', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    public function logout() {
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }

}
