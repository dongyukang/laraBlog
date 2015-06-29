<?php


//Redirect home page to articles index
Route::get('/',function() {
    return redirect('/articles');
});


Route::resource('articles','ArticlesController');
Route::patch('articles/{article}/restore','ArticlesController@restoreArticle'); //Allow admins to restore soft-deleted articles

//Use slug-based urls and return the matching object, not just the id
Route::bind('articles', function($value, $route) {
    return \App\Article::where('slug', '=', $value)->firstOrFail();
});

Route::post('/articles/{articles}/comment',['as' => 'comment.new','uses' =>'CommentsController@storeComment']); //Allow users to store comments
Route::get('/admin/controlpanel','AdminController@controlPanel');


Route::Resource('users','UsersController');

//Allow admins to ban/unban users
Route::patch('/users/{users}/banUser','UsersController@banUser');
Route::patch('/users/{users}/unbanUser','UsersController@unbanUser');

//Allow owners to admin/unadmin users
Route::patch('/users/{users}/promoteUser','UsersController@promoteUser');
Route::patch('/users/{users}/demoteUser','UsersController@demoteUser');

//Use username-based urls and return the matching object, not just the id
Route::bind('users', function($value, $route) {
    return \App\User::where('name', '=', $value)->firstOrFail();
});

//Allow users to look up articles with a particular tag
Route::get('/tags/{tags}','ArticlesController@tagLookup');

//Basic login authentication
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);