<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\VolunteerController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


Route::get('/', function(){
    return view('welcome');
})->name('welcome');


// Route::get('/', [AuthenticatedSessionController::class, 'sessionValidate'])->name('root');
Route::get('/', [AuthController::class, 'create'])->name('login-page');
Route::post('login', [AuthController::class, 'store'])->name('login');

Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('batch/regsitrationForm/{batch}', [BatchController::class, 'registrationForm'])->name('batch.registration-form');
Route::post('batch/regsitrationForm/register', [BatchController::class, 'register'])->name('volunteer-register-form');

// routes for admin panel

Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.home');
    Route::get('courses/manage', [HomeController::class, 'manageCourses'])->name('courses.manage');
    Route::post('courses/add', [HomeController::class, 'addCourse'])->name('admin.add-course');
    Route::post('courses/update', [HomeController::class, 'updateCourse'])->name('admin.update-course');

    Route::get('profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

    Route::get('volunteer/add', [VolunteerController::class, 'add'])->name('volunteer.add');
    Route::post('volunteer/add', [VolunteerController::class, 'insert'])->name('volunteer.add-new');
    Route::get('volunteer/search', [VolunteerController::class, 'search'])->name('volunteer.search');

    // volunteer manage start
    Route::get('/volunteer/manage', [VolunteerController::class, 'manage'])->name('volunteer.manage');
    Route::get('/volunteer/manage/view-edit', [VolunteerController::class, 'viewEdit'])->name('volunteer.view-edit');

    // Route::get('/volunteer/manage/search-details', [VolunteerController::class, 'searchDetails'])->name('volunteer.search-details');

    // Route::get('/volunteer/manage/view-edit/update{id}', [VolunteerController::class, 'viewUpdate'])->name('volunteer.view-update');
    Route::post('/volunteer/manage/view-edit/update', [VolunteerController::class, 'updateDetails'])->name('volunteer.update');
    Route::delete('/volunteer/manage/delete', [VolunteerController::class, 'delete'])->name('volunteer.delete');

    Route::get('/volunteer/manage/list-all', [VolunteerController::class, 'list'])->name('volunteer.list-all');

    Route::post('/volunteer/manage/list-all', [VolunteerController::class, 'fetchDetails'])->name('volunteer.list-all');

    Route::get('/volunteer/manage/export', [VolunteerController::class, 'exportView'])->name('volunteer.export');

    Route::post('volunteer/manage/export', [VolunteerController::class, 'fetch'])->name('volunteer.fetchData');
    Route::post('/volunteer/manage/search-details/', [VolunteerController::class, 'searchDetails'])->name('volunteer.search-details');

    // volunteer manage end

    // drive section start
    Route::get('/drive/manage/list', [DriveController::class, 'listAll'])->name('drive.list');
    Route::post('/drive/manage/list/search', [DriveController::class, 'searchDrive'])->name('drive.search');

    Route::post('/drive/manage/list/update', [DriveController::class, 'update'])->name('drive.updateDetails');

    Route::delete('/drive/manage/list/delete', [DriveController::class, 'delete'])->name('drive.delete');

    Route::get('drive/add', [DriveController::class, 'addView'])->name('drive.add');
    Route::post('drive/add', [DriveController::class, 'addDrive'])->name('drive.add');
    Route::get('drive/attendance', [DriveController::class, 'showAttendance'])->name('drive.attendance');
    // Route::get('drive/attendance', [DriveController::class, 'showAttendance'])->name('user.drive.show.attendance');
    Route::get('drive/attendance/add/{regno}', [VolunteerController::class, 'getName']);
    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('drive.attendance.add');
    Route::delete('drive/attendance/delete', [AttendanceController::class, 'delete'])->name('drive.attendance.delete');

    // drive section end

    Route::get('users/manage', [UserController::class, 'index'])->name('users.manage');
    Route::post('users/manage/add', [UserController::class, 'addModerator'])->name('add-moderator');

    // batch section start

    Route::get('batch/manage', [BatchController::class, 'manage'])->name('batch.manage');
    Route::post('batch/manage/create', [BatchController::class, 'create'])->name('batch.create');

    Route::get('batch/manage/edit', [BatchController::class, 'viewEdit'])->name('batch.view-edit');
    Route::post('batch/manage/update', [BatchController::class, 'updateBatchInfo'])->name('batch.update');

    Route::get('drive/attendance/{driveId}', [DriveController::class, 'getAttendees'])->name('attendance.getAttendees');
    // Route::post('drive/attendance', [DriveController::class, 'getAttendees'])->name('attendance.getAttendees');

    // ajax
    Route::get('volunteer/getInfo/{id}', [VolunteerController::class, 'getVolunteerInfo']);
    Route::get('drive/getInfo/{id}', [DriveController::class, 'getDriveInfo']);
    Route::get('batch/getInfo/{id}', [BatchController::class, 'getBatchInfo']);
    Route::get('batch/manage/updateStatus', [BatchController::class, 'updateStatus'])->name('batch.manage.updateStatus');
});
// });



// for user panel
Route::middleware(['isUser'])->prefix('user/')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('user.home');

    Route::get('profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::get('volunteers/search', [VolunteerController::class, 'search'])->name('user.volunteer.search');
    Route::post('volunteers/search', [VolunteerController::class, 'searchDetails'])->name('user.volunteer.view-details');

    Route::get('drive/add', [DriveController::class, 'addView'])->name('user.drive.add');
    Route::post('drive/add', [DriveController::class, 'addDrive'])->name('user.drive.add');
    Route::get('drive/attendance/add', [DriveController::class, 'addAttendance'])->name('user.drive.add.attendance');
    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('user.drive.add.attendance');

    // Route::post('drive/attendance/add/getName', [VolunteerController::class, 'getName'])->name('getName');

    Route::delete('drive/attendance/delete', [AttendanceController::class, 'delete'])->name('user.attendance.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('getname/{regno}', [VolunteerController::class, 'getName']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/password', [ProfileController::class, 'update'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::get('register', function () {
    return view('auth.register');
})->name('register');
Route::get('confirm-password', function () {
    return view('auth.confirm-password');
})->name('confirm-password');
