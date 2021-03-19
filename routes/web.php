<?php

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
// creer une route statistique qui renvoie le nombre de tickets terminer par un utilisateur

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@store')->name('store');
Route::get("first", 'FirstController@firstMethode');
Route::get("tickets", 'FirstController@getTickets')->name('tickets')->middleware('auth');
Route::get('statistiques/{user_id}', 'TicketController@show');
Route::get('dashboard', 'TicketController@index')->name('dashboard')->middleware("verified_role");
Route::get('utilisateur', 'UtilisateurController@index')->middleware("verified_role");
Route::get('utilisateur/create', 'UtilisateurController@create');
Route::post('utilisateur', 'UtilisateurController@store');
Route::post('attribuer', 'UtilisateurController@attribuer')->name("attribuer");
Route::get('roles/{user}', 'UtilisateurController@getRoles')->name('roles');
Route::post('roles', 'UtilisateurController@createRole')->name('create_role');
Route::post('role-user', 'UtilisateurController@affecter')->name('role-user');
Route::post('ticket/{id}/{statut}', 'FirstController@setEtatTicket')->name('update-ticket');


//authentification
Route::get('signin', "SigninController@index")->name('login');
Route::post('signin', "SigninController@login")->name('signin');
Route::get('signout', 'SigninController@deconnexion')->name('signout');
Route::post('search', 'HomeController@search')->name('search')->middleware("auth");
