<?php

namespace App\Models;

use App\Common\Variable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_CoinCharge extends Model
{
  public  $table = 't_ad_coincharge';
  use HasFactory;



  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to show coin listing.
    * Parameters : no
    * Return : all data
    */
  public function listing($status, $category)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start listing'
    ]);

    if ($status == 1)
      $result =  T_AD_CoinCharge::select(
        '*',
        DB::raw('t_ad_coincharge.id AS chargeid'),
        DB::raw('t_ad_coincharge.updated_at AS updatetime')
      )
        ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
        ->leftjoin('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
        ->where('decision_status', $status)
        ->where('t_ad_coincharge.del_flg', 0)
        ->orderby('request_datetime', 'desc')
        ->paginate(10, ['*'], $category);

    if ($status == 2 || $status == 3 || $status == 4)
      $result =  T_AD_CoinCharge::select(
        '*',
        DB::raw('t_ad_coincharge.id AS chargeid'),
        DB::raw('t_ad_coincharge.updated_at AS updatetime')
      )
        ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
        ->join('m_ad_login', 'm_ad_login.id', '=', 't_ad_coincharge.decision_by')
        ->where('decision_status', $status)
        ->where('t_ad_coincharge.del_flg', 0)
        ->orderby('updatetime', 'desc')
        ->paginate(10, ['*'], $category);
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End listing'
    ]);

    return $result;
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to get charge detail.
    * Parameters : no
    * Return : charge data
    */
  public function chargeDetail($chargeid)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start charageDetail'
    ]);

    $result =  T_AD_CoinCharge::select(
      '*',
      DB::raw('t_cu_customer.id AS customerid'),
      DB::raw('m_decision_status.id AS statusid'),
      DB::raw('t_ad_coincharge.id AS chargeid')
    )

      ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_coincharge.customer_id')
      ->join('m_cu_customer_login', 'm_cu_customer_login.customer_id', '=', 't_cu_customer.id')
      ->join('m_decision_status', 'm_decision_status.id', '=', 't_ad_coincharge.decision_status')
      ->where('t_ad_coincharge.del_flg', 0)
      ->where('t_ad_coincharge.id', $chargeid)
      ->first();


    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End charageDetail'
    ]);

    return $result;
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to get photo path.
    * Parameters : no
    * Return : photo path
    */
  public function getChargePhoto($chargeid)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start getChargePhoto'
    ]);

    $evd_id = T_AD_CoinCharge::find($chargeid);

    if ($evd_id == null) abort(500);

    $result =  T_AD_Evd::select('path')
      ->where('id', $evd_id->request_evd_ID)
      ->where('del_flg', 0)
      ->first();

    if ($result == null) abort(500);

    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End getChargePhoto'
    ]);

    return $result;
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set desicion.
    * Parameters : no
    * Return : photo path
    */
  public function setChargeDecision($chargeid, $decision, $isRedecision = 0)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start setChargeDecision'
    ]);

    T_AD_CoinCharge::where('del_flg', 0)
      ->where('id', $chargeid)
      ->update([
        'decision_status' => $decision,
        'decision_by' => session('adminId'),
        're_decision' => $isRedecision
      ]);


    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End setChargeDecision'
    ]);
  }

  /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to find charge Id.
    * Parameters : no
    * Return : photo path
    */
  public function findChargeById($chargeid)
  {
    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'Start findChargeById'
    ]);

    $result = T_AD_CoinCharge::where('del_flg', 0)
      ->where('id', $chargeid)
      ->first();


    Log::channel('adminlog')->info("T_AD_CoinCharge Model", [
      'End findChargeById'
    ]);

    return $result;
  }
  /*
    * Create : ZPA(2022/01/27) 
    * Update : 
    * This function is use to insert customer data and coin data for Coin Charge.
    * Parameters : $coinChargeFormdata= request coin and screen shots , $customerID = customer ID, $filepath=Transaction Image Path
    * Return : Customer Coin Charge Data
    */
  public function customerCoinCharge($coinChargeFormdata, $customerID, $filepath)
  {
    Log::channel('customerlog')->info('T_AD_CoinCharge Model', [
      'Start customerCoinCharge'
    ]);
    DB::transaction(function () use ($coinChargeFormdata, $customerID, $filepath) {
      $evdData = new T_AD_Evd();
      $evdData->path = $filepath;
      $evdData->save();
      $curequestcoindata = new T_AD_CoinCharge();
      $curequestcoindata->request_coin =(int)$coinChargeFormdata['coinput'];
      $curequestcoindata->customer_id = $customerID;
      $curequestcoindata->decision_status = "1";
      $curequestcoindata->request_evd_ID = $evdData->id;
      $curequestcoindata->save();
      // $evdData->coinChargeconnect()->save($curequestcoindata);

      $common = new Variable();
    $m_ad_coincharge_message = new M_AD_CoinCharge_Message();
    $m_ad_coincharge_message->addMessage($common->REQ, $common->REQ_MESSAGE_DET, $curequestcoindata->id);
    });

    
    Log::channel('customerlog')->info('T_AD_CoinCharge Model', [
      'End customerCoinCharge'
    ]);
  }

  public function evdConnect()
  {
    return $this->belongsTo("App\Models\T_AD_Evd");
  }


  public function checkFirst($id, $sessionCustomerId)
  {
    Log::channel('customerlog')->info("T_AD_CoinCharge Model", [
      'start checkFirst'
    ]);
    Log::channel('customerlog')->info("T_AD_CoinCharge Model", [
      'end checkFirst'
    ]);
    // SELECT * FROM `m_ad_coincharge_message` LEFT JOIN t_ad_coincharge ON m_ad_coincharge_message.charge_id = t_ad_coincharge.id WHERE m_ad_coincharge_message.id = 16 AND t_ad_coincharge.customer_id = 12
    Log::channel('customerlog')->info("cus id", [
      $sessionCustomerId
    ]);
    $find = M_AD_CoinCharge_Message::leftjoin('t_ad_coincharge', 't_ad_coincharge.id', '=', 'm_ad_coincharge_message.charge_id')
      ->where('m_ad_coincharge_message.id', $id)
      ->where('t_ad_coincharge.customer_id', $sessionCustomerId)
      ->get();

    return $find;
  }

  /*
    * Create : zayar(2022/02/07) 
    * Update : 
    * This function is use to search message (customer)
    * $id
    * Return : message detail
    */
  public function searchMessage($id)
  {
    Log::channel('customerlog')->info("T_AD_CoinCharge Model", [
      'start searchMessage'
    ]);


    $find = M_AD_CoinCharge_Message::find($id);
    $find->seen = 1;
    $find->save();
    $result = T_AD_CoinCharge::where('t_ad_coincharge.del_flg', 0)
      ->leftjoin('m_ad_coincharge_message', 'm_ad_coincharge_message.charge_id', '=', 't_ad_coincharge.id')
      ->leftjoin('m_decision_status', 'm_decision_status.id', '=', 't_ad_coincharge.decision_status')
      ->select('*', DB::raw('m_ad_coincharge_message.updated_at AS messageUpdated'))
      ->where('m_ad_coincharge_message.id', $id)
      ->first();

    Log::channel('customerlog')->info("T_AD_CoinCharge Model", [
      'End searchMessage'
    ]);
    return $result;
  }
}
