<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\RangeChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class T_AD_CoinCharge_Finance extends Model
{
    public $table = 't_ad_coincharge_finance';
    use HasFactory;

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function setChargeFinance($chargeid, $amount, $payment)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start setChargeFinance'
        ]);

        $result = T_AD_CoinCharge_Finance::where('del_flg', 0)
            ->where('charge_id', $chargeid)
            ->get();

        if (count($result) == 0) {
            $coin_finance = new T_AD_CoinCharge_Finance();
            $coin_finance->charge_id = $chargeid;
            $coin_finance->payment_type = $payment;
            $coin_finance->amount = $amount;
            $coin_finance->save();
        } else {
            T_AD_CoinCharge_Finance::where('del_flg', 0)
                ->where('charge_id', $chargeid)
                ->update([
                    'payment_type' => $payment,
                    'amount' => $amount
                ]);
        }

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End setChargeFinance'
        ]);
    }

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function reSetFinance($chargeid)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start reSetFinance'
        ]);

        T_AD_CoinCharge_Finance::where('charge_id', $chargeid)
            ->update([
                'amount' => 0,
                'del_flg' => 1
            ]);

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End reSetFinance'
        ]);
    }

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function getFinance($chargeid)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start getFinance'
        ]);

        $result = T_AD_CoinCharge_Finance::where('charge_id', $chargeid)
            ->where('del_flg', 0)
            ->first();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End getFinance'
        ]);

        return $result;
    }
}
