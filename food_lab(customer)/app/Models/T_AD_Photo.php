<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Photo extends Model
{
    use HasFactory;
    public $table = 't_ad_photo';

    /*
    * Create : Aung Min Khant(20/1/2022)
    * Update :
    * Explain of function : To restore product image from t_av_evd database (customer)
    * parament : specific id  from m_product database
    * return  data
    * */
    public function editEvd($id)
    {

        Log::channel('customerlog')->info("T_AD_Photo Model", [
            'Start editEvd'
        ]);
        $phd = DB::select(
            DB::raw("SELECT
            t_ad_photo.path
            FROM
            t_ad_photo
            WHERE
            t_ad_photo.link_id = $id AND
            t_ad_photo.del_flg = 0 
            ORDER BY
            t_ad_photo.order_id")
        );

        Log::channel('customerlog')->info("T_AD_Photo Model", [
            'End editEvd'
        ]);
        return $phd;
    }

    public function getPhoto($order, $product)
    {
        $photo = T_AD_Photo::where('link_id', '=', $product)
            ->where('order_id', '=', $order)
            ->where('del_flg', '=', 0)
            ->first();

        return $photo ? $photo : "";
    }

    public function deleteImage($id)
    {

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'Start delete image'
        ]);
        T_AD_Photo::where('link_id', $id)
            ->update(['del_flg' => 1]);

        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'End delete image'
        ]);
    }

    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : To update product image to t_av_evd database
    * parament : request from product add form
    * return update data
    * */
    public function updateImage($id, $filepath)
    {
        Log::channel('adminlog')->info("T_AD_Photo Model", [
            'Start update Data'
        ]);
        $evd = T_AD_Photo::where('t_ad_photo.link_id', '=', $id)
            ->where('t_ad_photo.path', '=', $filepath)
            ->get();
        $evd->path = $filepath;
        $evd->save();

        Log::channel('adminlog')->info("T_AD_Photo  Model", [
            'End update Data'
        ]);
    }

    /*
    * Create : Min Khant(16/2/2022)
    * Update :
    * Explain of function : get product photo for cart 
    * parament : request from product add form
    * return update data
    * */
    public function productImg($id)
    {
        Log::channel('customerlog')->info("T_AD_Photo  Model", [
            'start productImg'
        ]);
        $photo = T_AD_Photo::select('path')->where('link_id', $id)->first();

        Log::channel('customerlog')->info('T_AD_Photo Model', [
            'end productImg'
        ]);
        return $photo;
    }
}
