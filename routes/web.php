<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\V1\ContactController;
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

Route::middleware('guest')->controller(AuthController::class)->group(function () {

	Route::get("", "index")->name("login");
	Route::get("sign-up", "register")->name("register");

	Route::post("stored", "login")->name("login.stored");
	Route::post("sign-up/stored", "store")->name("register.stored");
});


Route::middleware('auth')->group(function () {

	Route::get('logout', [AuthController::class, 'logout'])->name('logout');
	Route::get("welcome", function () {
		return view("auth.welcome");
	})->name("welcome");

	Route::post("contacts/search", [ContactController::class, "search"])->name("contacts.search");
	Route::resource("contacts", ContactController::class)->except("show");
});
