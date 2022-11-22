<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_Fav_Type extends Model
{
  public $table = 'm_fav_type';
  use HasFactory;

  /*
    * Create : Aung Min Khant(20/1/2022)
    * Update :
    * Explain of function : To get  all data from m_taste (customer)
    * parament : none
    * return get data
    * */
  public function getTypeAll()
  {

    Log::channel('customerlog')->info("M_Fav_Type Model", [
      'Start getTypeAll'
    ]);
    $mType = M_Fav_Type::all();

    Log::channel('customerlog')->info("M_Fav_Type Model", [
      'End getTypeAll'
    ]);
    return  $mType;
  }

  /*
   * Create:zayar(2022/01/15) 
   * Update: 
   * This function is used to get all favourite type. 
   */

  public function allType()
  {
    Log::channel('customerlog')->info("M_Fav_Type Model", [
      'Start allType'
    ]);
    Log::channel('customerlog')->info("M_Fav_Type Model", [
      'End allType'
    ]);
    return M_Fav_Type::where('del_flg', '=', 0)->get();
  }

  /*
     * Create : Min Khant(24/1/2022)
     * Update :
     * Explain of function : to get fav type data
     * Prarameter : no
     * return : fav type
     * */
  public function type()
  {
    Log::channel('customerlog')->info('M_Fav_Type Model', [
      'start type'
    ]);

    $typenames = M_Fav_Type::where('del_flg', 0)->get();

    Log::channel('customerlog')->info('M_Fav_Type Model', [
      'end type'
    ]);
    return $typenames;
  }

  /*
     * Create : Min Khant(1/2/2022)
     * Update :
     * Explain of function : to get customer fav type id
     * Prarameter : no
     * return : fav type id
     * */
  public function customerFavType($type)
  {
    Log::channel('customerlog')->info('M_Fav_Type Modal', [
      'start type'
    ]);

    $typeId = M_Fav_Type::select('id')
      ->where('favourite_food', $type)
      ->where('del_flg', 0)
      ->first();

    Log::channel('customerlog')->info('M_Fav_Type Modal', [
      'end type'
    ]);
    return $typeId;
  }


  public function tagsType()
  {

    Log::channel('customerlog')->info('M_Fav_Type Model', [
      'start tagsType'
    ]);

    $types = M_Fav_Type::all()->pluck('favourite_food')->toArray();

    Log::channel('customerlog')->info('M_Fav_Type Model', [
      'end tagsType'
    ]);
    return $types;
  }
}
