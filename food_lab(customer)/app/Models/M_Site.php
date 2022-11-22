<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Site extends Model
{
    public $table = 'm_site';
    use HasFactory;

    /*
     * Create : Min Khant(23/1/2022)
     * Update :
     * Explain of function : check server maintenance
     * Prarameter : no
     * return : maintenance true/false
     * */
    public function maintenance()
    {
        Log::channel('customerlog')->info('M_Site Model', [
            'start maintenance'
        ]);

        $maintenance = M_Site::select('maintenance')->first();

        Log::channel('customerlog')->info('M_Site Model', [
            'start maintenance'
        ]);

        return $maintenance;
    }



    /*
   * Create:zayar(2022/01/13)
   * Update:
   * This function is used to get payments datas.
   */
    public function payments()
    {
        Log::channel('adminlog')->info("M_Site Model", [
            'Start payments'
        ]);
        Log::channel('adminlog')->info("M_Site Model", [
            'End payments'
        ]);
        return M_Payment::where('del_flg', '=', 0)->get();
    }

    /*
     * Create : Min Khant(23/1/2022)
     * Update :
     * Explain of function : to get site name (customer)
     * Prarameter : no
     * return : site name
     * */
    public function siteName()
    {
        Log::channel('customerlog')->info('M_Site Model', [
            'start siteName'
        ]);
        $name = M_Site::select('*')
            ->where('del_flg', '=', 0)
            ->first();

        Log::channel('customerlog')->info('M_Site Model', [
            'end siteName'
        ]);
        return $name;
    }

    /*
     * Create : Min Khant(23/1/2022)
     * Update :
     * Explain of function : to get policy data
     * Prarameter : no
     * return : plicy
     * */
    public function policy()
    {
        Log::channel('customerlog')->info('M_Site Model', [
            'start policy'
        ]);
        $policys = M_Site::select('privacy_policy')
            ->where('del_flg', '=', 0)
            ->orderBy('id', 'desc')
            ->first();
        Log::channel('customerlog')->info('M_Site Model', [
            'end policy'
        ]);
        return $policys;
    }
}
