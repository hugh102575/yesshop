<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class merchandise extends Model
{
    //

    protected $table = 'merchandise';
    public $timestamps = false;

    /** 定義primary key */
    protected $primaryKey = 'id';

    /** primary key是否遞增 */
    public $incrementing = true;

    /** 因key是AI所以不用擺進去 */
    protected $fillable = [
        'Shop_id',
        'Product_Name',
        'Product_Category',
        'Product_Price',
        'Product_Model',
        'Product_Describe',
        'Product_Img',
        //'Product_forSale',

        //'Product_Cost',
        //'Product_Bar',
        //'Stock_Track',
        //'Stock_Amount',
        //'Stock_Lowalert',
        //'Pos_Color',
        //'Pos_Shape',
        'create_from',
        'update_from',
        'created_at',
        'updated_at'
    ];
    public function category(){
        return $this->hasOne('App\Models\category','id','Product_Category');
    }
}
