<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class M_AD_News extends Model
{
    public $table = 'm_ad_news';
    use HasFactory;

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : To show important news for users
     * Prarameter : no
     * return : news
     * */
    public function news()
    {
        Log::channel('customerlog')->info('M_AD_News Model', [
            'start news'
        ]);
        $news = M_AD_News::where('del_flg', '=', '0')
            ->where('public', '0')
            ->get();
        Log::channel('customerlog')->info('M_AD_News Model', [
            'end news'
        ]);
        return $news;
    }

    /*
     * Create : zayar(24/1/2022)
     * Update :
     * Explain of function : To show  news for users in inform alert box (customer )
     * Prarameter : no
     * return : news
     * */
    public function newsLimited()
    {
        Log::channel('customerlog')->info("M_AD_News Model", [
            'Start newsLimited'
        ]);
        $allnews =
            M_AD_News::orderBy('updated_at', 'DESC')
            ->select('*', DB::raw('updated_at AS newscreated'))
            ->where('m_ad_news.del_flg', 0)
            ->limit(3)
            ->get();
        Log::channel('customerlog')->info("M_AD_News Model", [
            'End newsLimited'
        ]);
        return $allnews;
    }

    /*
     * Create : zayar(25/1/2022)
     * Update :
     * Explain of function : To show  news for users in news page (customer)
     * Prarameter : no
     * return : news
     * */
    public function newsAll()
    {
        Log::channel('customerlog')->info("M_AD_News Model", [
            'Start newsLimited'
        ]);
        Log::channel('customerlog')->info("M_AD_News Model", [
            'End newsLimited'
        ]);
        return M_AD_News::select('*', DB::raw('m_ad_news.updated_at AS newscreated'))
            ->orderBy('m_ad_news.updated_at', 'DESC')
            ->where('m_ad_news.del_flg', 0)
            ->join('m_news_category', 'm_news_category.id', '=', 'm_ad_news.category')
            ->paginate(10);
    }
    /*
     * Create : zayar(15/2/2022)
     * Update :
     * Explain of function : To show  news for users in news page (customer)
     * Prarameter : no
     * return : news
     * */
    public function newsAllToCount()
    {
        Log::channel('customerlog')->info("M_AD_News Model", [
            'Start newsAllToCount'
        ]);
        $news = M_AD_News::where('del_flg', 0)
            ->whereBetween('updated_at', [
                \carbon\Carbon::now()->subdays(2)->format('Y-m-d'),
                \carbon\Carbon::now()->addDays(1)->format('Y-m-d')
            ])->get();

        Log::channel('customerlog')->info("M_AD_News Model", [
            'End newsAllToCount'
        ]);
        return $news;
    }
}
