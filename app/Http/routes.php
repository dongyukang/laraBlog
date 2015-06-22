<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('articles','ArticlesController');

//Use slug-based urls and return the matching object, not just the id
Route::bind('articles', function($value, $route) {
    return \App\Article::where('slug', '=', $value)->firstOrFail();
});

Route::post('/articles/{articles}/comment',['as' => 'comment.new','uses' =>'CommentsController@storeComment']);

Route::get('/previewArticle','ArticlesController@preview');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);