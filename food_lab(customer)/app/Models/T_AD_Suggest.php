<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Suggest extends Model
{
    public $table = 't_ad_suggest';
    use HasFactory;


    /*
     * Create : Min Khant(22/1/2022)
     * Update :
     * Explain of function : to store data from suggest form
     * Prarameter : no
     * return : 
     * */
    public function customerSuggest($request)
    {
        Log::channel('customerlog')->info('T_AD_Suggest Model', [
            'start customerSuggest'
        ]);

        $suggest = new T_AD_Suggest();
        $suggest->suggest_type = $request['type'];
        $suggest->message = $request['details'];
        $suggest->customer_id = session('customerId');
        $suggest->save();

        Log::channel('customerlog')->info('T_AD_Suggest Model', [
            'end customerSuggest'
        ]);
    }
}
