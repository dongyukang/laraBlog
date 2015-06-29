<?php

//Common helper functions that are available in all pages
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * Returns true if the current user is an admin or an owner, false if the user is logged out, not an admin, or banned.
 *
 * @return bool
 */
function checkAdminOwner() {
    //Ensure user is logged in
    if(Auth::guest()) {
        return false;
    }
    //Ensure that the user is an admin or an owner
    $roles = Auth::user()->roles;
    //Loop through roles and check for permission
    foreach($roles as $role) {
        if($role->name == "admin" || $role->name == "owner") {
            //Double check to make sure user is not banned
            if(checkSingleRole("banned") == false)
                return true;
            else
                return false; //User is an admin but is banned
        }
    }
    //User is not an admin or an owner
    return false;
}

/**
 * Returns true if the logged in user has the specified role, false otherwise
 *
 * @return bool
 */
function checkSingleRole($roleToCheck) {
    //Ensure user is logged in
    if(Auth::guest()) {
        return false;
    }
    $roleToCheck = strtolower($roleToCheck);
    //Ensure that the user is an admin or an owner
    $roles = Auth::user()->roles;
    //Loop through roles and check for permission
    foreach($roles as $role) {
        if($role->name == $roleToCheck) {
            return true;
        }
    }
    //User is not an admin
    return false;
}

/**
 * Returns true if the user with the given id has the specified role, false otherwise
 *
 * @param $userId Id of the user to check
 * @param $roleToCheck Role to check for
 * @return bool
 */
function checkUserRole($userId, $roleToCheck) {
    //Ensure user is logged in

    $user = User::find($userId);
    if (is_null($user)) {
        return false; //User dose not exist
    }
    $roleToCheck = strtolower($roleToCheck);
    //Ensure that the user is an admin or an owner
    $roles = $user->roles;
    //Loop through roles and check for permission
    foreach($roles as $role) {
        if($role->name == $roleToCheck) {
            return true;
        }
    }
    //User is not an admin
    return false;
}

/**
 * Returns true if the logged in user is the same as the given user
 *
 * @param $userId Id of the user to check
 * @return true if users are same, false if not
 */
function checkSameUser($userId) {
    if(Auth::guest()) {
        return false; //User not logged in
    }
    if(Auth::user()->id == $userId) {
        return true;
    } else {
        return false;
    }
}