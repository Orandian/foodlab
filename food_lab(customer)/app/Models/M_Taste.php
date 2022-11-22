<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Taste extends Model
{
    use HasFactory;
    public $table = 'm_taste';

    /*
    * Create : Aung Min Khant(20/1/2022)
    * Update :
    * Explain of function : To get  all data from m_taste (customer)
    * parament : none
    * return get data
    * */
    public function getTasteAll()
    {

        Log::channel('customerlog')->info("M_Taste Model", [
            'Start getTasteAll'
        ]);
        $mTaste = M_Taste::all();

        Log::channel('customerlog')->info("M_Taste Model", [
            'End getTasteAll'
        ]);
        return  $mTaste;
    }

    /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to get all taste.
   */

    public function allTastes()
    {
        Log::channel('customerlog')->info("M_Taste Model", [
            'Start allTastes'
        ]);
        Log::channel('customerlog')->info("M_Taste Model", [
            'End allTastes'
        ]);
        return M_Taste::where('del_flg', '=', 0)->get();
    }



    public function taste()
    {
        Log::channel('customerlog')->info('M_Taste Model', [
            'start taste'
        ]);

        $tastenames = M_Taste::where('del_flg', 0)->get();

        Log::channel('customerlog')->info('M_Taste Model', [
            'end taste'
        ]);
        return $tastenames;
    }
}
