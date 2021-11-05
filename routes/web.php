<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\events\MyEvent;
use Pusher\Laravel\Facades\Pusher;
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

Route::get('/auth/redirect/{provider}', [GoogleController::class, 'redirect']);
Route::get('/callback/{provider}', [GoogleController::class, 'callback']);
Route::get('/broadcast', function(){
    broadcast(new Websockets());
});
Route::get('/test', function(){
    event(new MyEvent('Bonjour!!!'));
});

Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});


Route::get('test', function () {
    event(new App\Events\ColorUsed('Someone'));
    return "color used envoyée";
});