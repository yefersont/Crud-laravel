<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController; 
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
    return view('auth.login');
});
/*
Route::get('/persona', function () {
    return view('persona.index');
});
Route::get('persona/create',[ClientesController::class,'create']);
*/
Route::resource('persona',ClientesController::class)->middleware('auth');
Auth::routes(['register'=> false,'reset' => false]);

Route::get('/home', [ClientesController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function()
{
    Route::get('/', [ClientesController::class, 'index'])->name('home');

});