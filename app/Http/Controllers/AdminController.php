<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        $orders = Order::all();
        return view('admin.dashboard',compact('orders'));
    }

    public function delete(Request $req,$id)
    {
        Order::where('id',$id)->delete();
        $req->session()->flash('message','Data Deleted');
        return redirect()->back();
    }

    public function update(Request $req)
    {
        Order::where('id',$req->id)->update([
            'status' => $req->status
        ]);
        $req->session()->flash('message','Data Updated');
        return redirect()->back();
    }
}
