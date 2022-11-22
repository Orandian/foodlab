<?php

namespace App\Http\Requests;

use App\Rules\LoginMail;
use App\Rules\LoginPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class LoginValidation extends FormRequest
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
        Log::channel('customerlog')->info('LoginValidation Request',[
            'start rules'
        ]);

        Log::channel('customerlog')->info('LoginValidation Request',[
            'end rules'
        ]);

        return [
            'email' => ['required','email' , new LoginMail()],
            'password' => ['required',new LoginPassword()]
        ];
    }
}
