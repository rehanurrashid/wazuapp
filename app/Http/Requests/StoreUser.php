<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'bail|required|string|max:255',
            // 'username' => 'bail|required|unique:users,username,'.auth()->user()->id,
            'password' => 'bail|required|confirmed',
            'email' => 'bail|required|unique:users',
            'phone' => 'required|unique:user_profiles',
            'address' => 'bail|required',
            'city' => 'bail|required|alpha_dash ',
            'country' => 'bail|required|alpha_dash',
            // 'photo' => 'bail|required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
