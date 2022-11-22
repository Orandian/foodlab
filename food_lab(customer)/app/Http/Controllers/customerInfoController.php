<?php

namespace App\Http\Controllers;

use App\Models\M_AD_CoinCharge_Message;
use App\Models\M_AD_News;
use App\Models\M_AD_Track;
use App\Models\M_Product;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class customerInfoController extends Controller
{
    /*
    * Create:zayar(2022/02/03) 
    * Update: 
    * This is function is to get customer details
    * Return is view (customer.blade.php)
    */
    public function customerDetailSearch(Request $request)
    {
        Log::channel('customerlog')->info('customerInfoController', [
            'Start customerDetailSearch'
        ]);

        $messageLimited = [];
        $tracksLimited = [];
        $messagecount = 0;
        $trackcount = 0;
        if (session()->has('customerId')) {
            $sessionCustomerId = session()->get('customerId');
            $messages = new M_AD_CoinCharge_Message();
            $messageLimited = $messages->informMessage($sessionCustomerId);
            $messageLimitedToCount = $messages->informMessageToCount($sessionCustomerId);
            $allmessage = $messages->allMessage($sessionCustomerId);
            $allMessageToCount = $messages->allMessageToCount($sessionCustomerId);
            $messagecount = count($allMessageToCount);

            $tracks = new M_AD_Track();
            $tracksLimited = $tracks->trackLimited($sessionCustomerId);
            $tracksLimitedToCount = $tracks->trackLimitedToCount($sessionCustomerId);
            $productIds = [];
            foreach ($tracksLimited as $key => $value) {
                $ids = (int)$value->title;
                array_push($productIds, $ids);
            }
            $product = new M_Product();
            $searchProduct = $product->searchProduct($productIds);
            $alltracks = $tracks->allTracks($sessionCustomerId);
            $allTracksToCount = $tracks->allTracksToCount($sessionCustomerId);
            $trackcount = count($allTracksToCount);

            $user = new T_CU_Customer();
            $userinfo = $user->loginUser($sessionCustomerId);
        }
        $news = new M_AD_News();
        $newDatas = $news->newsAll();
        $newsAllToCount = $news->newsAllToCount();
        $newsCount = count($newsAllToCount);
        $newsLimited = $news->newsLimited();

        $informBadgeCount = $newsCount + $trackcount + $messagecount;

        Log::channel('customerlog')->info('customerInfoController', [
            'End customerDetailSearch'
        ]);


        return response()
            ->json([
                'detail' => $userinfo,
                'allnews' => $newDatas,
                'limitednews' => $newsLimited,
                'allmessages' => $allmessage,
                'limitedmessages' => $messageLimited,
                'alltracks' => $alltracks,
                'limitedtracks' => $tracksLimited,
                'allmessages' => $allmessage,
                'alertcount' => $informBadgeCount,
                'trackProduct' => $searchProduct,
                'messageLimitedCount' => $messageLimitedToCount,
                'trackLimitedCount' => $tracksLimitedToCount
            ]);
    }
}
