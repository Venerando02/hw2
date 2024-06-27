<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return view('index');
});

Route::get('index', function () 
{
    return view('index');
});


Route::get('register', 'App\Http\Controllers\LoginController@register_form');
Route::post('do_register', 'App\Http\Controllers\LoginController@do_register');
Route::get('login', 'App\Http\Controllers\LoginController@login_form');
Route::post('do_login', 'App\Http\Controllers\LoginController@do_login');
Route::get('checkEmail/{email}', 'App\Http\Controllers\LoginController@checkEmail');
Route::get('checkUsername/{username}', 'App\Http\Controllers\LoginController@checkUsername');
Route::get('logout', 'App\Http\Controllers\LoginController@Logout');


Route::get('home', 'App\Http\Controllers\HomeController@home');
Route::get('gnews/{query}', 'App\Http\Controllers\HomeController@searchGnews');
Route::post('lettura_articolo', 'App\Http\Controllers\HomeController@lettura_articolo');


Route::get('fanpage', 'App\Http\Controllers\FanpageController@fanpage');
Route::get('transfermarket1/{calciatore}', 'App\Http\Controllers\FanpageController@transfermarket1');
Route::get('transfermarket2/{id}', 'App\Http\Controllers\FanpageController@transfermarket2');
Route::post('InsertPlayer', 'App\Http\Controllers\FanpageController@inserisci_giocatore');
Route::get('Spotify', 'App\Http\Controllers\FanpageController@Spotify');
Route::post('InsertAlbum','App\Http\Controllers\FanpageController@InsertAlbum');
Route::get('MostraAlbum', 'App\Http\Controllers\FanpageController@MostraAlbum');
Route::get('InserisciLike/{album}', 'App\Http\Controllers\FanpageController@InserisciLike');
Route::get('RimuoviLike/{album}', 'App\Http\Controllers\FanpageController@RimuoviLike');


Route::get('profile', 'App\Http\Controllers\ProfileController@profile');
Route::get('ControlPassword/{password}', 'App\Http\Controllers\ProfileController@ControlPassword');
Route::post('ChangePassword', 'App\Http\Controllers\ProfileController@ChangePassword');
Route::get('MostraArticoliLetti', 'App\Http\Controllers\ProfileController@MostraArticoliLetti');
Route::get('MostraGiocatoriPreferiti', 'App\Http\Controllers\ProfileController@MostraGiocatoriPreferiti');
Route::get('EliminaGiocatoriPreferiti/{id}', 'App\Http\Controllers\ProfileController@EliminaGiocatoriPreferiti');
Route::get('EliminaArticoliLetti/{id}', 'App\Http\Controllers\ProfileController@EliminaArticoliLetti');