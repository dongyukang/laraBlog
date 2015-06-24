<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userList = User::lists('name','name'); //Use name for both key and value
        return view('users.index',compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        //Only allow a user to edit their own page
        if($user->name == Auth::user()->name) {
            //You are trying to edit your own article
            return view('users.edit',compact('user'));
        } else {
            //A user is trying to edit another users page
            Session::flash('flash_message','You don\'t have permission to do that!'); //Notify user
            return redirect('/users/'.$user->name);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param Request $request
     * @return Response
     * @internal param int $id
     */
    public function update(User $user, Request $request)
    {
        //Make sure bio is long enough
        $this->validate($request,[ 'about' => 'required|min:10|max:1000']);

        //Make sure the user is editing their own page
        if($user->name == Auth::user()->name) {
            //This is your own page, allow the edit
            $user->update($request->all());
            return redirect('/users/'.$user->name);

        } else {
            //This is someone else's page, don't allow the edit
            Session::flash('flash_message','You don\'t have permission to do that!'); //Notify user
            return redirect('/users/'.$user->name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        //
    }
}
