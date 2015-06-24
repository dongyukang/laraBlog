<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\CreateCommentRequest;
use App\Tag;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class ArticlesController extends Controller
{

    public function __construct()
    {
        //TODO: Create custom middleware to block non-admin members from even viewing the create page
        //Restrict access to only logged in users
        $this->middleware('checkAdmin',['except' => array('index', 'show')]); //Require admin status for all methods except index/show
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
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
        $comments = $article->comments()->latest()->get();
        return view('articles.show',compact('article','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article  $article
     * @return Response
     */
    public function edit(Article $article)
    {
        $tags = Tag::lists('name', 'id'); //Use names as keys, and id's as
        $defaultSlug = true; //Dont automatically update slug
        return view('articles.edit',compact('tags','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Article  $article
     * @return Response
     */
    public function update(CreateArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        $this->handleTags($article,$request->input('tag_list'));
        return redirect('articles/'.$article->slug);
    }

    /**
     * Soft-deletes the specified article by setting the deleted_at attribute.
     *
     * @param  Article  $article
     * @return Response
     */
    public function destroy(Article $article)
    {
        //Soft delete the article by setting the field
        $article->delete();
        Session::flash('flash_message','Your article has been deleted!'); //Notify user
        return redirect('articles/');
    }

    /**
     * Restores the deleted article
     * @param Article $article
     * @return redirect
     */
    public function restoreArticle($articleSlug) {
        $article = Article::withTrashed()->where('slug', '=',$articleSlug)->first();
        $article->restore();
        Session::flash('flash_message','Your article has been restored!'); //Notify user
        return redirect('admin/controlpanel');
    }

    /**
     * Show a preview of the given page
     *
     */
    public function preview() {
        return view('articles.preview');
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
