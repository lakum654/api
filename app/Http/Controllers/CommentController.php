<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use App\Reply;
use Notification;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comment = Comment::with('reply','user')->where('post_id',$request->postId)->latest('created_at')->take(1)->get();

        return response()->json($comment);
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
    public function store(Request $request)
    {
        $post = Post::find($request->postId);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $post->comments()->save($comment);
        $post = Post::find($request->postId);
       

        
        $details = [
            'title' => $post->title,
            'message' => Auth::user()->name."was commented on your ".$post->title." Post",
            'thanks' => 'Thank you !',
            'actionURL' => url('posts/'.$post->id),
            'user_id' => Auth::user()->name,
            'post_id' => $post->id  
        ];
        Notification::send($post->user, new CommentNotification($details));
        return response()->json($post);
    }

    public function saveReply(Request $request){
        
        Reply::create([
            'comment_id' => $request->commentId,
            'reply'      => $request->replyText   
        ]);
        $post = Post::with('comments')->find($request->postId);
        $reply = $post->comments->reply;
        return 1;
        //return view('posts.getComment',compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
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
    public function update(Request $request)
    {
       Comment::find($request->commentId)->update(['comment' => $request->comment]);
       return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Comment::find($id)->delete();
        Reply::where('comment_id',$id)->delete();
        return back();
    }
}
