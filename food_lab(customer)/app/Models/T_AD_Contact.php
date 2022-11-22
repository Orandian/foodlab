<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Contact extends Model
{
    public $table = 't_ad_contact';
    use HasFactory;

    /*
    * Create : Min Khant(9/2/2022)
    * Update :
     * * Explain of function : store data from customer contact form
     * * Prarameter : input data
     * * return :
     */
    public function contactForm($req)
    {
        Log::channel('customerlog')->info('CustomerController', [
            'start contactForm'
        ]);
        $contact = new T_AD_Contact();
        $contact->message = $req['message'];
        $contact->customer_id = session('customerId');
        $contact->save();
        Log::channel('customerlog')->info('CustomerController', [
            'end contactForm'
        ]);
    }
}
