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


Route::get('/', [AuthController::class, 'create'])->name('login-page');
Route::post('login', [AuthController::class, 'store'])->name('login');

Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('batch/regsitrationForm/{batch}', [BatchController::class, 'registrationForm'])->name('batch.registration-form');

Route::post('batch/regsitrationForm/register', [BatchController::class, 'register'])->name('volunteer-register-form');

// routes for admin panel

Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.home');

    Route::get('profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

    Route::get('courses/manage', [HomeController::class, 'manageCourses'])->name('courses.manage');

    Route::post('courses/add', [HomeController::class, 'addCourse'])->name('admin.add-course');

    Route::post('courses/update', [HomeController::class, 'updateCourse'])->name('admin.update-course');

    Route::delete('courses/delete', [HomeController::class, 'deleteCourse'])->name('admin.delete-course');

    Route::prefix('volunteer')->group(function () {
        Route::get('add', [VolunteerController::class, 'add'])->name('volunteer.add');

        Route::post('add', [VolunteerController::class, 'insert'])->name('volunteer.add-new');

        Route::get('search', [VolunteerController::class, 'search'])->name('volunteer.search');

        // volunteer manage start
        Route::get('manage', [VolunteerController::class, 'manage'])->name('volunteer.manage');

        Route::get('manage/view-edit', [VolunteerController::class, 'viewEdit'])->name('volunteer.view-edit');

        Route::post('manage/search/', [VolunteerController::class, 'searchDetails'])->name('volunteer.search-details');

        Route::post('manage/view-edit/update', [VolunteerController::class, 'updateDetails'])->name('volunteer.update');

        Route::delete('/manage/delete', [VolunteerController::class, 'delete'])->name('volunteer.delete');

        Route::get('manage/list-all', [VolunteerController::class, 'list'])->name('volunteer.list-all');

        Route::post('manage/list-all', [VolunteerController::class, 'fetchDetails'])->name('volunteer.list-all');

        Route::get('manage/export', [VolunteerController::class, 'exportView'])->name('volunteer.export');

        Route::post('manage/export', [VolunteerController::class, 'fetch'])->name('volunteer.fetchData');
    });

    // volunteer manage end

    // drive section start
    Route::get('drive/manage/list', [DriveController::class, 'listAll'])->name('drive.list');

    Route::post('drive/manage/list/search', [DriveController::class, 'searchDrive'])->name('drive.search');

    Route::get('/drive/manage/view/{id}', [DriveController::class, 'viewDrive'])->name('drive.view');

    Route::post('drive/manage/list/update', [DriveController::class, 'update'])->name('drive.updateDetails');

    Route::delete('/drive/manage/list/delete', [DriveController::class, 'delete'])->name('drive.delete');

    Route::get('drive/add', [DriveController::class, 'addView'])->name('drive.add');

    Route::post('drive/add', [DriveController::class, 'addDrive'])->name('drive.add');

    Route::get('drive/attendance', [DriveController::class, 'showAttendance'])->name('drive.attendance');

    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('drive.add-attendance');

    Route::delete('drive/attendance/delete', [AttendanceController::class, 'delete'])->name('drive.attendance.delete');

    // drive section end

    Route::get('users/manage', [UserController::class, 'index'])->name('users.manage');

    Route::post('users/manage/add', [UserController::class, 'addModerator'])->name('add-moderator');

    Route::get('users/manage/view/{id}', [UserController::class, 'viewModerator'])->name('moderator-details');

    Route::patch('users/manage/block', [UserController::class, 'blockUser'])->name('user.block');

    Route::patch('users/manage/unblock', [UserController::class, 'unblockUser'])->name('user.unblock');

    Route::post('volunteer/export', [VolunteerController::class, 'exportVolunteers'])->name('volunteer.export-post');

    Route::get('drive/attendance/{driveId}', [DriveController::class, 'getAttendees'])->name('attendance.getAttendees');

    // batch section start

    Route::get('batch/manage', [BatchController::class, 'manage'])->name('batch.manage');

    Route::post('batch/manage/create', [BatchController::class, 'create'])->name('batch.create');

    Route::get('batch/manage/edit', [BatchController::class, 'viewEdit'])->name('batch.view-edit');

    Route::post('batch/manage/update', [BatchController::class, 'updateBatchInfo'])->name('batch.update');

    Route::delete('batch/manage/delete', [BatchController::class, 'delete'])->name('batch.delete');


    // ajax
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

    Route::get('drive/attendance/add', [DriveController::class, 'addAttendance'])->name('user.drive.add-attendance');

    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('user.drive.add.attendance');

    Route::delete('drive/attendance/delete', [AttendanceController::class, 'delete'])->name('user.attendance.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('volunteer/getInfo/{regno}', [VolunteerController::class, 'getVolunteerInfo'])->name('getVolunteerById');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/search-attendees', [AttendanceController::class, 'search'])->name('search.attendees');
});

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordView'])
    ->name('password.reset');

Route::post('reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.store');
