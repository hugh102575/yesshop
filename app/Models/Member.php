<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    protected $table = 'member';
    public $timestamps = false;

    /** 定義primary key */
    protected $primaryKey = 'id';

    /** primary key是否遞增 */
    public $incrementing = true;

    protected $fillable = [
        'name',
        //'email',
        'account',
        'password',
        'Shop_id',
        'last_login',
        'created_at',
        'updated_at',
        'member_address',
        'member_phone',
        'member_email',
        'unfinished_cart'
    ];



}
