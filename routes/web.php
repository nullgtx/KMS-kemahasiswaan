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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function () {
    return view('auth.daftar');
});



Route::group(['middleware' => ['guest']], function () {    
	Route::get('login', 'AuthController@login')->name('login');
    Route::post('login', 'AuthController@ceklogin')->name('login');
    Route::get('/register', function(){ return view('auth.daftar'); })->name('register');
    Route::post('/register', 'RegisterController@store')->name('register');

});


Route::group(['middleware'=>['auth']], function(){ 
    Route::get('logout', 'AuthController@logout')->name('logout');
	Route::get('dashboard','AuthController@cekRole')->name('dashboard');  
    
        Route::group(['middleware'=>['admin']],function(){
            Route::namespace('Admin')->group(function(){
                Route::prefix('admin')->group(function(){
                    Route::get('/', 'AdminController@index')->name('admin.dashboard');

                    Route::get('profile', 'ProfileController@index')->name('admin.profile.index');
                    Route::put('profile', 'ProfileController@update')->name('admin.profile.update');

                    Route::resource('articles', 'ArticlesController', ['as' => 'admin']);
                    Route::get('articles-data', 'ArticlesController@data')->name('admin.articles.data');
    
                });
            });
        });
    
        Route::group(['middleware'=>['member']],function(){
            Route::namespace('Member')->group(function(){
                Route::prefix('member')->group(function(){
                Route::get('/', 'MemberController@index')->name('member.dashboard');

                Route::get('profile', 'ProfileController@index')->name('member.profile.index');
                Route::put('profile', 'ProfileController@update')->name('member.profile.update');
    
                });
            });
        });    
});



Route::get('/home', 'HomeController@index')->name('home');
