<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Batch\BatchController;
use App\Http\Controllers\Drives\DriveController;
use App\Http\Controllers\Volunteers\VolunteerController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


Route::get('/homepage', function(){
    return view('welcome');
})->name('welcome');


Route::get('/', [AuthenticatedSessionController::class, 'sessionValidate'])->name('root');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// Route::post('/login', function(){
//     return "Hello from login post";
// })->name('login');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
->name('password.email');

Route::get('batch/regsitrationForm/{batch}', [BatchController::class, 'registrationForm'])->name('batch.registration-form');
Route::post('batch/regsitrationForm/register', [BatchController::class, 'register'])->name('register');

// routes for admin panel

Route::middleware(['isAdmin'])->prefix('admin/')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.home');

    Route::get('profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

    Route::get('volunteer/add', [VolunteerController::class, 'add'])->name('volunteer.add');
    Route::post('volunteer/add-new', [VolunteerController::class, 'insert'])->name('volunteer.add-new');
    Route::get('volunteer/search', [VolunteerController::class, 'search'])->name('volunteer.search');

    // volunteer manage start
    Route::get('/volunteer/manage', [VolunteerController::class, 'manage'])->name('volunteer.manage');
    Route::get('/volunteer/manage/view-edit', [VolunteerController::class, 'viewEdit'])->name('volunteer.view-edit');

    Route::post('/volunteer/manage/search-details', [VolunteerController::class, 'searchDetails'])->name('volunteer.search-details');
    Route::get('/volunteer/manage/search-details', [VolunteerController::class, 'searchDetails'])->name('volunteer.search-details');

    // Route::get('/volunteer/manage/view-edit/update{id}', [VolunteerController::class, 'viewUpdate'])->name('volunteer.view-update');
    Route::post('/volunteer/manage/view-edit/update', [VolunteerController::class, 'updateDetails'])->name('volunteer.update');
    Route::post('/volunteer/manage/delete', [VolunteerController::class, 'delete'])->name('volunteer.delete');

    Route::get('/volunteer/manage/list-all', [VolunteerController::class, 'list'])->name('volunteer.list-all');

    Route::post('/volunteer/manage/list-all', [VolunteerController::class, 'fetchDetails'])->name('volunteer.list-all');

    Route::get('/volunteer/manage/export', [VolunteerController::class, 'exportView'])->name('volunteer.export');

    Route::post('volunteer/manage/export', [VolunteerController::class, 'fetch'])->name('volunteer.fetchData');

    // volunteer manage end

    // drive section start
    Route::get('/drive/manage/list', [DriveController::class, 'listAll'])->name('drive.list');
    Route::post('/drive/manage/list/search', [DriveController::class, 'searchDrive'])->name('drive.search');

    Route::post('/drive/manage/list/update', [DriveController::class, 'update'])->name('drive.updateDetails');

    Route::delete('/drive/manage/list/delete', [DriveController::class, 'delete'])->name('drive.deleteDetails');

    Route::get('drive/add', [DriveController::class, 'addView'])->name('drive.add');
    Route::post('drive/add', [DriveController::class, 'addDrive'])->name('drive.add');
    Route::get('drive/attendance', [DriveController::class, 'showAttendance'])->name('drive.attendance');
    // Route::get('drive/attendance', [DriveController::class, 'showAttendance'])->name('user.drive.show.attendance');
    Route::get('drive/attendance/add/{regno}', [VolunteerController::class, 'getName']);
    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('drive.attendance.add');
    Route::post('drive/attendance/delete', [AttendanceController::class, 'delete'])->name('drive.attendance.delete');

    // drive section end

    Route::get('users/manage', [UserController::class, 'listUsers'])->name('users.manage');

    // batch section start

    Route::get('batch/create', [BatchController::class, 'createView'])->name('batch.create');
    Route::post('batch/create', [BatchController::class, 'create'])->name('batch.create');

    Route::get('batch/view-edit', [BatchController::class, 'viewEdit'])->name('batch.view-edit');
    Route::get('batch/view-edit/modify/', [BatchController::class, 'updateStatus'])->name('batch.view-edit.updateStatus');

    Route::get('drive/attendance/{driveId}', [DriveController::class, 'getAttendees'])->name('attendance.getAttendees');
    // Route::post('drive/attendance', [DriveController::class, 'getAttendees'])->name('attendance.getAttendees');
});
// });



// for user panel
Route::middleware(['isUser'])->prefix('user/')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('user.home');

    Route::get('profile', [UserController::class, 'index'])->name('user.profile.edit');
    Route::get('volunteers/search', [VolunteerController::class, 'search'])->name('user.volunteer.search');
    Route::post('volunteers/search', [VolunteerController::class, 'searchDetails'])->name('user.volunteer.view-details');


    Route::get('drive/add', [DriveController::class, 'addView'])->name('user.drive.add');
    Route::post('drive/add', [DriveController::class, 'addDrive'])->name('user.drive.add');
    Route::get('drive/attendance/add', [DriveController::class, 'addAttendance'])->name('user.drive.add.attendance');
    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('user.drive.add.attendance');

    // Route::post('drive/attendance/add/getName', [VolunteerController::class, 'getName'])->name('getName');
    Route::get('drive/attendance/add/{regno}', [VolunteerController::class, 'getName']);

    Route::post('drive/attendance/delete', [AttendanceController::class, 'delete'])->name('user.attendance.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

