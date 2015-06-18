<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CreateArticleRequest;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

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
        $tags = Tag::lists('name', 'id'); //Use names as keys, and id's as values
        return view('articles.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $this->publishArticle($request);
        Session::flash('flash_message','Your article has been created!'); //Notify user
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

    /**
     * Publishes an article using the form input passed in
     *
     * @param CreateArticleRequest $request the form input from the user
     * @return mixed The article which was created
     */
    private function publishArticle(CreateArticleRequest $request) {
        $article = Auth::user()->articles()->create($request->all());//Get user, get all articles, create a new one with form data
        $this->handleTags($article,$request->input('tag_list'));
        return $article;
    }

    /**
     * Adds any new tags to the database, then syncs input with the article
     *
     * @param Article $article The article which will have these tags synced
     * @param $tags An array of tags which will be created if they do not already exist
     */
    private function handleTags(Article $article, $tags) {
        //Check through tags to make sure all of them exist
        $newTagList = array();
        //Only run if some tags were passed in
        if(!is_null($tags)) {
            foreach($tags as $tag) {
                $testTag = Tag::where('id','=',$tag)->first(); //Attempt to find an tag with this id
                if(is_null($testTag)) {
                    //No tag was found, create this tag. This is the tagName, not the tag id.
                    //TODO: check to verify laravel escapes
                    $newTag = Tag::create(['name' => $tag]);
                    array_push($newTagList,$newTag->id);
                } else {
                    //This was already a tag, push the id to the new list
                    array_push($newTagList,$tag);
                }
            }
        }

        //Now sync tags
        $article->tags()->sync($newTagList);
    }
}
