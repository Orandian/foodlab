<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ContactFormValidation extends FormRequest
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
        Log::channel('customerlog')->info('ReportFormValidation Request', [
            'start rules'
        ]);

        Log::channel('customerlog')->info('ReportFormValidation Request', [
            'end rules'
        ]);
        return [
            'message' => 'required | max:255'
        ];
    }
}
