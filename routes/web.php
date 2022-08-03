<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('nologin')->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('login',[AuthController::class,'show'])->name('login');
    Route::post('login',[AuthController::class,'check'])->name('login');
    
    Route::get('register',[AuthController::class,'showreg'])->name('register');
    Route::post('register',[AuthController::class,'create'])->name('register');
    
    
    
});
Route::post('logout',function(){
    if(Auth::check())
    {
        Auth::logout();
        session()->flash('message','Succesfully Logout');
        return redirect()->to('/');
    }
    session()->flash('message','You Must Login First');
    return redirect()->to('/');
})->name('logout');

Route::middleware('checkuser')->group(function () {
    Route::prefix('user')->group(function(){
        Route::get('dashboard',[UserController::class,'show'])->name('user.dashboard');
    });

    Route::prefix('order')->group(function(){
        Route::post('create',[OrderController::class,'create'])->name('order.create');
        Route::post('edit/{id}',[OrderController::class,'edit'])->name('order.edit');
        Route::get('delete/{id}',[OrderController::class,'delete'])->name('order.delete');

    });
});
Route::middleware('checkadmin')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('dashboard',[AdminController::class,'show'])->name('admin.dashboard');
        Route::post('update',[AdminController::class,'update'])->name('order.update');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('order.delete.admin');

    });
});

