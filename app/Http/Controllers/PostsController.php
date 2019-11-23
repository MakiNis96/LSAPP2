<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // unosenje modela namespace , naziv Post, ovo radimo da bismo mogli da pisemo fje nad modelom
// ovaj kontroler kreiramo naredbom: php artisan make:controller PostsController --resource
// dodajemo funkcije za CRUD
// index - za izlistavanje svih postova
// create - za kreiranje posta - forma za kreiranje
// store - cuvanje podataka kada se klikne submit na formi
// edit - forma za editovanje posta
// update - kada se submituje forma za editovanje
// show - za prikazivanje jednog posta
// destroy - za brisanje posta
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // ovom pristupamo sa /posts (bez index)
    {
        //sada mozemo da koristimo fje nad modelom, koristicemo Eloquent za pisanje upita
        $posts = Post::all(); //ovom fjom pribavljamo sve iz modela, odnosno tabele, vraca niz koji cemo zapamtiti u promenljivu
        // return view('posts.index'); //vraca taj view
        return view('posts.index')->with('posts', $posts); // prenosimo taj parametar u view, i tamo ga koristimo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // parametri su iz forme koji se prenose na submit
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  // parametar id posta koji prikazujemo
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // parametar id posta koji azuriramo
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
