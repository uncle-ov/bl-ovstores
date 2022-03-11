<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class OrderController extends Controller
{
    //
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->is_admin) {
                return redirect('my-account');
            }
            return $next($request);
        });
        
    }

    public function index() {
        return view('admin.orders', [
        ]);
    }

}
