<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// routes for restaurants
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/restaurant', [App\Http\Controllers\RestaurantManagersController::class, 'index'])->name('restaurant-index');
Route::post('/restaurant-add', [App\Http\Controllers\RestaurantManagersController::class, 'add'])->name('restaurant-add');

// routes for links
Route::get('/menu-links',[App\Http\Controllers\LinksController::class, 'LinksExplore'])->name('explore');
Route::get('/qr',[App\Http\Controllers\QRController::class, 'generateQR'])->name('qr-generate');

Route::group(['prefix' => 'links'], function () {
    Route::get('/',[App\Http\Controllers\LinksController::class, 'Links'])->name('links');
    Route::post('/add-feature',[App\Http\Controllers\LinksController::class, 'AddLinksFeature'] )->name('add-feature');
    Route::post('/add-link',[App\Http\Controllers\LinksController::class, 'AddLinksLink'] )->name('add-link');
    Route::get('/delete',[App\Http\Controllers\LinksController::class, 'delete'])->name('delete');
});
Route::post('/save-qr' ,[App\Http\Controllers\LinksController::class, 'SaveQR']);

