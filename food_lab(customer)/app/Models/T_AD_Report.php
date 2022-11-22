<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Report extends Model
{
    public $table = 't_ad_report';
    use HasFactory;


    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : To store customer report data
     * Prarameter : no
     * return :
     * */
    public function customerReport($request)
    {
        Log::channel('customerlog')->info('T_AD_Report Model', [
            'start customerReport'
        ]);

        $report = new T_AD_Report();
        $report->order_id = $request['order'];
        $report->report_message = $request['message'];
        $report->customer_id = session('customerId');
        $report->save();

        Log::channel('customerlog')->info('T_AD_Report Model', [
            'end customerReport'
        ]);
    }
}
