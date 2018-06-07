<?php

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

Auth::routes();

/*
|--------------------------------------------------------------------------
| Localization Routes of JavaScript
|--------------------------------------------------------------------------
*/
Route::get('/js/lang.js', function () {
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');
        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];
        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }
        return $strings;
    });
    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('index'); })->name('/'); // Home

/*
|--------------------------------------------------------------------------
| Common Web Routes
|--------------------------------------------------------------------------
*/
Route::get('getmenu', 'CommonController@getMenu')->name('getmenu'); // Get Menu
Route::get('admin/getmenu', 'CommonController@getAdminMenu')->name('getadminmenu'); // Get Admin Menu
Route::post('contact', 'CommonController@contactUs')->name('contact'); // Contact Us: Send contact email

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/
Route::get('admin', 'Admin\AdminPagesController@index')->name('admin'); // Index page
Route::get('admin/officer', 'Admin\AdminPagesController@officer')->name('admin.officer'); // Officer landing page
Route::get('admin/super', 'Admin\AdminPagesController@super')->name('admin.super'); // Super Admin landing page
Route::get('admin/officer/usersStart', 'Admin\AdminPagesController@usersStart')->name('admin.users.start'); // Super Admin landing page

/*
|--------------------------------------------------------------------------
| Admin Subpages' Routes
|--------------------------------------------------------------------------
*/
// GET/PUT/DELETE users table 
Route::resource('admin/officer/users', 'Admin\UsersController', [ 'except' => [ 'store', 'create', 'edit', 'show' ], 'as' => 'admin' ] );