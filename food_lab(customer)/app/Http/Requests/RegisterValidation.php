<?php

namespace App\Http\Requests;

use App\Rules\CheckMail;
use http\Client\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RegisterValidation extends FormRequest
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
        Log::channel('customerlog')->info('RegisterValidation Request', [
            'start rules'
        ]);

        Log::channel('customerlog')->info('RegisterValidation Request', [
            'end rules'
        ]);

        return [
            'username' => 'required | min:6 | max:30',
            'phone' => 'max:14 ',
            'email' => ['required', ' max:128 ', 'email', new CheckMail()],
            'addressNo' => 'required | max:128',
            'addressTownship' => 'required | max:11',
            'addressState' => 'required | max:11',
            'password' => 'required | min:6 | max:30',
            'cPassword' => 'required | same:password',
            'type' => 'min:0',
            'taste' => 'min:0',
            'note' => 'min:0'
        ];
    }
}
