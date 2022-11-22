<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordValidation extends FormRequest
{
    /** customer
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
            'oldpassword' =>  ['required', 'min:4', 'max:30'],
            'newpassword' => 'required|min:4|max:30|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword' => 'required|min:4|max:30'
        ];
    }
}
