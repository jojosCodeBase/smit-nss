<?php

use App\Http\Controllers\Drives\DriveController;
use App\Http\Controllers\USers\UserController;
use App\Http\Controllers\Volunteers\ChildVolunteerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Volunteers\VolunteerController;

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

require __DIR__ . '/auth.php';



Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/volunteer/add', [VolunteerController::class, 'add'])->name('volunteer.add');
    Route::post('/volunteer/add-new', [VolunteerController::class, 'insert'])->name('volunteer.add-new');
    Route::get('/volunteer/search', [VolunteerController::class, 'search'])->name('volunteer.search');

    // volunteer manage start
        Route::get('/volunteer/manage', [VolunteerController::class, 'manage'])->name('volunteer.manage');
        Route::get('/volunteer/manage/view-edit', [VolunteerController::class, 'view_edit'])->name('volunteer.view-edit');
        Route::post('/volunteer/manage/view-edit', [VolunteerController::class, 'viewDetails'])->name('volunteer.view-details');

        Route::get('/volunteer/manage/view-edit/update{id}', [VolunteerController::class, 'viewUpdate'])->name('volunteer.view-update');
        Route::post('/volunteer/manage/view-edit/update', [VolunteerController::class, 'updateDetails'])->name('volunteer.update');

        Route::get('/volunteer/list-all', [VolunteerController::class, 'list'])->name('volunteer.list-all');

        Route::post('/volunteer/list-all', [VolunteerController::class, 'fetchDetails'])->name('volunteer.list-all');

    // volunteer manage end





    Route::get('/drive/manage', [DriveController::class, 'manage'])->name('drive.manage');
    Route::get('/drive/add', [DriveController::class, 'add'])->name('drive.add');
    Route::get('/drive/attendance', [DriveController::class, 'attendance'])->name('drive.attendance');

    Route::get('/users/manage', [UserController::class, 'index'])->name('users.manage');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


