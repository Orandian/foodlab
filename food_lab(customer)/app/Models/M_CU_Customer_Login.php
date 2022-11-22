<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_CU_Customer_Login extends Model
{
    public $table = 'm_cu_customer_login';
    use HasFactory;

    /*
      * Create : Min Khant(15/1/2022)
      * Update :
      * Explain of function :
      * Prarameter : no
      * return :
    */
    public function customer()
    {
        return $this->belongsTo('App\Models\T_CU_Customer');
    }

    /*
      * Create : Min Khant(16/1/2022)
      * Update :
      * Explain of function : To update verify code
      * Prarameter : no
      * return :
    */
    public function updateVerifyCode($key)
    {
        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'start updateVerifyCode'
        ]);

        $verify = M_CU_Customer_Login::where('verify_code', $key)
            ->update(['verify' => 1]);

        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'end updateVerifyCode'
        ]);
    }

    /*
      * Create : Min Khant(16/1/2022)
      * Update :
      * Explain of function : To unique mail
      * Prarameter : no
      * return :
    */
    public function checkMail($mail)
    {
        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'start checkMail'
        ]);

        $hasMail = M_CU_Customer_Login::where('email', $mail)
            ->where('del_flg', 0)
            ->get();

        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'end checkMail'
        ]);

        return $hasMail;
    }


    /*
      * Create : Min Khant(16/1/2022)
      * Update :
      * Explain of function : To check email from login form
      * Prarameter : no
      * return : customer info
    */
    public function loginMail($mail)
    {
        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'start  loginMail'
        ]);

        $correct = M_CU_Customer_Login::where('email', '=', $mail)
            ->get();

        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'end  loginMail'
        ]);
        return $correct;
    }

    /*
      * Create : Min Khant(16/1/2022)
      * Update :
      * Explain of function : To check email and password from login form
      * Prarameter : no
      * return : customer info
    */
    public function loginPassword($mail, $pwd)
    {
        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'start loginPassword'
        ]);

        $correct = M_CU_Customer_Login::where('email', '=', $mail)
            ->where('password', '=', md5(sha1($pwd)))
            ->get();

        Log::channel('customerlog')->info('M_CU_Customer_Login Model', [
            'end loginPassword'
        ]);

        return $correct;
    }
}
