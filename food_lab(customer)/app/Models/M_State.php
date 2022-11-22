<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_State extends Model
{
    use HasFactory;
    public $table = 'm_state';

    /*
     * Create : Min Khant(24/1/2022)
     * Update :
     * Explain of function : To get state Name
     * Prarameter : no
     * return : state name
     * */
    public function stateName()
    {
        Log::channel('customerlog')->info('M_State Model', [
            'start stateName'
        ]);
        $state = M_State::where('del_flg', 0)
            ->get();
        Log::channel('customerlog')->info('M_State Model', [
            'end stateName'
        ]);
        return $state;
    }
}
