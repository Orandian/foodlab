<?php

namespace App\Rules;

use App\Models\M_CU_Customer_Login;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class LoginMail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        Log::channel('customerlog')->info('LoginMail Rule',[
           'start passes'
        ]);

        $mail = new M_CU_Customer_Login();
        $hasMail = $mail->loginMail($value);

        if(count($hasMail) > 0){
            session(['email'=>$value]);

            Log::channel('customerlog')->info('LoginMail Rule',[
                'end passes'
            ]);
            return true;
        }

        Log::channel('customerlog')->info('LoginMail Rule',[
            'end passes'
        ]);
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your Email doesn\'t exists';
    }
}
