<?php

use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Auth::routes();

Route::get('/{id}/category', 'App\Http\Controllers\FrontendController@albumCategory')->name('album.category');
Route::get('/profile', 'App\Http\Controllers\FollowController@profile')->name('profile');

Route::get('/user/{id}', 'App\Http\Controllers\FollowController@userProfilePic')->middleware('auth');
Route::post('/profile-pic', 'App\Http\Controllers\FollowController@updateProfilePic')->middleware('auth');
Route::post('/bg-pic', 'App\Http\Controllers\FollowController@updateBgPic')->middleware('auth');
Route::get('/user/bg/{id}', 'App\Http\Controllers\FollowController@userBgPic')->middleware('auth');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', 'App\Http\Controllers\FrontendController@index');
Route::get('/home', 'App\Http\Controllers\FrontendController@index');

Route::post('/follow', 'App\Http\Controllers\FollowController@followUnfollow')->middleware('auth');
Route::post('/like', 'App\Http\Controllers\LikesController@LikeUnlike')->middleware('auth');

Route::get('/user/profile/{id}', 'App\Http\Controllers\FrontendController@userAlbum')->name('user.album');


Route::get('/getalbums', 'App\Http\Controllers\AlbumController@getAlbums')->middleware('auth');
Route::get('/albums', 'App\Http\Controllers\AlbumController@index')->middleware('auth');


Route::get('/albums/create', 'App\Http\Controllers\AlbumController@create')->name('album.create')->middleware('auth');
Route::post('/albums/store', 'App\Http\Controllers\AlbumController@store')->middleware('auth');
Route::put('/albums/{id}/edit', 'App\Http\Controllers\AlbumController@update')->middleware('auth');
Route::delete('/albums/{id}/delete', 'App\Http\Controllers\AlbumController@destroy')->middleware('auth');

Route::get('/upload/images/{id}', 'App\Http\Controllers\GalleryController@create')->middleware('auth');
Route::post('/uploadImage', 'App\Http\Controllers\GalleryController@upload')->middleware('auth');
Route::get('getimages','App\Http\Controllers\GalleryController@images')->middleware('auth');
Route::delete('/image/{id}', 'App\Http\Controllers\GalleryController@destroy')->middleware('auth');

Route::get('/albums/{slug}/{id}', 'App\Http\Controllers\GalleryController@viewAlbum')->name('view.album');

Route::post('/addtags/{id}', 'App\Http\Controllers\GalleryController@addTags');
Route::get('/tags/{id}', 'App\Http\Controllers\GalleryController@showTags');

Route::get('/getimage/{tag?}', 'App\Http\Controllers\GalleryController@getImagesbytags');

Route::get('/doilike/{imageid}', 'App\Http\Controllers\LikesController@doIlike')->middleware('auth');