<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Auth;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('login', function () {
    if(Auth::check()){
        return redirect()->route('index');
    }
    return view('login');
})->name('login');

Route::get('generation',[App\Http\Controllers\GenerationBarcode::class, 'Generation'])->name('generation');
Route::post('register',[App\Http\Controllers\Usercontroller::class, 'register'])->name('register');
Route::post('loginpost',[App\Http\Controllers\Usercontroller::class, 'login'])->name('loginpost');




Route::group(['middleware' => ['auth']], function () { 
    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('index');
    })->name('logout');
    Route::get('profile/{id}',[App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/{id}',[App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('upload',[App\Http\Controllers\ProfileController::class, 'avatar'])->name('avatar');
    Route::get('contact',[App\Http\Controllers\Usercontroller::class, 'contact'])->name('contact');

    Route::middleware(['CheckisAdmin'])->group(function(){
        Route::get('account',[App\Http\Controllers\Usercontroller::class, 'list'])->name('account.list');

        Route::get('chucvu',[App\Http\Controllers\ChucvuController::class, 'list'])->name('chucvu.list');
        Route::post('chucvu/add',[App\Http\Controllers\ChucvuController::class, 'add'])->name('chucvu.add');

        Route::get('phongban',[App\Http\Controllers\PhongbanController::class, 'list'])->name('phongban.list');
        Route::post('phongban/add',[App\Http\Controllers\PhongbanController::class, 'add'])->name('phongban.add');

        Route::get('getsession', function (Request $request) {
            dd($request->session()->all());
        });
    });
});