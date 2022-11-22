<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SuggestFormValidation extends FormRequest
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
        Log::channel('customerlog')->info('SuggestFormValidation Request', [
            'start rules'
        ]);

        Log::channel('customerlog')->info('SuggestFormValidation Request', [
            'end rules'
        ]);
        return [
            'type' => 'required | digits_between:1,5',
            'details' => 'required | max:255'
        ];
    }
}
