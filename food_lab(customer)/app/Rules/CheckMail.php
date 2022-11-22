<?php

namespace App\Rules;

use App\Models\M_CU_Customer_Login;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CheckMail implements Rule
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
        Log::channel('customerlog')->info('CheckMail Rule',[
            'start passes'
        ]);

        $mail = new M_CU_Customer_Login();
        $hasMail = $mail->checkMail($value);

        Log::channel('customerlog')->info('CheckMail Rule',[
            'end passes'
        ]);

        return count($hasMail) > 0 ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your email already has been created.';
    }
}
