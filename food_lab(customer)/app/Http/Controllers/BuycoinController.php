<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoinChargeVali;
use App\Models\M_AD_CoinCharge_Message;
use App\Models\M_AD_CoinRate;
use App\Models\M_AD_News;
use App\Models\M_AD_Track;
use App\Models\M_Payment;
use App\Models\M_Product;
use App\Models\M_Site;
use App\Models\T_AD_CoinCharge;
use App\Models\T_AD_Evd;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BuycoinController extends Controller
{
    /*
     * Create : Zaw Phyo(25/1/2022)
     * Update :
     * Explain of function : To Call Customer Buycoin View
     * Prarameter : no
     * return : View buyCoin blade
     * */
    public function customerBuycoin()
    {

        Log::channel('customerlog')->info('Buycoin Controller', [
            'Start customerBuycoin'
        ]);

        $messageLimited = [];
        $tracksLimited = [];
        $userinfo = null;

        if (session()->has('customerId')) {
            $sessionCustomerId = session('customerId');
            $messages = new M_AD_CoinCharge_Message();
            $messageLimited = $messages->informMessage($sessionCustomerId);

            $tracks = new M_AD_Track();
            $tracksLimited = $tracks->trackLimited($sessionCustomerId);

            $user = new T_CU_Customer();
            $userinfo = $user->loginUser($sessionCustomerId);


            $news = new M_AD_News();
            $newDatas = $news->news();
            $newsLimited = $news->newsLimited();

            $coinrate = new M_AD_CoinRate();
            $coinrateDatas = $coinrate->DashboardCoinrate();


            $site = new M_Site();
            $name = $site->siteName();

            $paymentdata = new M_Payment();
            $paymentAccounts = $paymentdata->paymentAcoounts();

            Log::channel('customerlog')->info('Buycoin Controller', [
                'End customerBuycoin'
            ]);

            return view('customer.coin.buyCoin', [
                'nav' => 'coin',
                'news' => $newDatas,
                'user' => $userinfo,
                'limitednews' => $newsLimited,
                'limitedmessages' => $messageLimited,
                'limitedtracks' => $tracksLimited,
                'name' => $name,
                'coinrateData' => $coinrateDatas,
                'paymentAccount' => $paymentAccounts
            ]);
        } else {
            Log::channel('customerlog')->info('Buycoin Controller', [
                'End customerBuycoin'
            ]);
            return redirect("/");
        }
    }
    /*
     * Create : Zaw Phyo(26/1/2022)
     * Update :
     * Explain of function : To Upload Customer Coin Charge Request
     * Prarameter : no
     * return : View buyCoin blade
     * */
    public function coinrequestUpload(CoinChargeVali $request)
    {
        Log::channel('customerlog')->info('Buycoin Controller', [
            'Start coinrequestUpload'
        ]);

        $coinChargeFormdata = $request->validated();
    
        $file = $request->file('fileimage');
        $filepath = $file->store('coinCharge');

        $bcustomerID = session("customerId");

        $cucoindata = new T_AD_CoinCharge();
        $cucoindata->customerCoinCharge($coinChargeFormdata, $bcustomerID, $filepath);

        Log::channel('customerlog')->info('Buycoin Controller', [
            'End coinrequestUpload'
        ]);

        return redirect('/buycoin');
    }
}
