<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function show()
    {
        return view('login');
    }
    public function check(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(Auth::attempt(['email' => $req->email,'password' => $req->password]))
        {
            if(Auth::user()->role == 1)
            {
                $req->session()->flash('message','Login Failed');
                return redirect()->route('admin.dashboard');

                //admin route
            }
            $req->session()->flash('message','Login Failed');
            return redirect()->route('user.dashboard');

            //return to dashboard
        }
        dd("Hello");
        $req->session()->flash('message','Login Failed');
        return redirect()->back();


    }
    public function showreg(){
        return view('register');

    }
    
    public function create(Request $req){
        
        // $validator = Validator::make($req->all(),[
        //     'name' => 'required|max:25',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        //     'mobile' => 'required',
        //     'image' => 'required'
        // ]);

        // if ($validator->fails()){
        //     dd($validator);
        //      return redirect()->back()->withInput();
        // }
        $req->validate([
            'name'=>'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' =>'required',
            'image' => 'required'
        ]);

        $filename = time().'.'.$req->file('image')->getClientOriginalExtension();
        $req->file('image')->move('profile',$filename);
        
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'mobile' => $req->mobile,
            'password' => Hash::make($req->password),
            'image' => $filename
        ]);

        $req->session()->flash('message','Register');
        return redirect()->route('login');
    }
}
