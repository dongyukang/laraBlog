<?php

//Common helper functions that are available in all pages

/**
 * Returns true if the user is an admin or an owner, false if the user is logged out or a member
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

