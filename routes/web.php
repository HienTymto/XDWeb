<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComputerList;
use App\Http\Controllers\ComputerRoom;
use App\Http\Controllers\ComputerRepairController;
use App\Http\Middleware\AdminOnly;

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
Route::prefix('user')->name('user.')->middleware(AdminOnly::class)->group(function () {
    Route::get('/dashboard/user-manager', [UserController::class, 'index'])->name('usermanager');
    Route::get('/user-create', [UserController::class, 'create'])->name('user-create');
    Route::post('/', [UserController::class, 'store'])->name('user-add');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user-update');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');
});


Route::get('/dashboard/room-booking',[RoomController::class,'index'])->name('room-booking');
Route::post('/dashboard/room-booking', [RoomController::class, 'store'])->name('roombooking.store');
Route::get('/dashboard/roombooking/success', 'RoomBookingController@success')->name('roombooking.success');

// ---------------
Route::get('/danh-sach-may', [ComputerList::class, 'index'])->name('computer-list');
Route::get('/phong-may', [ComputerRoom::class, 'index'])->name('computer-room');
Route::post('/addLab', [ComputerRoom::class, 'addLab'])->name('addLab');
Route::get('/updateLab/{id}', [ComputerRoom::class, 'update'])->name('updateLab');
route::get('/deleteLab/{id}', [ComputerRoom::class, 'destroy'])->name('deleteLab');
Route::post('/addComputer', [ComputerList::class, 'store'])->name('addComputer');
Route::Get('/deleteComputer/{id}', [ComputerList::class, 'destroy'])->name('deleteComputer');

//----------------
Route::get('/repair', [ComputerRepairController::class, 'index'])->name('repair-list');
require __DIR__.'/auth.php';
