<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment; 
use App\Post; 
use DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('comments.create')->with('id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [  //ovako se vrsi validacija
            'comment' => 'required'  
            
        ]);
    
        
        $comment = new Comment;
        $comment->text = $request->input('comment'); //uzimamo iz forme podatke
        $user_id = auth()->user()->id;
        $comment->user_id = $user_id;
        $post_id = $request->input('post_id');
        $comment->post_id = $post_id;
        $comment->save();
        $post = Post::find($post_id);
        $comments = Comment::where('post_id', $post_id)->get();
        return redirect('posts/'.$post_id); // redirekcija na isti post
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $comment = Comment::find($id);

        if(auth()->user()->id !== $comment['user_id']){
            
            return view('posts.show')->with('post', $post)->with('comments',$comments);
        }

        $comment->delete();
        $post = Post::find($comment['post_id']);
        $comments = Comment::where('post_id',$post['id'])->get();
        
        return view('posts.show')->with('post', $post)->with('comments',$comments);
    }
}
