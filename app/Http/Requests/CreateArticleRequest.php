<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Only admins and owners can post articles
        $roles = Auth::user()->roles;
        //Loop through roles and check for permission
        foreach($roles as $role) {
            if($role->name == "admin" || $role->name == "owner") {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:10',
            'body' => 'required|min:10',
            'slug' => 'required|min:10',
        ];
    }
}
