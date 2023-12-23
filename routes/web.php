<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\USers\UserController;
use App\Http\Controllers\Users\AdminController;
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

// require __DIR__ . '/auth.php';

Route::get('/welcome', function(){
    return view('welcome');
})->name('welcome');
Route::get('/', [AuthenticatedSessionController::class, 'sessionValidate'])->name('root');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
->name('password.email');

// routes for admin panel

Route::middleware(['isAdmin'])->prefix('admin/')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('profile', [UserController::class, 'index'])->name('admin.profile.edit');

    Route::get('volunteer/add', [VolunteerController::class, 'add'])->name('volunteer.add');
    Route::post('volunteer/add-new', [VolunteerController::class, 'insert'])->name('volunteer.add-new');
    Route::get('volunteer/search', [VolunteerController::class, 'search'])->name('volunteer.search');

    // volunteer manage start
    Route::get('/volunteer/manage', [VolunteerController::class, 'manage'])->name('volunteer.manage');
    Route::post('/volunteer/manage/view-edit', [VolunteerController::class, 'viewDetails'])->name('volunteer.view-details');
    Route::get('/volunteer/manage/view-edit', [VolunteerController::class, 'view_edit'])->name('volunteer.view-edit');

    Route::get('/volunteer/manage/view-edit/update{id}', [VolunteerController::class, 'viewUpdate'])->name('volunteer.view-update');
    Route::post('/volunteer/manage/view-edit/update', [VolunteerController::class, 'updateDetails'])->name('volunteer.update');

    Route::get('/volunteer/manage/list-all', [VolunteerController::class, 'list'])->name('volunteer.list-all');

    Route::post('/volunteer/manage/list-all', [VolunteerController::class, 'fetchDetails'])->name('volunteer.list-all');

    // volunteer manage end

    // drive section start
    Route::get('/drive/manage/list', [DriveController::class, 'listAll'])->name('drive.list');
    Route::post('/drive/manage/list/search', [DriveController::class, 'searchDrive'])->name('drive.search');

    Route::post('/drive/manage/list/update', [DriveController::class, 'update'])->name('drive.updateDetails');

    Route::delete('/drive/manage/list/delete', [DriveController::class, 'delete'])->name('drive.deleteDetails');

    Route::get('/drive/add', [DriveController::class, 'addView'])->name('drive.add');
    Route::post('/drive/add', [DriveController::class, 'addDrive'])->name('drive.add');
    Route::get('/drive/attendance', [DriveController::class, 'attendance'])->name('drive.attendance');
    Route::get('/drive/attendance', [DriveController::class, 'showAttendance'])->name('user.drive.show.attendance');


    // drive section end

    Route::get('/users/manage', [UserController::class, 'listUsers'])->name('users.manage');
});
// });



// for user panel
Route::middleware(['isUser'])->prefix('user/')->group(function () {
    Route::get('dashboard', function () {
        return view('user.home');
    })->name('user.home');

    Route::get('profile', [UserController::class, 'index'])->name('user.profile.edit');
    Route::get('volunteers/search', [VolunteerController::class, 'search'])->name('user.volunteer.search');
    Route::post('volunteers/search', [VolunteerController::class, 'viewDetails'])->name('user.volunteer.view-details');


    Route::get('drive/add', [DriveController::class, 'addView'])->name('user.drive.add');
    Route::post('drive/add', [DriveController::class, 'addDrive'])->name('user.drive.add');
    Route::get('drive/attendance/add', [DriveController::class, 'addAttendance'])->name('user.drive.add.attendance');
    Route::post('drive/attendance/add', [AttendanceController::class, 'add'])->name('user.drive.add.attendance');

    Route::post('drive/attendance/add/getName', [VolunteerController::class, 'getName'])->name('getName');
});

// Route::middleware(['isUser'])->group(function () {
//     Route::get('/user/dashboard', function () {
//         return view('user-home');
//     })->name('user.home');

//     Route::get('/volunteer/search', [VolunteerController::class, 'search'])->name('volunteer.search');

//     Route::get('/drive/add', [DriveController::class, 'addView'])->name('drive.add');
//     Route::post('/drive/add', [DriveController::class, 'addDrive'])->name('drive.add');
//     Route::get('/drive/attendance', [DriveController::class, 'attendance'])->name('drive.attendance');

//     Route::get('/user/dashboard/manage', [UserController::class, 'index'])->name('users.manage');

//     Route::get('/admin/profile', function () {
//                 return view('profile-edit');
//             })->name('admin-profile');

// });

Route::get('/test', function () {
    return "Hello from test";
});

Route::post('ajaxupload', [VolunteerController::class, 'ajax'])->name('test');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


