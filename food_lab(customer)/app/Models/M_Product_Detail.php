<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Product_Detail extends Model
{
    use HasFactory;
    public $table = 'm_product_detail';


    /*
    * Create : Aung Min Khant(28/1/2022)
    * Update :
    * Explain of function : search data by id and send to product detail page (customer)
    * parameter : $request form product list
    * return product Detail
    * */

    public function searchDataById($id)
    {

        Log::channel('customerlog')->info("M_Product_Detail Model", [
            'Start searchDataById'
        ]);

        $mProductDetail = DB::select(
            DB::raw("SELECT
            m_product_detail.category,m_product_detail.label,m_product_detail.order,m_product_detail.value
        FROM
            m_product_detail
        WHERE
            m_product_detail.product_id = $id AND
            m_product_detail.del_flg = 0
        
         ORDER BY 
            m_product_detail.id     
        ")
        );

        Log::channel('customerlog')->info("M_Product_Detail Model", [
            'End searchDataById'
        ]);

        return $mProductDetail;
    }

    public function product()
    {

        return $this->belongsTo('App\Models\Product');
    }
}
