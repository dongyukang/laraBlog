<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth',['except' => array('index', 'show')]); //Require admin status for all pages except index/show
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Article $article The article to create the comment for
     * @param CreateCommentRequest $request Ensures the user is logged in and filled out the comment
     * @return Response Redirects to the same article page
     */
    public function storeComment(Article $article, CreateCommentRequest $request)
    {
        //Insert a new comment, set up foreign keys, then insert to db
        $comment = new Comment;
        $comment->body = $request->input('body');
        $comment->user()->associate(Auth::user());
        $comment->article()->associate($article);
        $comment->save();

        Session::flash('flash_message','Your comment has been posted!'); //Notify user
        return redirect('articles/'.$article->slug);
    }
}
