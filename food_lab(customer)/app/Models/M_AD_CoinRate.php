<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_AD_CoinRate extends Model
{
    public $table = 'm_ad_coinrate';
    use HasFactory;

    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To get rate data from m_ad_coinrate database
    * parament : none
    * return get data
    * */

    public function getRate()
    {
        Log::channel('customerlog')->info("M_AD_CoinRate Model", [
            'Start coinRate'
        ]);

        $rate = DB::table('m_ad_coinrate')->where('m_ad_coinrate.del_flg', 0)->latest('id')->first();

        Log::channel('customerlog')->info("M_AD_CoinRate Model", [
            'End coinRate'
        ]);

        return $rate;
    }

    /* Create:Zarni(2022/01/16) 
    * Update: 
    * This is function is to show the data of admin ordertransactionList
    * Return 
    */
    public function DashboardCoinrate()
    {

        Log::channel('customerlog')->info("M_AD_CoinRate Model", [
            'Start DashboardCoinrate'
        ]);

        $coinrate = M_AD_CoinRate::first();

        Log::channel('customerlog')->info("M_AD_CoinRate Model", [
            'End DashboardCoinrate'
        ]);

        return $coinrate;
    }
}
