<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AdminPromoteDemoteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //User must be logged in, and an OWNER
        if(Auth::guest()) {
            return false; //User is logged out
        } elseif(checkSingleRole('banned') == true) {
            return false; //User is banned
        } elseif(checkSingleRole('owner') == true)
            return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //No rules
        return [
            //
        ];
    }
}
