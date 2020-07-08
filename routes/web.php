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

                    Route::resource('admins', 'AdminsController', ['as' => 'admin'])->except('show');
                    Route::get('admins-data', 'AdminsController@data')->name('admin.admins.data');

                    Route::resource('members', 'MembersController', ['as' => 'admin'])->except('show');
                    Route::get('members-data', 'MembersController@data')->name('admin.members.data');

                    Route::resource('spm', 'SpmController', ['as' => 'admin']);
                    Route::get('spm-data', 'SpmController@data')->name('admin.spm.data');

                    Route::resource('articles', 'ArticlesController', ['as' => 'admin']);
                    Route::get('articles-data', 'ArticlesController@data')->name('admin.articles.data');

                    Route::resource('knowledge', 'KnowledgeController', ['as' => 'admin'])->only(['index', 'destroy']);
                    Route::get('knowledge-data', 'KnowledgeController@data')->name('admin.knowledge.data');
                    Route::get('knowledge-confirm/{knowledge}', 'KnowledgeController@confirm')->name('admin.knowledge.confirm');

    
                });
            });
        });
    
        Route::group(['middleware'=>['member']],function(){
            Route::namespace('Member')->group(function(){
                Route::prefix('member')->group(function(){
                Route::get('/', 'MemberController@index')->name('member.dashboard');

                Route::get('profile', 'ProfileController@index')->name('member.profile.index');
                Route::put('profile', 'ProfileController@update')->name('member.profile.update');

                Route::resource('knowledge', 'KnowledgeController', ['as' => 'member']);
                Route::get('knowledge-data', 'KnowledgeController@data')->name('member.knowledge.data');
    
                });
            });
        });    
});



Route::get('/home', 'HomeController@index')->name('home');
