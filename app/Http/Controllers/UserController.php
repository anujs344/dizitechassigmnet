<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.dashboard',compact('orders'));
    }
}
