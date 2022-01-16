<?php

use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\ContactPersonController;
use App\Http\Controllers\Dashboard\UserController;
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
    return redirect()->route('dashboard.index');
});

Route::group(['prefix'=>'dashboard' , 'middleware'=>['auth' , 'Localization'] , 'as'=>'dashboard.'],function (){
        // Dashboard Home Page
        Route::view('/' , 'dashboard.index')->name('index');

        // Change Language Route
        Route::get('lang/{locale}' , function ($locale){
            session()->put('locale', $locale);
            return redirect()->back();
        })->name('lang');

        //Users CRUD Routes
        Route::resource('users' , UserController::class);

        //Companies Routes
        Route::resource('companies' , CompanyController::class);

        //Company Contact People Routes
        Route::resource('contact-people' , ContactPersonController::class);

});
require __DIR__.'/auth.php';
