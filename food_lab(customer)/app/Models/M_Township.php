<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Township extends Model
{
    public $table = 'm_township';
    use HasFactory;

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : To get Township name in m_township Table From Database
     * Prarameter : no
     * return : Township names and each delivery prices
     * */
    public function townshipDetails()
    {
        Log::channel('customerlog')->info('M_Township Model', [
            'start townshipDetails'
        ]);

        $townships = M_Township::where('del_flg', '=', '0')
            ->limit(10)
            ->get();

        Log::channel('customerlog')->info('M_Township Model', [
            'end townshipDetails'
        ]);
        return $townships;
    }

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : To get Township name in m_township Table From Database
     * Prarameter : no
     * return : Township names and each delivery prices
     * */
    public function townshipMoreDetails()
    {
        Log::channel('customerlog')->info('M_Township Model', [
            'start townshipMoreDetails'
        ]);

        $townships = M_Township::where('del_flg', '=', '0')
            ->get();

        Log::channel('customerlog')->info('M_Township Model', [
            'end townshipMoreDetails'
        ]);
        return $townships;
    }

    /*
      * Create : Linn Ko(20/1/2022)
      * Update :
      * Explain of function : To show customer search names
      * Prarameter : no
      * return :
    */
    public function townshipFees($id)
    {
        Log::channel('customerlog')->info('M_Township Model', [
            'start townshipFees'
        ]);

        $fees = M_Township::select('delivery_price')
            ->where('id', $id)
            ->first();

        Log::channel('customerlog')->info('M_Township Model', [
            'end townshipFees'
        ]);
        return $fees;
    }

    /*
      * Create : Linn Ko(20/1/2022)
      * Update :
      * Explain of function : To get township ,equal with state for ajax
      * Prarameter : no
      * return : township 
    */
    public function townshipName($stateId)
    {
        Log::channel('customerlog')->info('M_Township Model', [
            'start townshipName'
        ]);

        $townships = M_Township::select(['id', 'township_name'])
            ->where('state_id', $stateId)
            ->where('del_flg', 0)
            ->get();

        Log::channel('customerlog')->info('M_Township Model', [
            'end townshipName'
        ]);
        return $townships;
    }
}
