<?php

//Common helper functions that are available in all pages
use App\User;

/**
 * Returns true if the current user is an admin or an owner, false if the user is logged out or a member
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
            return true;
        }
    }
    //User is not an admin or an owner
    return false;
}

/**
 * Returns true if the user has the specified role, false otherwise
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