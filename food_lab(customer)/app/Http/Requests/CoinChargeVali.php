<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class CoinChargeVali extends FormRequest
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
        Log::channel('customerlog')->info('CoinChargeVali Request', [
            'start rules'
        ]);

        Log::channel('customerlog')->info('CoinChargeVali Request', [
            'end rules'
        ]);
        return [
            "coinput" =>"required | max:3",
            "fileimage" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:51200"
        ];
    }
}
