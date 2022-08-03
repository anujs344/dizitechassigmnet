<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $req)
    {
        $req->validate([
            'image' => 'required',
            'expired' => 'required',
            'title' => 'required',
            'price' => 'required',
        ]);
        $filename = time().'.'.$req->file('image')->getClientOriginalExtension();
        $req->file('image')->move('order',$filename);

        Order::create([
            'image' => $filename,
            'title' => $req->title,
            'expired' => $req->expired,
            'price' => $req->price,
            'status' => 'New Order',
            'user_id' => Auth::user()->id
        ]);
        $req->session()->flash('message','Order Inserted');
        return redirect()->back();
    }

    public function edit(Request $req,$id)
    {
        if($req->file('image'))
        {
            $filename = time().'.'.$req->file('image')->getClientOriginalExtension();
            $req->file('image')->move('order',$filename);
            Order::where('id',$id)->update([
                'image' => $filename,
                'title' => $req->title,
                'expired' => $req->expired,
                'price' => $req->price,
            ]);
        }
        else
        {
            Order::where('id',$id)->update([
                'title' => $req->title,
                'expired' => $req->expired,
                'price' => $req->price,
            ]);
        }
        $req->session()->flash('message','Data Edited');
        return redirect()->back();
        
    }

    public function delete(Request $req,$id)
    {
        Order::where('id',$id)->delete();
        $req->session()->flash('message','Data Deleted');
        return redirect()->back();
    }
}
