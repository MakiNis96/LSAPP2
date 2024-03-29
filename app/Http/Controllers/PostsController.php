<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //da bi imao pristum file sistemu
use App\Post; // unosenje modela namespace , naziv Post, ovo radimo da bismo mogli da pisemo fje nad modelom
use App\Comment;
use App\Like;
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
    public function __construct()                //ovim zabranjujemo pristup nelogovanim korisnicima
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);  //u nizu navodimo view-ove kojima mogu da pristupe i nelogovani korisnici
    }
    public function index() // ovom pristupamo sa /posts (bez index)
    {
        //sada mozemo da koristimo fje nad modelom, koristicemo Eloquent za pisanje upita
        //$posts = Post::all(); //ovom fjom pribavljamo sve iz modela, odnosno tabele, vraca niz koji cemo zapamtiti u promenljivu
        //$posts = Post::orderBy('title','desc')->get(); //sortiramo po title
        //$post = Post::where('title', 'Post two')->get(); //za filtiranje po title
        //$posts = Post::orderBy('title','desc')->take(1)->get(); // ogranicenje broja rezultata
        $posts = Post::orderBy('created_at','desc')->paginate(10); //po deset rezultata na stranici

        
        //$posts = DB::select('SELECT * FROM posts');
        // return view('posts.index'); //vraca taj view
        return view('posts.index')->with('posts', $posts); // prenosimo taj parametar u view, i tamo ga koristimo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //pritupa se sa: http://localhost/posts/create
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
    {                                       // create pravi request ka store (kad se submituje) ruta: http://localhost/posts
        $this->validate($request, [  //ovako se vrsi validacija
            'title' => 'required',   //polja title i body su obavezna
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999' //slika nije obavezna, moze velicine do 2 mb
        ]);
        
        // ako ima odabran fajl, obradjujemo ga
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //  ime fajla bez ekstenzije
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // ekstenzija uploadovanog fajla
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // pravimo jedinstveno ime
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // cuvamo sliku
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //kreiranje posta (upis u bazu)
        $post = new Post;
        $post->title = $request->input('title'); //uzimamo iz forme podatke
        $post->body = $request->input('body');
        $user_id = auth()->user()->id;
        $post->user_id = $user_id;
        $post->cover_image = $fileNameToStore;
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
        $comments = Comment::where('post_id', $id)->get();
        return view('posts.show')->with('post', $post)->with('comments',$comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // parametar id posta koji azuriramo, ruta: /posts/1/edit
    {
        $post = Post::find($id);
        
        //provera da li postoji 
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }
        // provera da li korisnik sme da pristupi stranici
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
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

        if($request->hasFile('cover_image')){
            // uzimamo originalno ime
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // samo ime fajla
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // samo ekstenzija fajla
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // jedinstveno ime za bazu
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // cuvamo sliku
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            // brisemo prethodnu
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->title = $request->input('title'); //uzimamo iz forme podatke
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){  // novo ime fajla
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post updated');
    }

    
    /**
     * like the post 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like( $id)
    {   
        $user_id = auth()->user()->id;
        $post_id = $id;

        $l = Like::where([
            ['user_id', '=', $user_id],
            ['post_id', '=', $post_id]
        ]);
        
        if($l->count() == 1)
        {  
            $l->delete();
                   
        }
        else
        {
            $like = new Like;            
            $like->user_id = $user_id;        
            $like->post_id = $post_id;

            $like->save();   
        }  

        return redirect('/posts');
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

        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        $comments = Comment::where('post_id',$id)->get();
        foreach($comments as $comment){
            $comment->delete();
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }
}
