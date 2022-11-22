<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_AD_News;
use App\Models\M_Fav_Type;
use App\Models\M_Product;
use App\Models\M_Product_Detail;
use App\Models\M_Site;
use App\Models\M_Taste;
use App\Models\T_AD_Photo;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductDetailController extends Controller
{

    /*
    * Create : Aung Min Khant(29/1/2022)
    * Update :
    * Explain of function : to get all deail data for product detail page by speciic id  (customer)
    * parameter : $request id from product view 
    * return detail data to product detail page
    * */
    public function detail(Request $request)
    {

        Log::channel('customerlog')->info('ProductDetailController', [
            'Start detail'
        ]);


        $news = new M_AD_News();
        $newDatas = $news->news();
        $newsCount = count($newDatas);
        $newsLimited = $news->newsLimited();

        $site = new M_Site();
        $name = $site->siteName();

        $product = new M_Product();
        $productId = $product->searchById($request->input('id'));
        if ($productId == null) abort(404);

        $pPhoto = new T_AD_Photo();
        $productPhoto = $pPhoto->editEvd($request->input('id'));
        if ($productPhoto == null) abort(404);

        $productInfos = $product->productInfo();


        $mDetail = new M_Product_Detail();
        $detail = $mDetail->searchDataById($request->input('id'));
        // if ($detail == null) abort(404);


        Log::channel('customerlog')->info('ProductDetailController', [
            'End detail'
        ]);

        return View('customer.productDetail.productDetail', ['name' => $name, 'news' => $newDatas, 'productInfos' => $productInfos, 'productId' => $productId, 'photos' => $productPhoto, 'detail' => $detail, 'nav' => 'product', 'limitednews' => $newsLimited]);
    }

    /*
    * Create : Aung Min Khant(29/1/2022)
    * Update :
    * Explain of function : all data for product view page from database (customer)
    * parameter : none
    * return all data to view 
    * */

    public function productList()
    {

        Log::channel('customerlog')->info('ProductDetailController', [
            'Start productList'
        ]);


        $news = new M_AD_News();
        $newDatas = $news->news();
        $newsCount = count($newDatas);
        $newsLimited = $news->newsLimited();

        $site = new M_Site();
        $name = $site->siteName();

        $product = new M_Product();
        $productInfos = $product->productInfo();
        $allProducts = $product->showProductList();

        // return $allProducts;
        $recomProducts = [];
        if (session()->has('customerId')) {
            $sessionCustomerId = session()->get('customerId');
            $user = new T_CU_Customer();
            $custoemrInfo = $user->customerInformation($sessionCustomerId);
            $favTypes = explode(",", $custoemrInfo[0]['fav_type']);
            $mFavType = new M_Fav_Type();
            $product = new M_Product();
            foreach ($favTypes as $favType) {
                $id = $mFavType->customerFavType($favType);
                $eachProduct = $product->customerFavType($id['id']);
                array_push($recomProducts, $eachProduct);
            }
        }


        $fav = new  M_Fav_Type();
        $mFav = $fav->getTypeAll();

        $taste = new M_Taste();
        $mTaste = $taste->getTasteAll();

        Log::channel('customerlog')->info('ProductDetailController', [
            'End productList'
        ]);

        return View('customer.productDetail.product', ['name' => $name, 'news' => $newDatas, 'productInfos' => $productInfos, 'products' => $allProducts, 'recommend' => $recomProducts, 'mFav' => $mFav, 'mTaste' => $mTaste, 'nav' => 'product', 'limitednews' => $newsLimited]);
    }
}
