<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Suggest extends Model
{
    public $table = 'm_suggest';
    use HasFactory;

    /*
     * Create : Min Khant(22/1/2022)
     * Update :
     * Explain of function : to get suggest type from database
     * Prarameter : no
     * return : suggest type
     * */
    public function suggestType()
    {
        Log::channel('customerlog')->info('M_Suggest Model', [
            'start suggestType'
        ]);
        $type = M_Suggest::select(['id', 'suggest_type'])
            ->where('del_flg', 0)
            ->get();

        Log::channel('customerlog')->info('M_Suggest Model', [
            'end suggestType'
        ]);
        return $type;
    }
}
