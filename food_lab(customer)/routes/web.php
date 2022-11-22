<?php
// use Cviebrock\EloquentTaggable\Models\Tag;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoinchargeTransaction;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BuycoinController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\FavtypeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SuggestController;
use App\Http\Controllers\TasteController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\customerInfoController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\CustomerProfileUpdate;
use App\Http\Controllers\DeliveryInfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\TransactionController;
use Illuminate\Routing\RouteGroup;
use phpDocumentor\Reflection\DocBlock\Tag as DocBlockTag;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//_________________________________Customer Routes_________________________

Route::group(['middleware' => ['checkMaintenance']], function () {

   //For Customer Cart Count
   Route::post('/cartCount', [CustomerController::class, 'cartCount']);
   /*
     * For customer home page
    */
   Route::get('/home', [CustomerController::class, 'home']);

   /*
     * For Policy Info Page
    */
   Route::get('/policyinfo', [CustomerController::class, 'policy']);

   /*
    * For delivery info Page
    */
   Route::get('/delivery', [CustomerController::class, 'deliveryDetails']);

   /*
    * For favtypess
    */
   Route::get('/getfavtypes', [CustomerController::class, 'tagsFavType']);
   // check Customer id
   Route::group(['middleware' => ['checkCustomerId']], function () {


      /*
    * For Detail message Customer
    * zayar
    */
      Route::get('/messageDetail/{id}', [CustomerController::class, 'messageDetail']);
      /*
    * For Detail message Customer
    * zayar
    */
      Route::get('/trackDetail/{id}', [CustomerController::class, 'trackDetail']);

      /*
    * For Edit Profile Page
    * zayar
    */
      Route::resource('editprofile', CustomerProfileController::class);

      /*
    * For ajax
    * zayar
    */
      Route::get('searchcustomerdetails', [customerInfoController::class, 'customerDetailSearch']);

      /*
    * For Update Profile Page
    * zayar
    */
      Route::resource('updateprofile', CustomerProfileUpdate::class);

      /*
     * For messages page
     * zayar
     */
      Route::get('/messages', [CustomerController::class, 'message']);

      /*
     * For tracks page
     * zayar
     */
      Route::get('/tracks', [CustomerController::class, 'tracks']);

      /*
     * For Reprot Page
    */
      Route::get('/report', [CustomerController::class, 'report']);

      /*
     * From Report Page to store form data in database
    */
      Route::post('/report', [CustomerController::class, 'reportForm']);

      /*
     * For Suggest Page */
      Route::get('/suggest', [CustomerController::class, 'suggest']);

      // For Suggest Form
      Route::post('/suggest', [CustomerController::class, 'suggestForm']);

      /*
     * For contact page*/
      Route::get('/contact', [CustomerController::class, 'contact']);

      /*
     * For contact form*/
      Route::post('/contact', [CustomerController::class, 'contactForm']);

      /*
     * For cart page
     * min khant
    */
      Route::get('/cart', [CartController::class, 'cart']);
      Route::post('/cart', [CartController::class, 'cartDetail']);
      Route::post('/deleteProduct', [CartController::class, 'deleteProduct']);

      /*
     * For deliery info page
     * cherry
    */
      Route::get('/deliveryInfo', [DeliveryInfoController::class, 'deliveryInfo']);
      Route::post('/deliveryInfo', [DeliveryInfoController::class, 'order']);
   });

   /*
     * For Access Page
     */
   Route::get('/signup', [CustomerController::class, 'signup']);

   /*
     * For Register Form
     */
   Route::post('/access', [CustomerController::class, 'register']);
   Route::post('/getTownship', [CustomerController::class, 'getTownship']);

   Route::post('/google', [CustomerController::class, 'google']);

   /*
      * For verify account
      */
   Route::get('mail/{key}', [CustomerController::class, 'verifyLink']);

   /*
      * For Login Page
      */
   Route::get('/signin', [CustomerController::class, 'login']);

   /*
      * For Login Form
      */
   Route::post('/login', [CustomerController::class, 'loginForm']);

   //  for Check Mail page
   Route::get('/checkEmail', [CustomerController::class, 'checkEmail']);

   /*
     * For news get initial
     * zayar
     */
   Route::get('/getnews', [CustomerController::class, 'getNews']);

   /*
     * For news page
     * zayar
     */
   Route::get('/customerNews', [CustomerController::class, 'news']);

   /*
    For Buy Coin Page
    */
   Route::get('/buycoin', [BuycoinController::class, 'customerBuycoin']);
   Route::post('/buycoinForm', [BuycoinController::class, 'coinrequestUpload']);


   /*
     * For Product Detail Form
     */
   Route::get('/productDetail', [ProductDetailController::class, 'detail']);
   Route::post('/cartsession', [CartController::class, 'getData']);
   Route::post('/sessionCount', [CartController::class, 'getData']);


   /*
     * For Product
     */
   Route::get('/', [ProductDetailController::class, 'productList']);
   // Route::get('menu',[ProductDetailController::class,'eachList'] );
   Route::post('/searchFood',[ProductSearchController::class,'searchFood']);
   Route::post('/searchFoodName',[ProductSearchController::class,'searchByNameAndCategory']);
   Route::post('/specificFood',[ProductSearchController::class,'searchByName']);
   Route::post('/searchCategory', [ProductSearchController::class, 'searchByCategory']);
   Route::post('/searchTaste', [ProductSearchController::class, 'searchByTaste']);
   Route::get('/menutype', [ProductSearchController::class, 'listByType']);
   Route::get('/menutaste', [ProductSearchController::class, 'listByTaste']);

   /*
     * For logging out
     */
   Route::get('/logout', [CustomerController::class, 'logout']);
});
