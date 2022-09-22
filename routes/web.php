<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');

});
Route::get('/admin', function () {
    return redirect("/admin/login");
});
Route::get("test","AdminController@test");


Route::get("admin/login","AdminController@login");


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function(){

Route::middleware('is_admin')->group(function(){
    Route::get('admin/home','HomeController@adminHome')->name('admin.home');
    Route::get('admin/profile','AdminController@profile')->name('admin.profile');

    Route::post("admin/profileUpdate",'AdminController@updateProfile')->name('admin.updateProfile');

    Route::get("admin/users" ,"AdminController@users")->name("admin.users");
    Route::get("admin/wallet" ,"AdminController@wallet")->name("admin.wallet");
    Route::post("admin/walletSend" ,"AdminController@walletSend")->name("admin.walletSend");
    Route::get("admin/walletDetails" ,"AdminController@walletDetails")->name("admin.walletDetails");
    Route::get("admin/packages" ,"AdminController@packages")->name("admin.packages");
    Route::get("admin/invest_packages" ,"AdminController@investPackages")->name("admin.investPackages");

    Route::get("admin/transactions" ,"AdminController@transactions")->name("admin.transactions");

    Route::get("admin/pending_queries",'AdminController@queries')->name("admin.queries");
    Route::get("admin/resolved_queries",'AdminController@resolved')->name("admin.resolved");
    Route::post("admin/changeStatus/{id}",'AdminController@changeStatus')->name("admin.status");
    Route::get("admin/chat/{id}",'AdminController@chat')->name("admin.chat");
    Route::post("admin/sendMessage/{id}",'AdminController@sendMessage')->name("admin.sendMessage");

    Route::get("admin/paidUsers" ,"AdminController@paidUser")->name("admin.paidUsers");
    Route::get("admin/pendingWithdraw" ,"AdminController@pendingWithdraw")->name("admin.pendingWithdraw");
    Route::post("admin/confirmWithdraw" ,"AdminController@confirmWithdraw")->name("withdraw.confirm");
    Route::get("admin/confirmedWithdraw" ,"AdminController@confirmedWithdraw")->name("admin.confirmWithdraw");
    Route::get("admin/investments" ,"AdminController@investments")->name("admin.investments");
    Route::post("admin/userStatus" ,"AdminController@userStatus")->name("user.status");

    Route::get("admin/investmentEdit/{id}","AdminController@investEdit")->name("invest.edit");
    Route::post("admin/investmentUpdate/{id}","AdminController@investUpdate")->name("invest.update");

});
});

Route::any('{slug}', function () {
    return view('welcome');
})->name('home');
Route::any('/{slug}/{name}', function () {
    return view('welcome');
});
Route::any('/{slug}/{slug1}/{name}', function () {
    return view('welcome');
});
Route::any('/{slug}/{slug1}/{slug2}/{name}', function () {
    return view('welcome');
});
