<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/category/{product}', [ProductController::class, 'getCategoryProduct']);
Route::get('/detail/{product}', [ProductController::class, 'getProductDetail']);


Route::get('/admin/dashboard',
[
    'uses'=>'App\Http\Controllers\HomeController@getAdminDashboard',
    'middleware'=>'auth'

]
)->name("adminDashboard");

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/admin/add-product', [ProductController::class, 'create']);
Route::post('/admin/add-product', [ProductController::class, 'store']);
Route::get('/admin/edit-product/{product}', [ProductController::class, 'edit']);
Route::post('/admin/edit-product/{product}', [ProductController::class, 'update']);
Route::get('/admin/delete-product/{product}', [ProductController::class, 'delete']);
Route::get('/admin/search', [ProductController::class, 'search']);



Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/add-category', [CategoryController::class, 'create']);
Route::post('/admin/add-category', [CategoryController::class, 'store']);
Route::get('/admin/edit-category/{category}', [CategoryController::class, 'edit']);
Route::post('/admin/edit-category/{category}', [CategoryController::class, 'update']);
Route::get('/admin/delete-category/{category}', [CategoryController::class, 'delete']);
Route::get('/admin/search-category', [CategoryController::class, 'search']);



















Route::get('/user/dashboard',
[
    'uses'=>'App\Http\Controllers\HomeController@getUserDashboard',
    'middleware'=>'auth'

]
)->name("userDashboard");




// Route::get('user/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('user/downloads', function () {
    return view('user.downloads');
})->middleware(['auth'])->name('downloads');

// Route::get('/redirect', [HomeController::class, 'redirect']);



require __DIR__.'/auth.php';