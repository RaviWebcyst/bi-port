<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','UserController@register');
Route::post('refer','UserController@refer');
Route::post('login','UserController@login');
Route::get('user','UserController@getAuthenticatedUser');
Route::post('/users','UserController@getUsers');
Route::post('password','UserController@changePwd');
Route::get('packages','PackageController@packages');
Route::post("invest",'UserController@invest');
Route::get("walletDetails",'UserController@walletDetails');
Route::get("activePackages",'UserController@activePackages');
Route::get("investments",'UserController@investments');
Route::get("directs",'UserController@directs');
Route::get("details",'UserController@details');
Route::get("downline",'UserController@downline');
Route::post("ewallet_transfer",'UserController@eWalletTransfer');
Route::post("wallet_transfer",'UserController@walletTransfer');

Route::post("/send_message","UserController@sendMsg");
Route::get("recent_tickets","UserController@recentTickets");
Route::get("resolved_tickets","UserController@resolvedTickets");
Route::post("chat","UserController@chat");
Route::get("chats","UserController@recentChat");

Route::post("withdraw","UserController@withdraw");
Route::get("withdrawDetails","UserController@withdrawDetails");
Route::get("transactions","UserController@transactions");
Route::post("topup","UserController@topup");
Route::get("investDetails","UserController@invests");
Route::get("levelList","UserController@levelList");

Route::post("payment","CoinPaymentsController@payment");
Route::post("callback","CoinPaymentsController@callback");
Route::post("withdrawUsdt","CoinPaymentsController@withdrawUsdt");
Route::post("withdraw_callback","CoinPaymentsController@withdraw_callback");

Route::get("direct_bonus","UserController@directBonus");
Route::get("daily_profit","UserController@dailyProfit");

Route::post("cancelWithdraw",'CoinPaymentsController@cancelWithdraw');
