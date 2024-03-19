<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
});

Route::middleware(['admin'])->group(function () {
    Route::get('/register', [ProfileController::class, 'create'])->name('profile.create');
});

require __DIR__.'/auth.php';

Route::get('/dashboard/room-booking',[RoomController::class,'index'])->name('room-booking');
Route::post('/dashboard/room-booking', [RoomController::class, 'store'])->name('roombooking.store');
Route::get('/dashboard/roombooking/success', 'RoomBookingController@success')->name('roombooking.success');
