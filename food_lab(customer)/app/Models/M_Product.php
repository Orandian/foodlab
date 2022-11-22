<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Food{
        public $name;
        public $value;
}
class M_Product extends Model
{
    use HasFactory;
    public $table = 'm_product';

   
    /*
    * Create : Min Khant(14/1/2022)
    * Update :
    * Explain of function : To get product data
    * Prarameter : no
    * return : 
    */
    public function products($id)
    {
        Log::channel('customerlog')->info('M_Product Model', [
            'start products'
        ]);

        $product = M_Product::select(['id', 'product_name', 'coin', 'amount'])
            ->where('id', '=', $id)
            ->where('del_flg', '=', 0)
            ->first();

        Log::channel('customerlog')->info('M_Product Model', [
            'end products'
        ]);

        return $product;
    }

    /*
    * Create : Aung Min Khant(28/1/2022)
    * Update :
    * Explain of function : To show data to customer product page (customer)
    * parament : none
    * return product data
    * */
    public function showProductList()
    {
        Log::channel('customerlog')->info("M_Product Model", [
            'Start showProductList'
        ]);

        $product = DB::table('m_product')
            ->select(['*'], DB::raw('m_product.id'))
            ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
            ->where('m_product.avaliable', 1)
            ->where('t_ad_photo.order_id', 1)
            ->where('t_ad_photo.del_flg', 0)
            ->where('m_product.del_flg', 0)
            ->orderBy('m_product.id')
            ->get();


        Log::channel('customerlog')->info("M_Product Model", [
            'End showProductList'
        ]);

        return $product;
    }

    /*
    * Create : Aung Min Khant(13/4/2022)
    * Update :
    * Explain of function : To search product data to customer product page (customer)
    * parament : none
    * return product data
    * */

