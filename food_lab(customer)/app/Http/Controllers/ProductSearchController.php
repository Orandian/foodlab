<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_AD_News;
use App\Models\M_Product;
use App\Models\M_Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductSearchController extends Controller
{

     /*
    * Create : Aung Min Khant(12/4/2022)
    * Update :
    * Explain of function : search engine for food  (customer)
    * parameter : request form view with ajax
    * return data product with json
    * */

    public function searchFood(Request $request){
        
        Log::channel('customerlog')->info("ProductSearchController", [
            'Start searchFood'
        ]);

        $products = new M_Product();
        $food = $products->searchEngine($request->input('name'));
    
        Log::channel('customerlog')->info("ProductSearchController", [
            'End searchFood'
        ]);

        return response()
        ->json(
            $food
        );
    }

     /*
    * Create : Aung Min Khant(13/4/2022)
    * Update :
    * Explain of function : search food by name  (customer)
    * parameter : request form view with ajax
    * return data product with json
    * */


    public function searchByName(Request $request){

        Log::channel('customerlog')->info("ProductSearchController", [
            'Start searchByName'
        ]);

        $products = new M_Product();
        $food = $products->searchEngineByName($request->input('name'));

        Log::channel('customerlog')->info("ProductSearchController", [
            'End searchByName'
        ]);

        return response()
            ->json(
                $food
            );
            


    }

     /*
    * Create : Aung Min Khant(15/4/2022)
    * Update :
    * Explain of function : search food by name and category  (customer)
    * parameter : request form view with ajax
    * return data product with json
    * */

    public function searchByNameAndCategory(Request $request){

        Log::channel('customerlog')->info("ProductSearchController", [
            'Start searchByName'
        ]);

        $products = new M_Product();
        $food = $products->searchEngineByNameAndCategory($request->input('name'),$request->input('category'),$request->input('taste'));

        Log::critical("message",[$request->input('name'),$request->input('category'),$request->input('taste')]);
        Log::critical("message",[$food]);
        Log::channel('customerlog')->info("ProductSearchController", [
            'End searchByName'
        ]);

        return response()
            ->json(
                $food
            );
    }
    /*
    * Create : Aung Min Khant(30/1/2022)
    * Update :
    * Explain of function : search by category for product  (customer)
    * parameter : $request from product view with ajax
    * return data product with json
    * */

    public function searchByCategory(Request $request)
    {

        Log::channel('customerlog')->info("ProductSearchController", [
            'Start searchByCategory'
        ]);

        $products = new M_Product();
        $product  = $products->searchByType($request->input('type'));

        Log::channel('customerlog')->info("ProductSearchController", [
            'End searchByCategory'
        ]);

        return response()
            ->json(
                $product
            );
    }

    /*
    * Create : Aung Min Khant(30/1/2022)
    * Update :
    * Explain of function : search by taste for product  (customer)
    * parameter : $request from product view with ajax
    * return data product with json
    * */

    public function searchByTaste(Request $request)
    {

        Log::channel('customerlog')->info("ProductSearchController", [
            'Start searchByTaste'
        ]);

        $products = new M_Product();
        $product  = $products->searchByTaste($request->input('type'));



        Log::channel('customerlog')->info("ProductSearchController", [
            'End searchByTaste'
        ]);

        return response()
            ->json(
                $product
            );
    }


    /*
    * Create : Aung Min Khant(30/1/2022)
    * Update :
    * Explain of function : get id from product page and shown by specific type (customer)
    * parameter : $request id from product 
    * return data product
    * */
    public function listbyType(Request  $request)
    {

        Log::channel('customerlog')->info("ProductSearchController", [
            'Start listbyType'
        ]);

        $news = new M_AD_News();
        $newDatas = $news->news();
        $newsCount = count($newDatas);
        $newsLimited = $news->newsLimited();

        $site = new M_Site();
        $name = $site->siteName();

        $products = new M_Product();
        $product  = $products->searchByType($request->input('id'));
        if (count($product) == 0) abort(404);


        Log::channel('customerlog')->info("ProductSearchController", [
            'End listbyType'
        ]);
        return View('customer.productDetail.listproduct', ['name' => $name, 'news' => $newDatas, 'nav' => 'product', 'limitednews' => $newsLimited, 'products' => $product]);
    }


    /*
    * Create : Aung Min Khant(30/1/2022)
    * Update :
    * Explain of function : get id from product page and shown by specific taste (customer)
    * parameter : $request id from product 
    * return data product
    * */
    public function listbyTaste(Request  $request)
    {

        Log::channel('customerlog')->info("ProductSearchController", [
            'Start listbyTaste'
        ]);

        $news = new M_AD_News();
        $newDatas = $news->news();
        $newsCount = count($newDatas);
        $newsLimited = $news->newsLimited();

        $site = new M_Site();
        $name = $site->siteName();



        $products = new M_Product();
        $product  = $products->searchByTaste($request->input('id'));
        if (count($product) == 0) abort(404);


        Log::channel('customerlog')->info("ProductSearchController", [
            'End listbyTaste'
        ]);
        return View('customer.productDetail.listproduct', ['name' => $name, 'news' => $newDatas, 'nav' => 'product', 'limitednews' => $newsLimited, 'products' => $product]);
    }
}
