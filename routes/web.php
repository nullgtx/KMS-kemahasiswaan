<?php

use App\Mail\RegisteredEmail;
use Illuminate\Support\Facades\Mail;

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
    return view('auth.login');
});

Route::get('/coba', function () {
    return view('auth.daftar');
});


Route::group(['middleware' => ['guest']], function () {    
	Route::get('login', 'AuthController@login')->name('login');
    Route::post('login', 'AuthController@ceklogin')->name('login');
    Route::get('/register', function(){ return view('auth.daftar'); })->name('register');
    Route::post('/register', 'RegisterController@store')->name('register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

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
    
                });
            });
        });

        Route::group(['middleware'=>['operator']],function(){
            Route::namespace('Admin')->group(function(){
                Route::prefix('admin')->group(function(){
                    Route::get('/', 'AdminController@index')->name('admin.dashboard');

                    Route::get('profile', 'ProfileController@index')->name('admin.profile.index');
                    Route::put('profile', 'ProfileController@update')->name('admin.profile.update');

                    Route::resource('spm', 'SpmController', ['as' => 'admin']);
                    Route::get('spm-data', 'SpmController@data')->name('admin.spm.data');

                    Route::resource('articles', 'ArticlesController', ['as' => 'admin']);
                    Route::get('articles-data', 'ArticlesController@data')->name('admin.articles.data');
                    Route::get('articles/view/{article}', 'ArticlesController@view')->name('admin.articles.view');
                    Route::get('semuaarticles', 'ArticlesController@indexsemua')->name('admin.articles.indexsemua');

                    Route::resource('knowledge', 'KnowledgeController', ['as' => 'admin'])->only(['index', 'destroy']);
                    Route::get('knowledge-data', 'KnowledgeController@data')->name('admin.knowledge.data');
                    Route::get('knowledge-confirm/{knowledge}', 'KnowledgeController@confirm')->name('admin.knowledge.confirm');

                    Route::resource('kegiatan', 'KegiatanController', ['as' => 'admin'])->only(['index', 'destroy']);
                    Route::get('kegiatan-data', 'KegiatanController@data')->name('admin.kegiatan.data');
                    Route::get('kegiatan-confirm/{kegiatan}', 'KegiatanController@confirm')->name('admin.kegiatan.confirm');

                    Route::resource('forum', 'ForumController', ['as' => 'admin'])->except('show');
                    Route::get('forum', 'ForumController@index')->name('admin.forum.index');
                    Route::get('forum/cari', 'ForumController@cari');
                    Route::get('forum/view/{forum}', 'ForumController@view')->name('admin.forum.view');
                    Route::post('forum/view/{forum}/komentar', 'KomentarController@store')->name('admin.komentar.store');
                    Route::delete('forum/view/{forum}/komentar', 'KomentarController@destroy')->name('admin.komentar.destroy');

    
                });
            });
        });
    
        Route::group(['middleware'=>['himpunan']],function(){
            Route::namespace('Member')->group(function(){
                Route::prefix('member')->group(function(){
                Route::get('/', 'MemberController@index')->name('member.dashboard');

                Route::get('profile', 'ProfileController@index')->name('member.profile.index');
                Route::put('profile', 'ProfileController@update')->name('member.profile.update');

                Route::resource('knowledge', 'KnowledgeController', ['as' => 'member']);
                Route::get('knowledge-data', 'KnowledgeController@data')->name('member.knowledge.data');
                Route::get('semuaknowledge', 'KnowledgeController@indexsatu')->name('member.knowledge.indexsatu');
                Route::get('semuaknowledge/cari', 'KnowledgeController@cari');
                Route::get('knowledge-semuadata', 'KnowledgeController@semuadata')->name('member.knowledge.semuadata');

                
                Route::resource('forum', 'ForumController', ['as' => 'member']);
                Route::get('forum-data', 'ForumController@data')->name('member.forum.data');
                Route::get('semuaforum', 'ForumController@indexsatu')->name('member.forum.indexsatu');
                Route::get('semuaforum/cari', 'ForumController@cari');
                Route::get('semuaforum/view/{forum}', 'ForumController@view')->name('member.forum.view');
                Route::post('semuaforum/view/{forum}/komentar', 'KomentarController@store')->name('member.komentar.store');
                Route::delete('semuaforum/view/{forum}/komentar', 'KomentarController@destroy')->name('member.komentar.destroy');
                

                Route::resource('articles', 'ArticlesController', ['as' => 'member']);
                Route::get('articles', 'ArticlesController@index')->name('member.articles.index');
                Route::get('articles/view/{article}', 'ArticlesController@view')->name('member.articles.view');
                
                Route::resource('spm', 'SpmController', ['as' => 'member']);
                Route::get('spm', 'SpmController@index')->name('member.spm.index');

                Route::resource('kegiatan', 'KegiatanController', ['as' => 'member']);
                Route::get('kegiatan-data', 'KegiatanController@data')->name('member.kegiatan.data');
    
    
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
                Route::get('semuaknowledge', 'KnowledgeController@indexsatu')->name('member.knowledge.indexsatu');
                Route::get('semuaknowledge/cari', 'KnowledgeController@cari');
                Route::get('knowledge-semuadata', 'KnowledgeController@semuadata')->name('member.knowledge.semuadata');

                
                Route::resource('forum', 'ForumController', ['as' => 'member']);
                Route::get('forum-data', 'ForumController@data')->name('member.forum.data');
                Route::get('semuaforum', 'ForumController@indexsatu')->name('member.forum.indexsatu');
                Route::get('semuaforum/cari', 'ForumController@cari');
                Route::get('semuaforum/view/{forum}', 'ForumController@view')->name('member.forum.view');
                Route::post('semuaforum/view/{forum}/komentar', 'KomentarController@store')->name('member.komentar.store');
                Route::delete('semuaforum/view/{forum}/komentar', 'KomentarController@destroy')->name('member.komentar.destroy');
                

                Route::resource('articles', 'ArticlesController', ['as' => 'member']);
                Route::get('articles', 'ArticlesController@index')->name('member.articles.index');
                Route::get('articles/view/{article}', 'ArticlesController@view')->name('member.articles.view');
                
                Route::resource('spm', 'SpmController', ['as' => 'member']);
                Route::get('spm', 'SpmController@index')->name('member.spm.index');

                });
            });
        }); 
        

});



Route::get('/home', 'HomeController@index')->name('home');
