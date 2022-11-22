<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormValidation;
use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Http\Requests\UpdateProfileValidation;
use App\Http\Requests\ReportFormValidation;
use App\Http\Requests\SuggestFormValidation;
use App\Mail\VerifyMail;
use App\Models\AdNews;
use App\Models\M_AD_CoinCharge_Message;
use App\Models\M_AD_News;
use App\Models\M_AD_Track;
use App\Models\M_CU_Customer_Login;
use App\Models\M_Fav_Type;
use App\Models\M_Product;
use App\Models\M_Site;
use App\Models\M_Slider;
use App\Models\M_State;
use App\Models\M_Suggest;
use App\Models\M_Taste;
use App\Models\M_Township;
use App\Models\T_AD_CoinCharge;
use App\Models\T_AD_Contact;
use App\Models\T_AD_Order;
use App\Models\T_AD_OrderDetail;
use App\Models\T_AD_Report;
use App\Models\T_AD_Suggest;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\CountValidator\CountValidatorAbstract;

class CustomerController extends Controller
{
    /*
     * Create : Min Khant(10/1/2022)
     * Update : zayar(24/1/2022)
     * Explain of function : For call view customer home page
     * Prarameter : no
     * return : View Home Blade
     * */
    public function home()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'Start foodlab'
        ]);


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

        $mSlider = new M_Slider();
        $sliderInfo = $mSlider->slider();

        $townships = new M_Township();
        $townshipnames = $townships->townshipDetails();

        $news = new M_AD_News();
        $newDatas = $news->news();

        $site = new M_Site();
        $name = $site->siteName();

        $tAdOrderDetail = new T_AD_OrderDetail();
        $sellProducts = $tAdOrderDetail->bestSellItems();

        Log::channel('customerlog')->info('Customer Controller', [
            'End foodlab'
        ]);

    
        return view('customer.home', [
            'sliderInfos' => $sliderInfo,
            'townships' => $townshipnames,
            'news' => $newDatas,
            'name' => $name,
            'sellProducts' => $sellProducts,
            'recomProducts' => $recomProducts,
            'nav' => 'home'
        ]);
    }

    /*
     * Create : min khant(27/2/2022)
     * Update :
     * Explain of function : For get count from session of cart
     * Prarameter : no
     * return : cart count
     * */
    public  function  cartCount()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'Start cartCount'
        ]);

        $count = 0;
        if (session()->has('cart')) {
            $count = count(session('cart'));
        }

        Log::channel('customerlog')->info('Customer Controller', [
            'End cartCount'
        ]);

        return $count;
    }

    /*
     * Create : zayar(25/1/2022)
     * Update :
     * Explain of function : For news page (customer)
     * Prarameter : no
     * return : View news Blade
     * */
    public function news()
    {
        Log::channel('cutomerlog')->info('Customer Controller', [
            'start news'
        ]);

        $site = new M_Site();
        $name = $site->siteName();

        $news = new M_AD_News();
        $allnews = $news->newsAll();
        Log::channel('cutomerlog')->info('Customer Controller', [
            'end news'
        ]);
        return view('customer.inform.news', [
            'news' => $allnews,
            'allnews' => $allnews,
            'name' => $name,
            'nav' => 'inform'
        ]);
    }

    /*
     * Create : zayar(25/1/2022)
     * Update :
     * Explain of function : For message page (customer)
     * Prarameter : no
     * return : View message Blade
     * */
    public function message()
    {
        Log::channel('cutomerlog')->info('Customer Controller', [
            'start message'
        ]);

        $allmessage = [];
        $site = new M_Site();
        $name = $site->siteName();
        if (session()->has('customerId')) {
            $sessionCustomerId = session('customerId');
            $messages = new M_AD_CoinCharge_Message();
            $allmessage = $messages->allMessage($sessionCustomerId);
        }

        Log::channel('cutomerlog')->info('Customer Controller', [
            'end message'
        ]);

        return view('customer.inform.messages', [
            'allmessages' => $allmessage,
            'name' => $name,
            'nav' => 'inform'
        ]);
    }

    /*
     * Create : zayar(25/1/2022)
     * Update :
     * Explain of function : For tracks page (customer)
     * Prarameter : no
     * return : View message Blade
     * */
    public function tracks()
    {
        $site = new M_Site();
        $name = $site->siteName();
        Log::channel('cutomerlog')->info('Customer Controller', [
            'start tracks'
        ]);
        $alltracks = [];
        if (session()->has('customerId')) {

            $sessionCustomerId = session('customerId');
            $tracks = new M_AD_Track();
            $alltracks = $tracks->allTracks($sessionCustomerId);

            for ($i = 0; $i < count($alltracks); $i++) {
                $combine = "";
                $ids = $alltracks[$i]->title;
                $product = new M_Product();
                $searchProduct = $product->searchProduct(explode(',', $ids));
                // $value->title = $searchProduct;
                foreach ($searchProduct as $key => $value) {
                    $combine .=  " " . $value->product_name;
                }
                $alltracks[$i]->title = $combine;
            }
        }
        Log::channel('cutomerlog')->info('Customer Controller', [
            'end tracks'
        ]);

        return view('customer.inform.tracks', [
            'alltracks' => $alltracks,
            'products' => $searchProduct,
            'name' => $name,
            'nav' => 'inform'
        ]);
    }
    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : For call view customer delivery info page
     * Prarameter : no
     * return : View delivery info Blade
     * */
    public function policy()
    {
        Log::channel('cutomerlog')->info('Customer Controller', [
            'start policy'
        ]);

        $msite = new M_Site();
        $policys = $msite->policy();

        $site = new M_Site();
        $name = $site->siteName();

        Log::channel('cutomerlog')->info('Customer Controller', [
            'end policy'
        ]);

        return view('customer.information.policyInfo', ['policys' => $policys, 'name' => $name]);
    }

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : For call view customer policy page
     * Prarameter : no
     * return : View policyInfo Blade
     * */
    public function deliveryDetails()
    {
        Log::channel('cutomerlog')->info('Customer Controller', [
            'start deliveryDetails'
        ]);

        $site = new M_Site();
        $name = $site->siteName();

        $townships = new M_Township();
        $townshipnames = $townships->townshipMoreDetails();

        Log::channel('cutomerlog')->info('Customer Controller', [
            'end deliveryDetails'
        ]);

        return view('customer.information.deliveryInfo', ['name' => $name, 'townships' => $townshipnames]);
    }


    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : For call view customer report page
     * Prarameter : no
     * return : View report Blade
     * */
    public function  report()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start report'
        ]);
        if (session()->has('customerId')) {
            $customerid = session()->get('customerId');
            $order = new T_AD_Order();
            $orderlists = $order->orderId($customerid);

            $site = new M_Site();
            $name = $site->siteName();

            Log::channel('customerlog')->info('Customer Controller', [
                'end report'
            ]);
            return view('customer.feedback.report', ['orderlists' => $orderlists, 'name' => $name]);
        }
        Log::channel('customerlog')->info('Customer Controller', [
            'end report'
        ]);

        return redirect('/home');
    }

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : For call view customer report page
     * Prarameter : no
     * return : View report Blade
     * */
    public function  reportForm(ReportFormValidation $request)
    {
        Log::channel('cutomerlog')->info('Customer Controller', [
            'start reportData'
        ]);

        $validated = $request->validated();
        $report = new T_AD_Report();
        $report->customerReport($validated);

        Log::channel('cutomerlog')->info('Customer Controller', [
            'end reportData'
        ]);
        return redirect('/home');
    }

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : For call view customer report page
     * Prarameter : no
     * return : View report Blade
     * */
    public function  suggest()
    {
        Log::channel('customerlog')->info('CustomerController', [
            'start suggest'
        ]);
        if (session()->has('customerId')) {
            $data = new M_Suggest();
            $type = $data->suggestType();

            $site = new M_Site();
            $name = $site->siteName();

            Log::channel('customerlog')->info('CustomerController', [
                'end suggest'
            ]);
            return view('customer.feedback.suggest', ['types' => $type, 'name' => $name]);
        }
        Log::channel('customerlog')->info('CustomerController', [
            'end suggest'
        ]);
        return redirect('/home');
    }

    /*
     * Create : Min Khant(13/1/2022)
     * Update :
     * Explain of function : To stroe data from suggest form
     * Prarameter : no
     * return :
     * */
    public function suggestForm(SuggestFormValidation $request)
    {
        Log::channel('customerlog')->info('CustomerController', [
            'start suggestForm'
        ]);

        $validated = $request->validated();
        $suggest = new T_AD_Suggest();
        $suggest->customerSuggest($validated);

        Log::channel('customerlog')->info('CustomerController', [
            'end suggestForm'
        ]);

        return redirect('/home');
    }

    /*
     * Create : Min Khant(9/2/2022)
     * Update :
     * Explain of function : For call view customer contact page
     * Prarameter : no
     * return : View contact Blade
     * */
    public function contact()
    {
        Log::channel('customerlog')->info('CustomerController', [
            'start contact'
        ]);

        $site = new M_Site();
        $name = $site->siteName();

        Log::channel('customerlog')->info('CustomerController', [
            'end contact'
        ]);
        return view('customer.feedback.contact', ['name' => $name]);
    }

    /*
    * Create : Min Khant(9/2/2022)
    * Update :
     * * Explain of function : For call view customer contact page
     * * Prarameter : no
     * * return : View contact Blade
     */
    public function contactForm(ContactFormValidation $request)
    {
        Log::channel('customerlog')->info('CustomerController', [
            'start contact'
        ]);
        $validated = $request->validated();
        $tAdContact = new T_AD_Contact();
        $message = $tAdContact->contactForm($validated);

        Log::channel('customerlog')->info('CustomerController', [
            'end contact'
        ]);
        return redirect('/home');
    }
    /*
     * Create : Min Khant(14/1/2022)
     * Update :
     * Explain of function : For call view customer create accoutn page
     * Prarameter : no
     * return : View Register Blade
     * */
    public function signup()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start signup'
        ]);
        if (!session()->has('customerId')) {

            $mstate = new M_State();
            $staenames = $mstate->stateName();

            $mFavType = new M_Fav_Type();
            $types = $mFavType->type();

            $mTaste = new M_Taste();
            $tastenames = $mTaste->taste();

            $site = new M_Site();
            $name = $site->siteName();

            Log::channel('customerlog')->info('Customer Controller', [
                'end signup'
            ]);
            return view('customer.access.register', ['staenames' => $staenames, 'types' => $types, 'tastenames' => $tastenames, 'name' => $name]);
        }
        Log::channel('customerlog')->info('Customer Controller', [
            'end signup'
        ]);
        return redirect('/');
    }

    /*
    * Create : Min Khant(14/1/2022)
    * Update :
    * Explain of function : For call view customer login page
    * Prarameter : no
    * return : redirect login
  */
    public function register(RegisterValidation  $request)
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start register'
        ]);

        $validated = $request->validated();

        //generate key
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $generateKey = '';
        for ($i = 0; $i < 128; $i++) {
            $charLength = rand(0, strlen($characters) - 1);
            $generateKey .= $characters[$charLength];
        }

        //Call T_CU_Customer for insert customer data
        $customer = new T_CU_Customer();
        $createAccount = $customer->customerData($request, $generateKey);

        $msite = new M_Site();
        $siteName = $msite->siteName();
        //send verify mail
        $mail = [
            'name' => $validated['username'],
            'siteName' => $siteName,
            'verifyLink' => $generateKey
        ];
        Mail::to($validated['email'])->send(new VerifyMail($mail));

        Log::channel('customerlog')->info('Customer Controller', [
            'end register'
        ]);

        return redirect('/signin');
    }

    /*
      * Create : Min Khant(19/1/2022)
      * Update :
      * Explain of function : For google login
      * Prarameter :
      * return :
    */
    public function google(Request $req)
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start google'
        ]);


        Log::channel('customerlog')->info('Customer Controller', [
            'end google'
        ]);

        return $req;
    }

    public function getTownship(Request $req)
    {
        Log::channel('customerlog')->info('CustomerController', [
            'start getTownship'
        ]);

        $mTownship = new M_Township();
        $getTownship = $mTownship->townshipName($req['data']);

        Log::channel('customerlog')->info('CustomerController', [
            'end getTownship'
        ]);

        return $getTownship;
    }

    /*
      * Create : Min Khant(16/1/2022)
      * Update :
      * Explain of function : For verify email
      * Prarameter : generate key
      * return :
    */
    public function verifyLink($key)
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start verifyLink'
        ]);

        $link = new M_CU_Customer_Login();
        $verify = $link->updateVerifyCode($key);

        Log::channel('customerlog')->info('Customer Controller', [
            'end verifyLink'
        ]);
        return redirect('/signin');
    }

    /*
      * Create : Min Khant(14/1/2022)
      * Update :
      * Explain of function : For call view customer login page
      * Prarameter : no
      * return : View login Blade
      * */
    public function login()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start login'
        ]);
        if (!session()->has('customerId')) {
            $site = new M_Site();
            $name = $site->siteName();

            Log::channel('customerlog')->info('Customer Controller', [
                'end login'
            ]);

            return view('customer.access.login', ['name' => $name]);
        }
        Log::channel('customerlog')->info('Customer Controller', [
            'end login'
        ]);

        return redirect('/');
    }

    /*
      * Create : Min Khant(14/1/2022)
      * Update :
      * Explain of function : To check email and password
      * Prarameter : no
      * return : View login Blade / check mail blade
     * */
    public function loginForm(LoginValidation $request)
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start loginForm'
        ]);
        $validated = $request->validated();
        $verify = session()->get('verify');
        session()->forget('verify');

        if ($verify == 1) {
            Log::channel('customerlog')->info('Customer Controller', [
                'end loginForm'
            ]);

            return redirect('/');
        }
        session()->forget('customerId');

        Log::channel('customerlog')->info('Customer Controller', [
            'end loginForm'
        ]);

        return redirect('/checkEmail');
    }

    /*
  * Create : Min Khant(19/2/2022)
  * Update :
  * Explain of function : To check verify email
  * Prarameter : no
  * return : View check mail blade
 * */
    public  function checkEmail()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start checkEmail'
        ]);

        $site = new M_Site();
        $name = $site->siteName();

        Log::channel('customerlog')->info('Customer Controller', [
            'end checkEmail'
        ]);
        return view('customer.access.checkMail', ['name' => $name]);
    }

    /*
      * Create : Min Khant(14/1/2022)
      * Update :
      * Explain of function : To logout
      * Prarameter : no
      * return : View home
     * */
    public function logout()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start logout'
        ]);
        session()->forget('customerId');
        session()->forget('cart');

        Log::channel('customerlog')->info('Customer Controller', [
            'end logout'
        ]);

        return redirect('/');
    }

    /*
      * Create : Min Khant(14/1/2022)
      * Update :
      * Explain of function : To logout
      * Prarameter : no
      * return : View home
     * */
    public function getNews()
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start getNews'
        ]);
        $news = new M_AD_News();
        $newsLimited = $news->newsLimited();
        $newsAllToCount = $news->newsAllToCount();

        $newsCount = count($newsAllToCount);
        Log::channel('customerlog')->info('Customer Controller', [
            'end getNews'
        ]);

        return response()
            ->json([
                'limitednews'
                => $newsLimited,
                'alertCount' => $newsCount
            ]);
    }

    /*
      * Create : zayar(07/2/2022)
      * Update :
      * Explain of function : To show message detail page (customer)
      * Prarameter : no
      * return : View message detail page
     * */
    public function messageDetail($id)
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start messageDetail'
        ]);
        $sessionCustomerId = session()->get('customerId');
        $site = new M_Site();
        $name = $site->siteName();

        $message = new T_AD_CoinCharge();
        $find = $message->checkFirst($id, $sessionCustomerId);
        if (count($find) == 0) {
            Log::channel('customerlog')->info("Customer Controller", [
                'End messageDetail(error)'
            ]);

            return view('errors.404');
        }


        $coinmessage = $message->searchMessage($id);
        Log::channel('customerlog')->info('Customer Controller', [
            'end messageDetail'
        ]);
        return view('customer.customerProfile.messageDetail', ['name' => $name, 'message' => $coinmessage, 'nav' => 'inform']);
    }

    /*
      * Create : zayar(07/2/2022)
      * Update :
      * Explain of function : To show message detail page (customer)
      * Prarameter : no
      * return : View message detail page
     * */
    public function trackDetail($id)
    {
        Log::channel('customerlog')->info('Customer Controller', [
            'start trackDetail'
        ]);

        $site = new M_Site();
        $name = $site->siteName();
        $message = new M_AD_Track();
        $coinmessage = $message->searchTrack($id);
        $combine = "";
        $ids = $coinmessage->title;
        $product = new M_Product();
        $searchProduct = $product->searchProduct(explode(',', $ids));

        // $value->title = $searchProduct;
        foreach ($searchProduct as $key => $value) {
            $combine .=  " " . $value->product_name;
        }
        $coinmessage->title = $combine;

        Log::channel('customerlog')->info('Customer Controller', [
            'end trackDetail'
        ]);

        return view('customer.customerProfile.trackDetail', ['name' => $name, 'track' => $coinmessage, 'nav' => 'inform']);
    }



    public function tagsFavType()
    {

        Log::channel('customerlog')->info('Customer Controller', [
            'Start tagsFavType'
        ]);
        $mFavType = new M_Fav_Type();
        $type = $mFavType->tagsType();

        Log::channel('customerlog')->info('Customer Controller', [
            'end tagsFavType'
        ]);
        return $type;
    }
}
