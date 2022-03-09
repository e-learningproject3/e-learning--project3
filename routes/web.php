<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/home', [HomeController::class, 'redirect']) ;
Route::post('/appointment', [HomeController::class, 'appointment']);
Route::get('/myappointment', [HomeController::class, 'myappointment']);
Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancel_appoint']);
Route::get('/about', [HomeController::class, 'about']);



Route::get('/add_teacher_view', [AdminController::class, 'addview']);
Route::post('/upload_teacher', [AdminController::class, 'upload']);
Route::get('/showappointment', [AdminController::class, 'showappointment']);
Route::get('/approved/{id}', [AdminController::class, 'approved']);
Route::get('/cancelled/{id}', [AdminController::class, 'cancelled']);
Route::get('/showteacher', [AdminController::class, 'showteacher']);
Route::get('/deleteteacher/{id}', [AdminController::class, 'deleteteacher']);
Route::get('/updateteacher/{id}', [AdminController::class, 'updateteacher']);
Route::post('/editteacher/{id}', [AdminController::class, 'editteacher']);




