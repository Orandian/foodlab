<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Slider extends Model
{
    public $table = "m_slider";
    use HasFactory;

    /*
     * Create : Min Khant(15/2/2022)
     * Update :
     * Explain of function : To get mslider information
     * Prarameter : no
     * return : mslider information
     * */
    public function slider(){
        Log::channel('customerlog')->info('M_Slider Model', [
            'start mslider'
        ]);
        $sliderinfo = M_Slider::select('*')
                        ->where('del_flg',0)
                        ->get();
        Log::channel('customerlog')->info('M_Slider Model', [
            'end mslider'
        ]);
        return $sliderinfo;
    }
}
