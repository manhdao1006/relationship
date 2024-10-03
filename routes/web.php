<?php

use App\Events\OrderSuccess;
use App\Events\PodcastProcessed;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/send-email', function () {

    // event(new OrderSuccess());

    OrderSuccess::dispatch(array('name' => "ABC"));

    return view('welcome');
});

Route::get('/', function () {

    event(new PodcastProcessed('Hello'));

    return view('welcome');
});

Route::resource('products', ProductController::class);