    public function searchEngineByName($request){
        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchEngineByName'
        ]);
        
        $product =   DB::table('m_product')
        ->select(['*'], DB::raw('m_product.id'))
        ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
        ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
        ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
        
        ->where(function($query) use ($request){
            $query->orWhere('m_product.product_name','Like','%'.$request.'%')
            ->orWhere('m_product.description','Like','%'.$request.'%')
            ->orWhere('m_product.list','Like','%'.$request.'%');
        })
        ->where(function($query){
            $query->where('m_product.avaliable', 1)
            ->where('t_ad_photo.order_id', 1)
            ->where('t_ad_photo.del_flg', 0)
            ->where('m_product.del_flg', 0);
        })
        ->orderBy('m_product.id')
        ->get();

        
        Log::channel('customerlog')->info("M_Product Model", [
            'End searchEngineByName'
        ]);

        return $product;
    }


     /*
    * Create : Aung Min Khant(15/4/2022)
    * Update :
    * Explain of function : To search product data to customer product page (customer)
    * parament : none
    * return product data
    * */

    public function searchEngineByNameAndCategory($name,$category,$taste){
        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchEngineByNameAndCategory'
        ]);
        
            
        $query =   DB::table('m_product')
        ->select(['*'], DB::raw('m_product.id'))
        ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')

        ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
        ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
        
        ->where(function($query) use ($name){
            $query->orWhere('m_product.product_name','Like','%'.$name.'%')
            ->orWhere('m_product.description','Like','%'.$name.'%')
            ->orWhere('m_product.list','Like','%'.$name.'%');
        });
       
        
        $query->when(isset($category),function($q) use($category){

            return $q->where('m_product.product_type', '=',(int)$category);
        });

        $query->when(isset($taste),function($q) use($taste){
            return $q->where('m_product.product_taste', '=', (int)$taste);
        });

        
        $product = $query->where(function($query){
            $query->where('m_product.avaliable', 1)
            ->where('t_ad_photo.order_id', 1)
            ->where('t_ad_photo.del_flg', 0)
            ->where('m_product.del_flg', 0);
        })
        ->orderBy('m_product.id')
        ->get();

        
        Log::channel('customerlog')->info("M_Product Model", [
            'End searchEngineByNameAndCategory'
        ]);

        return $product;
    }

    /*
    * Create : Aung Min Khant(28/1/2022)
    * Update :
    * Explain of function : To search product data to customer product page (customer)
    * parament : none
    * return product data
    * */

    public function searchById($id)
    {

        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchById'
        ]);
        $product = DB::table('m_product')
            ->select('*', DB::raw('m_product.id AS pid'))
            ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
            ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
            ->where('m_product.id', $id)
            ->where('m_product.avaliable', 1)
            ->where('m_product.del_flg', 0)
            ->first();


        Log::channel('customerlog')->info("M_Product Model", [
            'End searchById'
        ]);

        return $product;
    }


    /*
    * Create : Aung Min Khant(28/1/2022)
    * Update :
    * Explain of function : To search product data to customer product page (customer)
    * parament : none
    * return product data
    * */

    public function searchByType($request)
    {

        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchByType'
        ]);

        $product = DB::table('m_product')
            ->select(['*'], DB::raw('m_product.id'))
            ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
            ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
            ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
            ->where('m_product.product_type', '=', (int)$request)
            ->where('m_product.avaliable', 1)
            ->where('t_ad_photo.order_id', 1)
            ->where('t_ad_photo.del_flg', 0)
            ->where('m_product.del_flg', 0)
            ->orderBy('m_product.id')
            ->get();


        Log::channel('customerlog')->info("M_Product Model", [
            'End searchByType'
        ]);

        return $product;
    }


    /*
    * Create : Aung Min Khant(28/1/2022)
    * Update :
    * Explain of function : To search product data to customer product page (customer)
    * parament : none
    * return product data
    * */

    public function searchByTaste($request)
    {

        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchByTaste'
        ]);

        $product = DB::table('m_product')
            ->select(['*'], DB::raw('m_product.id'))
            ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
            ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
            ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
            ->where('m_product.product_taste', '=', (int)$request)
            ->where('m_product.avaliable', 1)
            ->where('t_ad_photo.order_id', 1)
            ->where('t_ad_photo.del_flg', 0)
            ->where('m_product.del_flg', 0)
            ->orderBy('m_product.id')
            ->get();


        Log::channel('customerlog')->info("M_Product Model", [
            'End searchByTaste'
        ]);

        return $product;
    }

    /*
    * Create : Aung Min Khant(12/4/2022)
    * Update :
    * Explain of function : To search product to customer product page (customer)
    * parament : none
    * return product data
    * */

    public function searchEngine($request){
        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchEngine'
        ]);

        $searchValue = [];
        $productName = DB::table('m_product')
        ->select(['product_name'], DB::raw('m_product.id'))
        ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
        ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
        ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
        ->where('m_product.product_name','Like','%'.$request.'%')
        ->where('m_product.avaliable', 1)
        ->where('t_ad_photo.order_id', 1)
        ->where('t_ad_photo.del_flg', 0)
        ->where('m_product.del_flg', 0)
        ->get();


        $desc = DB::table('m_product')
        ->select(['description'], DB::raw('m_product.id'))
        ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
        ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
        ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
        ->where('m_product.description','Like','%'.$request.'%')
        ->where('m_product.avaliable', 1)
        ->where('t_ad_photo.order_id', 1)
        ->where('t_ad_photo.del_flg', 0)
        ->where('m_product.del_flg', 0)
        ->get();

        $lists = DB::table('m_product')
        ->select(['list'], DB::raw('m_product.id'))
        ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
        ->join('m_fav_type', 'm_fav_type.id', '=', 'm_product.product_type')
        ->join('m_taste', 'm_taste.id', '=', 'm_product.product_taste')
        ->where('m_product.list','Like','%'.$request.'%')
        ->where('m_product.avaliable', 1)
        ->where('t_ad_photo.order_id', 1)
        ->where('t_ad_photo.del_flg', 0)
        ->where('m_product.del_flg', 0)
        ->get();
       

        foreach($productName as $name){
            $foods = new Food();
            $foods->name= 'Food';
            $foods->value = $name->product_name;
            array_push($searchValue,$foods);
        }
        foreach($desc as $de){
            $foods = new Food();
            $foods->name = 'Description';
            $foods->value = $de->description;
            array_push($searchValue,$foods);
        }
        foreach($lists as $list){
            $foods = new Food();
            $foods->name = "Ingredients";
            $foods->value = $list->list;
            array_push($searchValue,$foods);
        }
      
        
        
        Log::channel('customerlog')->info("M_Product Model", [
            'End searchEngine'
        ]);

        return $searchValue;
    }


    public function productDetail()
    {

        return $this->hasMany('App\Models\M_Product_Detail');
    }



    /*
     * Create : Min Khant(23/1/2022)
     * Update :
     * Explain of function : get product data (customer)
     * Prarameter : no
     * return : product data
     * */
    public function productInfo()
    {
        Log::channel('customerlog')->info('M_Product Model', [
            'start productInfo'
        ]);
        $products = M_Product::select(['id', 'product_name', 'coin'])
            ->where('avaliable', '=', 1)
            ->where('del_flg', '=', 0)
            ->get();
        Log::channel('customerlog')->info('M_Product Model', [
            'end productInfo'
        ]);
        return $products;
    }

    /*
      * Create : Min Khant(1/2/2022)
      * Update :
      * Explain of function : To get customer fav product data (customer)
      * Prarameter : no
      * return : customer fav product data
    */
    public function customerFavType($id)
    {
        Log::channel('customerlog')->info("M_Product Model", [
            'Start customerFavType'
        ]);

        $result = DB::table('m_product')
            ->select(['*'], DB::raw('m_product.id'))
            ->join('t_ad_photo', 't_ad_photo.link_id', '=', 'm_product.id')
            ->where('m_product.avaliable', 1)
            ->where('t_ad_photo.order_id', 1)
            ->where('t_ad_photo.del_flg', 0)
            ->where('m_product.del_flg', 0)
            ->where('m_product.product_type', $id)
            ->orderBy('m_product.id')
            ->limit(1)
            ->get();

        Log::channel('customerlog')->info("M_Product Model", [
            'End customerFavType'
        ]);

        return $result;
    }

    /*
      * Create :zayar(15/2/2022)
      * Update :
      * Explain of function : To search Product (customer)
      * Prarameter : no
      * return : customer track product data
    */
    public function  searchProduct($productIds)
    {
        Log::channel('customerlog')->info("M_Product Model", [
            'Start searchProduct'
        ]);

        $result = M_Product::where('m_product.avaliable', 1)
            ->where('m_product.del_flg', 0)
            ->whereIn('m_product.id', $productIds)
            ->get();


        Log::channel('customerlog')->info("M_Product Model", [
            'End searchProduct'
        ]);
        return $result;
    }
}
