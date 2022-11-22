<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Requests\RangeChart;
use App\Rules\SearchDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class T_AD_Order extends Model
{
    public $table = 't_ad_order';
    use HasFactory;

    /* Create:Zarni(2022/01/16)
    * Update:
    * This is function is to show the data of admin ordertransactionDetail
    * Return
    */
    public function orderTransaction()
    {
        return T_AD_Order::all();
    }




    /*
    * Create : Min Khant(14/1/2022)
    * Update :
    * Explain of function : To get order id
    * Prarameter : no
    * return : order id
    */
    public function orderId($id)
    {
        Log::channel('customerlog')->info('T_AD_Order Model', [
            'start orderId'
        ]);

        $orderID = T_AD_Order::where('customer_id', '=', $id)
            ->where('order_status', '=', 7)
            ->where('del_flg', '=', 0)
            ->get();

        Log::channel('customerlog')->info('T_AD_Order Model', [
            'end orderId'
        ]);

        return $orderID;
    }

    /*
    * Create : Cherry(1/2/2022)
    * Update : Min Khant(1/2/2022)
    * Explain of function : To store custoemr order (customer)
    * Prarameter : no
    * return : no
    */
    public function customerOrder($id, $township, $products, $gCoin, $gCash, $phone)
    {
        Log::channel('customerlog')->info('T_AD_Order Model', [
            'start customerOrder'
        ]);
        DB::transaction(function () use ($id, $township, $products, $gCoin, $gCash, $phone) {
            $tAdOrder = new T_AD_Order();
            $tAdOrder->customer_id = $id;
            $tAdOrder->payment = $gCoin == 0 ? 1 : 0;
            $tAdOrder->township_id = $township;
            $tAdOrder->ph_number = $phone;
            $tAdOrder->grandtotal_coin = $gCoin;
            $tAdOrder->grandtotal_cash = $gCash;
            $tAdOrder->order_status = 1;
            $tAdOrder->order_date =  date('Y-m-d');
            $tAdOrder->order_time = date('H:i:s');
            $tAdOrder->save();

            foreach ($products as $product) {
                $tAdOrderDetail = new T_AD_OrderDetail();
                $tAdOrderDetail->order_id = $tAdOrder->id;
                $tAdOrderDetail->product_id = $product['pid'];
                $tAdOrderDetail->quantity = $product['q'];
                $tAdOrderDetail->total_coin = $product['coin'];
                $tAdOrderDetail->total_cash = $product['cash'];
                if (array_key_exists('value', $product) == true) {
                    $tAdOrderDetail->note = json_encode($product['value']);
                }
                $tAdOrderDetail->save();
            }

            $mAdTrack = new M_AD_Track();
            $mAdTrack->title = 'REQUESTED';
            $mAdTrack->detail = 'Your order is pending';
            $mAdTrack->order_id = $tAdOrder->id;
            $mAdTrack->save();
        });
        Log::channel('customerlog')->info('T_AD_Order Model', [
            'end customerOrder'
        ]);
    }
}
