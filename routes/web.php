<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CtegoryController;
use App\Http\Controllers\BrandController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});

//Category Controller
Route::get('/all/category',[CtegoryController::class,'index'])->name('AllCat');

Route::post('/category/add', [CtegoryController::class, 'AddCat'])->name('add.category');
Route::get('/category/edit/{id}',[CtegoryController::class,'Edit']);
Route::post('/category/update/{id}', [CtegoryController::class, 'Update'])->name('update.category');

Route::get('/category/remove/{id}', [CtegoryController::class, 'RemoveCat']);
Route::get('/category/restore/{id}', [CtegoryController::class, 'RestoreCat']);
Route::get('/category/delete/{id}', [CtegoryController::class, 'DeleteCat']);

//Brand Controller
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update'])->name('update.brand');
Route::get('/brand/remove/{id}', [BrandController::class, 'RemoveBrand']);