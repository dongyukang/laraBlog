<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CreateArticleRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{

    public function __construct()
    {
        //Restrict access to only logged in users
        $this->middleware('auth',['except' => array('index', 'show', 'store')]); //Only authenticate create method
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::get();
        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $this->publishArticle($request);
        return redirect('articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  Article  $article
     * @return Response
     */
    public function show(Article $article)
    {
//        dd($article);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article  $article
     * @return Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Article  $article
     * @return Response
     */
    public function update(Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article  $article
     * @return Response
     */
    public function destroy(Article $article)
    {
        //
    }

    private function publishArticle(CreateArticleRequest $request) {
        //TODO: Flag article fields as mass assign
        $article = Auth::user()->articles()->create($request->all());//Get user, get all articles, create a new one with form data
//      $this->syncTags($article,$request->input('tag_list')); //TODO: FIX THIS
        return $article;
    }
}
