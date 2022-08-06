<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;
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
    $count = [];
    $todos = Item::where('urgent', false)->get();
    $urgent_todos = Item::where('urgent', true)->get();

    $count['todos'] = $todos->count();
    $count['urgent_todos'] = $urgent_todos->count();
    
    return view('welcome', compact('count'));
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
