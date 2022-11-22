<?php

namespace App\Rules;

use App\Models\M_CU_Customer_Login;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class LoginPassword implements Rule
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
        Log::channel('customerlog')->info('LoginPassword Rule', [
            'start passes'
        ]);

        if (session()->has('email')) {
            $mail = session()->get('email');
            session()->forget('email');

            $hasAcc = new M_CU_Customer_Login();
            $correct = $hasAcc->loginPassword($mail, $value);

            if (count($correct) > 0) {
                session(['verify' => $correct[0]['verify'], 'customerId' => $correct[0]['customer_id']]);

                Log::channel('customerlog')->info('LoginPassword Rule', [
                    'end passes'
                ]);

                return true;
            }
        }
        Log::channel('customerlog')->info('LoginPassword Rule', [
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
        return 'Your Password is incorrect';
    }
}
