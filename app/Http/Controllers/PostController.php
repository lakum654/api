<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        $user = auth()->user();
        $notification = $user->notifications->where('type','App\Notifications\CommentNotification');
        return view('posts.index',compact('posts','notification'));
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

    public function addFavirote(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        $post = $request->postId;
        $user->myList()->attach($post);
        return 1;
    }

    public function addLike(Request $request){
        $post = Post::find($request->postId);
        $post->update(['like' => $request->likes]);
        return $post->like;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favirote(){
        $posts = Auth::user()->myList;
        $user = auth()->user();
        $notification = $user->notifications->where('type','App\Notifications\CommentNotification');
        return view('posts.favirote',compact('posts','notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        auth::user()->notifications()->where('data','LIKE',"%post_id%")->where('data','LIKE',"%$id%")->delete();
        $post = Post::find($id);
        $user = auth()->user();
        $notification = $user->notifications->where('type','App\Notifications\CommentNotification');
        return view('posts.post',compact('post','notification'));
    }


    public function store(Request $request){
        $input = $request->all();
        $input['user_id'] = Auth::id();
        Post::create($input);
        return redirect('posts');
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
        //
    }

    public function notification(){
        $notification = Auth::user()->notifications->where('type','App\Notifications\CommentNotification');
        return view('posts.notification',compact('notification'));
    }
}
