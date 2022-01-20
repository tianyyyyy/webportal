<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\SchlyrOrgController;
use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\OrgProfileController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\admin\AdminFileController;
use App\Http\Controllers\admin\AdminPostsController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\AdminSchoolYearController;
use App\Http\Controllers\admin\AdminOrganizationController;
use App\Http\Controllers\admin\AdminRegistrationsController;

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


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts')->middleware('auth');

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

Route::get('/orgregistration', [RegistrationController::class, 'index'])->name('orgregistration');
Route::post('/orgregistration', [RegistrationController::class, 'store'])->name('orgregistration');

Route::get('/files', [FileController::class, 'index'])->name('files');
Route::post('/files', [FileController::class, 'store'])->name('files');
Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile');

Route::get('/admin/dashboard', [AdminIndexController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/admin-posts', [AdminPostsController::class, 'index'])->name('admin.posts')->middleware('auth');
Route::get('/admin-posts/{id}', [AdminPostsController::class, 'show'])->name('admin.posts.show')->middleware('auth');
Route::get('/admin-posts/{published}/published', [AdminPostsController::class, 'publish'])->name('admin.posts.publish')->middleware('auth');

Route::get('/admin-users', [AdminUsersController::class, 'index'])->name('admin.users')->middleware('auth');
Route::get('/admin-users/{status}', [AdminUsersController::class, 'status'])->name('admin.users.status')->middleware('auth');
Route::get('/admin-user/{admin}/admin', [AdminUsersController::class, 'admin'])->name('admin.users.admin')->middleware('auth');

Route::get('/admin-organizations', [AdminOrganizationController::class, 'index'])->name('admin.organizations')->middleware('auth');
Route::post('/admin-organizations', [AdminOrganizationController::class, 'store'])->name('admin.organizations')->middleware('auth');
Route::delete('/admin-organizations/{organization}', [AdminOrganizationController::class, 'destroy'])->name('admin.organization.destroy')->middleware('auth');
Route::get('/admin-organizations/{organization}/edit', [AdminOrganizationController::class, 'edit'])->name('admin.organization.edit')->middleware('auth');
Route::post('/admin-organizations/{organization}/update', [AdminOrganizationController::class, 'update'])->name('admin.organization.update')->middleware('auth');
Route::delete('/admin-organization/{schlyr}/destroy', [AdminOrganizationController::class, 'delete'])->name('admin.schlyr.destroy')->middleware('auth');

Route::post('/admin-schoolyear', [AdminSchoolYearController::class, 'store'])->name('admin.schoolyear')->middleware('auth');
Route::get('/{schlyr:schlyr}/organizations', [SchlyrOrgController::class, 'show'])->name('admin.schlyr.organization')->middleware('auth');

Route::get('/{schlyr:schlyr}/organization/profiles', [OrgProfileController::class, 'show'])->name('organization.profile');
Route::get('/{organization:name}/org/profiles', [OrgProfileController::class, 'profiles'])->name('organization.profile-org');

Route::get('/admin-profile', [AdminProfileController::class, 'index'])->name('admin.profile')->middleware('auth');
Route::delete('/profile/{profile}', [AdminProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');
Route::get('/admin-profile/{organization:name}/profiles', [AdminProfileController::class, 'show'])->name('admin.organization.profile');

Route::get('/admin-file/schlyr', [AdminFileController::class, 'index'])->name('admin.files')->middleware('auth');
Route::get('/admin-file/{schlyr:schlyr}/organizations', [AdminFileController::class, 'show'])->name('admin.organization.list')->middleware('auth');
Route::get('/admin-file/{organization:name}/files', [AdminFileController::class, 'files'])->name('admin.organization.files')->middleware('auth');
Route::get('/admin-file/{status}/status', [AdminFileController::class, 'status'])->name('admin.file.status')->middleware('auth');
Route::get('/admin-file/{file:file}/file', [AdminFileController::class, 'download'])->name('admin.file.download')->middleware('auth');

Route::get('full-calender', [FullCalenderController::class, 'index'])->name('admin.events')->middleware('auth');
Route::post('full-calender/store', [FullCalenderController::class, 'store'])->name('admin.events.store')->middleware('auth');
Route::delete('/full-calender/{event}', [FullCalenderController::class, 'destroy'])->name('admin.events.destroy')->middleware('auth');
Route::get('/full-calender/{status}', [FullCalenderController::class, 'status'])->name('admin.events.status');

Route::get('/admin-registrations', [AdminRegistrationsController::class, 'index'])->name('admin.registrations')->middleware('auth');
Route::get('/admin-registrations/{registration:file}/download', [AdminRegistrationsController::class, 'download'])->name('admin.registration.download')->middleware('auth');
Route::delete('/admin-registrations/{registration}', [AdminRegistrationsController::class, 'destroy'])->name('admin.registration.destroy')->middleware('auth');
