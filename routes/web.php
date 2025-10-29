<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Setup\DepartmentController;
use App\Http\Controllers\Setup\DesignationController;
use App\Http\Controllers\UserConfig\MenuAssignController;
use App\Http\Controllers\UserConfig\MenuController;
use App\Http\Controllers\UserConfig\RolesController;
use App\Http\Controllers\UserConfig\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});
// routes/web.php
// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

// Registration page
Route::get('/register', [UsersController::class, 'registerForm'])->name('register');
Route::post('/register', [UsersController::class, 'register'])->name('register.post');
Route::post('/users/{id}', [UsersController::class, 'user-delete'])->name('user-delete');



Route::get('login', [\App\Http\Controllers\UserConfig\UsersController::class, 'LoginFrom'])->name('login');
// Route::get('getEmployeeInfo', [\App\Http\Controllers\Setup\EmployeeController::class, 'getEmployeeInfo'])->name('getEmployeeInfo');
Route::post('requestLogin', [\App\Http\Controllers\UserConfig\UsersController::class, 'authenticate'])->name('requestLogin');
Route::post('/logout', [\App\Http\Controllers\UserConfig\UsersController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('SidebarNav', App\Http\Controllers\WebSetup\SidebarNavController::class);
Route::post('/get/all/SidebarNav', [App\Http\Controllers\WebSetup\SidebarNavController::class, 'getData'])->name('all.SidebarNav');
Route::resource('menuassign', MenuAssignController::class);
Route::get('get-assigned-menus/{menu_role}', [MenuAssignController::class, 'getAssignedMenus']);




Route::resource('Permission', App\Http\Controllers\UserConfig\PermissionController::class);
Route::post('/get/all/Permission', [App\Http\Controllers\UserConfig\PermissionController::class, 'getData'])->name('all.Permission');

// Roles and Permissions Routes
Route::resource('roles', App\Http\Controllers\UserConfig\RolesController::class);
Route::get('/get/all/Roles', [App\Http\Controllers\UserConfig\RolesController::class, 'getData'])->name('all.Roles');
Route::get('/addpermission/{roleid}', [\App\Http\Controllers\UserConfig\RolesController::class, 'addPermissionToRole']);
Route::post('GivePermissionToRole', [\App\Http\Controllers\UserConfig\RolesController::class, 'GivePermissionToRole']);
Route::get('/addmenu/{roleid}', [RolesController::class, 'addMenuToRole']);

Route::post('GiveMenuToRole', [RolesController::class, 'GiveMenuToRole']);

// User Management Routes
Route::resource('User', \App\Http\Controllers\UserConfig\UsersController::class);
Route::get('GetRoles', [\App\Http\Controllers\UserConfig\UsersController::class, 'GetRoles'])->name('GetRoles');
Route::get('GetBranch', [\App\Http\Controllers\UserConfig\UsersController::class, 'GetBranch']);
Route::post('/get/all/User', [\App\Http\Controllers\UserConfig\UsersController::class, 'getData'])->name('all.User');
Route::get('/users-profile', [\App\Http\Controllers\UserConfig\UsersController::class, 'profile'])->name('users-profile');



Route::resource('menu', MenuController::class);
Route::get('/get/all/menu', [MenuController::class, 'getMenuData'])->name('all.menu');
Route::get('/get/menu/{id}', [MenuController::class, 'getMenuByRole']);
Route::get('/getparentmenus', [MenuController::class, 'getParentMenus'])->name('getparentmenus');



Route::resource('menuassign', MenuAssignController::class);
Route::get('/get/all/menuassign', [MenuAssignController::class, 'getMenuData'])->name('all.menuassign');
Route::get('/addroletomenu/{menuid}', [MenuAssignController::class, 'addRoleToMenu']);
Route::get('/get-menus', [MenuAssignController::class, 'getMenus']);
Route::get('/get-roles', [MenuAssignController::class, 'getRoles']);


Route::resource('Department', DepartmentController::class);
Route::get('/get/all/department', [DepartmentController::class, 'getData'])->name('all.Department');

Route::resource('Designation', DesignationController::class);
Route::get('/get/all/designation', [DesignationController::class, 'getData'])->name('all.Designation');
