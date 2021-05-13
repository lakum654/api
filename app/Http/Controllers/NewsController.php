<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Article;
use App\BothComment;
class NewsController extends Controller
{
    public function index(){
        $articles = Article::all();
        $news = News::all();
        return view('oneToManyPholymorphic/index',compact('articles','news'));
    }

    public function store(Request $request){
        if($request->type = 'Article'){
            Article::create(['title' => $request->title,'desc' => $request->desc]);
        }

        if($request->type = 'News'){
            News::create(['title' => $request->title,'desc' => $request->desc]);
        }

        return back();
    }

    public function news($id){
        $data = News::with('comments')->find($id);
        return view('oneToManyPholymorphic/news',compact('data'));
    }

    public function article($id){
        $data = Article::with('comments')->find($id);
        return view('oneToManyPholymorphic/article',compact('data'));
    }

    public function articleComment(Request $request){
        $post = Article::find($request->id);	 
        $comment = new BothComment;
        $comment->comment = $request->comment;
        $post->comments()->save($comment);
        return back();
    }

    public function newsComment(Request $request){
        $post = News::find($request->id);	
        $comment = new BothComment;
        $comment->comment = $request->comment;
        $post->comments()->save($comment);
        return back();
    }
}
