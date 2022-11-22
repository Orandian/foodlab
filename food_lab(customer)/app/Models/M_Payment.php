<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Payment extends Model
{
    public $table = 'm_payment';
    use HasFactory;

    /*
   * Create:Zaw Phyo (2022/01/28) 
   * Update: 
   * This function is used to pull out Payment Accounts.
   * Return : Payment Accounts.
   */
    public function paymentAcoounts()
    {
        Log::channel('customerlog')->info("M_Payment Model", [
            'Start paymentAccounts'
        ]);

        $paymentAccounts = M_Payment::where('del_flg', 0)->get();

        Log::channel('customerlog')->info("M_Payment Model", [
            'End paymentAccounts'
        ]);
        return $paymentAccounts;
    }
}
