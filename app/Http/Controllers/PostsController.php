<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // unosenje modela namespace , naziv Post, ovo radimo da bismo mogli da pisemo fje nad modelom
use DB; //za pisanje SQL upita, bez Eloquent-a
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
        //$posts = Post::all(); //ovom fjom pribavljamo sve iz modela, odnosno tabele, vraca niz koji cemo zapamtiti u promenljivu
        //$posts = Post::orderBy('title','desc')->get(); //sortiramo po title
        //$post = Post::where('title', 'Post two')->get(); //za filtiranje po title
        //$posts = Post::orderBy('title','desc')->take(1)->get(); // ogranicenje broja rezultata
        $posts = Post::orderBy('created_at','desc')->paginate(1); //po jedan rezultat na stranici
        //$posts = DB::select('SELECT * FROM posts');
        // return view('posts.index'); //vraca taj view
        return view('posts.index')->with('posts', $posts); // prenosimo taj parametar u view, i tamo ga koristimo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //pritupa se sa: http://localhost/lsapp2/public/posts/create
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // parametri su iz forme koji se prenose na submit
    {                                       // create pravi request ka store (kad se submituje) ruta: http://localhost/lsapp2/public/posts
        $this->validate($request, [  //ovako se vrsi validacija
            'title' => 'required',   //polja title i body su obavezna
            'body' => 'required'
        ]);
        //kreiranje posta (upis u bazu)
        $post = new Post;
        $post->title = $request->input('title'); //uzimamo iz forme podatke
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success', 'Post created'); //redirektujemo se i prenosimo parametar success koji se koristi u validaciji (messages.blade.php)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  // parametar id posta koji prikazujemo, okida se na npr. /posts/1
    {
        $post = Post::find($id); //pronalazi post sa tim idjem
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // parametar id posta koji azuriramo, ruta: /lsapp2/public/posts/1/edit
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [  //ovako se vrsi validacija
            'title' => 'required',   //polja title i body su obavezna
            'body' => 'required'
        ]);
        //kreiranje posta (upis u bazu)
        $post = Post::find($id); //razlika u odnosu na store, sto pribavljamo iz baze, ne pravimo novi
        $post->title = $request->input('title'); //uzimamo iz forme podatke
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }
}
