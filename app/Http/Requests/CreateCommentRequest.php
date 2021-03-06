<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateCommentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Check that user is logged in
        if(Auth::guest()) {
            return false;
        }
        //Check that user is not banned
        if(checkUserRole(Auth::user()->id,'banned') == true)
        {
            return false; //User was banned
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|min:10',
        ];
    }
}
