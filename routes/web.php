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
//rute se pisu na ovaj nacin , get-metod za samo posetu stranice, /-znaci da je home page, funkcija kao u js-u
Route::get('/', function () {
    return view('welcome');            //fja vraca view koji se zove welcome
}); //home page ucitava view welcome

Route::get('/hello', function () {       //dodajemo novu rutu, Npr ako zelimo da potvrdimo formu, metod ce biti post
    //return 'Hello!';            //fja vraca Hello!, takodje mozemo da stavimo i da vraca neki HTML
    return '<h1>Hello!</h1>';
});

//Route::get('/about', function () {   //ruta za novi view koji smo napravili, nalazi se u folderu pages a zove se about
//    return view('pages.about');   //umesto ove sintakse sa tackom moze i pages/about
//});

Route::get('/users/{id}/{name}', function ($id,$name) {   //dinamicka ruta, kada zelimo na primer korisnika za odredjeni ID
    return 'This is user '.$name.' with ID '.$id;    //ID stavljamo u uglastim zagradama, i prosledjujemo promenljivu funkciji
});   //promenljive sa $, konkatenacija sa .

//ruta koja poziva funkciju kontrolera, umesto callback funckije navodimo naziv kontrolera @ naziv funkcije
Route::get('/', 'PagesController@index');

//Route::get('/about', function () {   //ruta za novi view koji smo napravili, nalazi se u folderu pages a zove se about
//    return view('pages.about');   //umesto ove sintakse sa tackom moze i pages/about
//});

Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

// da u terminalu vidimo sve rute koje imamo kucamo: php artisan route:list

Route::resource('posts', 'PostsController'); // ovo automatski za nas kreira rute za sve funkcije u PostsController
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//->middleware('auth'); sluzi da obezbedi da samo ulogovani korisnici mogu da pristupe stranici. ako nisu ulgovani,
// redirektuje na stranicu navedenu u funkciji redirecTo() u app/http/middleware/authenticate.php
