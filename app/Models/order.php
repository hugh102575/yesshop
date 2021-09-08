<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //

    protected $table = 'orders';
    public $timestamps = false;

    /** 定義primary key */
    protected $primaryKey = 'id';

    /** primary key是否遞增 */
    public $incrementing = true;

    /** 因key是AI所以不用擺進去 */
    protected $fillable = [
        'Shop_id',
        'Member_id',
        'order_content',
        'order_name',
        'order_address',
        'order_phone',
        'order_email',
        'order_memo',
        'order_shipping',
        'order_price',
        'payed_status',
        'payed_pending',
        'payed_card',
        'shipped_status',
        'received_status',
        'finished_status',
        'created_at',
        'updated_at'
    ];

}
