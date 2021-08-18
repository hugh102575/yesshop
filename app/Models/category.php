<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //

    protected $table = 'category';
    public $timestamps = false;

    /** 定義primary key */
    protected $primaryKey = 'id';

    /** primary key是否遞增 */
    public $incrementing = true;

    /** 因key是AI所以不用擺進去 */
    protected $fillable = [
        'Category_Name',
        'Shop_id',
        'create_from',
        'update_from',
        'created_at',
        'updated_at'
    ];
    public function merchandise(){
        return $this->hasMany('App\Models\merchandise','Product_Category','id');
    }
}
