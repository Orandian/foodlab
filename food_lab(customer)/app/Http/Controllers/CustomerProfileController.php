<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileValidation;
use App\Models\M_Fav_Type;
use App\Models\M_Site;
use App\Models\M_State;
use App\Models\M_Taste;
use App\Models\M_Township;
use App\Models\T_CU_Coin_Customer;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerProfileController extends Controller
{
    /** (customer)
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::channel('customerlog')->info("CustomerProfileController", [
            'Start index'
        ]);


        $sessionCustomerId = session()->get('customerId');
        
        $user = new T_CU_Customer();
        $userinfo = $user->loginUser($sessionCustomerId);

        $coin = new T_CU_Coin_Customer();
        $remaincoin = $coin->customerCoin($sessionCustomerId);

        $mTownship = new M_Township();
        $townshipnames = $mTownship->townshipDetails();

        $mstate = new M_State();
        $staenames = $mstate->stateName();
        $site = new M_Site();
        $name = $site->siteName();

        if ($userinfo === null) {
            Log::channel('customerlog')->info("CustomerProfileController", [
                'End index(error)'
            ]);
            return view('errors.404');
        } else {
            Log::channel('customerlog')->info("CustomerProfileController", [
                'End index'
            ]);
            $taste = new M_Taste();
            $tastes = $taste->allTastes();
            $type = new M_Fav_Type();
            $types = $type->allType();
            return view('customer.customerProfile.editProfile', [
                'user' => $userinfo,
                'tastes' => $tastes,
                'types' => $types,
                'name' => $name,
                'townships' => $townshipnames,
                'states' => $staenames,
                'remaincoin' => $remaincoin
            ]);
        }
    }

    // customer 
    public function update(UpdateProfileValidation $request, $id)
    {
        Log::channel('customerlog')->info("CustomerProfileController", [
            'Start update'
        ]);
        $validated = $request->validated();
        $customer = new T_CU_Customer();
        $customer->editProfile($validated, $id);
        Log::channel('customerlog')->info("CustomerProfileController", [
            'End update'
        ]);
        return redirect('editprofile');
    }
}
