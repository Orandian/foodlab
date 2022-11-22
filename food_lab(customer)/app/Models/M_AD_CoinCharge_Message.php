<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_AD_CoinCharge_Message extends Model
{
    public $table = 'm_ad_coincharge_message';
    use HasFactory;

    /*
    * Create:zayar(2022/01/24) 
    * Update: 
    * This is method is used to show messages in inform alert. (customer)

    */
    public function informMessage($sessionCustomerId)
    {
        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'Start informMessage'
        ]);

        $result = T_AD_CoinCharge::where('t_ad_coincharge.customer_id', $sessionCustomerId)

            ->where('t_ad_coincharge.del_flg', 0)

            ->leftjoin('m_ad_coincharge_message', 'm_ad_coincharge_message.charge_id', '=', 't_ad_coincharge.id')
            ->where('m_ad_coincharge_message.del_flg', 0)
            ->select('*', DB::raw('m_ad_coincharge_message.updated_at AS messagecreated'), DB::raw('m_ad_coincharge_message.id AS chargeid'))
            ->orderBy('m_ad_coincharge_message.created_at', 'DESC')

            ->limit(3)
            ->get();

        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'End informMessage'
        ]);

        return $result;
    }
    /*
    * Create:zayar(2022/04/13) 
    * Update: 
    * This is method is used to count unseen messages in inform alert. (customer)

    */
    public function informMessageToCount($sessionCustomerId)
    {
        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'Start informMessageToCount'
        ]);

        $result = T_AD_CoinCharge::where('t_ad_coincharge.customer_id', $sessionCustomerId)

            ->where('t_ad_coincharge.del_flg', 0)

            ->where('t_ad_coincharge.customer_id', '=', $sessionCustomerId)
            ->leftjoin('m_ad_coincharge_message', 'm_ad_coincharge_message.charge_id', '=', 't_ad_coincharge.id')
            ->where('t_ad_coincharge.del_flg', 0)
            ->where('m_ad_coincharge_message.seen', 0)
            ->limit(3)
            ->get();

        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'End informMessageToCount'
        ]);

        return $result;
    }
    /*
    * Create:zayar(2022/01/26) 
    * Update: 
    * This is method is used to show messages in message page. (customer)

    */
    public function allMessage($sessionCustomerId)
    {
        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'Start allMessage'
        ]);

        $result = T_AD_CoinCharge::where('t_ad_coincharge.customer_id', $sessionCustomerId)

            ->where('t_ad_coincharge.del_flg', 0)
            ->leftjoin('m_ad_coincharge_message', 'm_ad_coincharge_message.charge_id', '=', 't_ad_coincharge.id')
            ->select('*', DB::raw('m_ad_coincharge_message.updated_at AS messagecreated'), DB::raw('t_ad_coincharge.id AS chargeid'))
            ->orderBy('m_ad_coincharge_message.updated_at', 'DESC')


            ->paginate(10);

        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'End allMessage'
        ]);

        return $result;
    }

    // customer 
    public function allMessageToCount($sessionCustomerId)
    {
        Log::channel('customerlog')->info("M_AD_CoinCharge_Message Model", [
            'Start allMessageToCount'
        ]);

        $result = T_AD_CoinCharge::select('*', DB::raw('t_ad_coincharge.created_at AS messagescreated'))
            ->where('t_ad_coincharge.customer_id', '=', $sessionCustomerId)
            ->leftjoin('m_ad_coincharge_message', 'm_ad_coincharge_message.charge_id', '=', 't_ad_coincharge.id')
            ->where('t_ad_coincharge.del_flg', 0)
            ->where('m_ad_coincharge_message.seen', 0)
            ->get();

        Log::channel('customerlog')->info("M_AD_CoinRate Model", [
            'End allMessageToCount'
        ]);

        return $result;
    }

    /*
    * Create:Linn Ko(2022/02/17) 
    * Update: 
    * This is method is used to add coin decision message to user notification.

    */
    public function addMessage($title, $detail, $chargeID)
    {
        Log::channel('adminlog')->info("M_AD_CoinCharge_Message Model", [
            'Start addMessage'
        ]);

        $result = new M_AD_CoinCharge_Message();
        $result->title = $title;
        $result->detail = $detail;
        $result->charge_id = $chargeID;
        $result->seen = 0;
        $result->save();

        Log::channel('adminlog')->info("M_AD_CoinCharge_Message Model", [
            'End addMessage'
        ]);

        return $result;
    }
}
