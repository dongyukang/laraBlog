<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        //Require admin or owner status for all pages
        $this->middleware('checkAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function controlPanel()
    {
        $userList = User::lists('name','id'); //Pass a list of users and ids
        $deletedArticlesList = Article::onlyTrashed()->get();
        return view('admin.controlpanel',compact('userList','deletedArticlesList'));
    }

    /**
     *
     * Allow admins to edit user  roles
     * @param $id
     * @return void
     */
    public function editUser($user) {
        return ("Hello with id: ".$user);
    }
}
