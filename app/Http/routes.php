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

Route::get('/',function() {
    return redirect('/articles');
});

Route::resource('articles','ArticlesController');
Route::patch('articles/{article}/restore','ArticlesController@restoreArticle');
//Use slug-based urls and return the matching object, not just the id
Route::bind('articles', function($value, $route) {
    return \App\Article::where('slug', '=', $value)->firstOrFail();
});

Route::post('/articles/{articles}/comment',['as' => 'comment.new','uses' =>'CommentsController@storeComment']);

Route::get('/admin/controlpanel','AdminController@controlPanel'); //TODO


Route::Resource('users','UsersController');
Route::patch('/users/{users}/banUser','UsersController@banUser');
Route::patch('/users/{users}/unbanUser','UsersController@unbanUser');

//Use username-based urls and return the matching object, not just the id
Route::bind('users', function($value, $route) {
    return \App\User::where('name', '=', $value)->firstOrFail();
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);