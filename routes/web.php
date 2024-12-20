<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController; 

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);



// Route::middleware('auth')->group(function () {
    
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.index');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::get("/", [TourController::class, "index"])->name('dashboard');   

Route::middleware("auth")->group(function () {
    
    Route::post("/tours", [TourController::class, "store"])->name(
        "tours.store"
    );
    // Route::get("/tours/create", [TourController::class, "create"])->name(
    //     "tours.create"
    // );
    Route::put("/tours/{tour}", [TourController::class, "update"])->name(
        "tour.update"
    );
    Route::delete("/tours/{tour}", [
        TourController::class,
        "destroy",
    ])->name("tours.destroy");
    Route::put("/tours/{tour}/status", [
        TourController::class,
        "updateStatus",
    ])->name("tour.update-status");
});



Route::middleware('auth')->group(function () {
    // Отображение формы бронирования
    Route::get('/tour/{tour}/book', [RequestController::class, 'create'])->name('tour.book');

    // Сохранение заявки на бронирование
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
});

require __DIR__.'/auth.php';
