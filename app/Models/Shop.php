<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    //

    protected $table = 'shop';
    public $timestamps = false;

    /** 定義primary key */
    protected $primaryKey = 'id';

    /** primary key是否遞增 */
    public $incrementing = true;

    /** 因key是AI所以不用擺進去 */
    protected $fillable = [
        'Shop_Name',
        //'secret_key',
        'create_from',
        'update_from',
        'created_at',
        'updated_at',
        'bg_img'
        //'Category'
    ];

    public function merchandise(){
        return $this->hasMany('App\Models\merchandise','Shop_id','id');
    }
    public function category(){
        return $this->hasMany('App\Models\category','Shop_id','id');
    }
    public function User(){
        return $this->hasOne('App\Models\User','Shop_id','id');
    }

}
