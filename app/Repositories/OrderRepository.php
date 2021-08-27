<?php

namespace App\Repositories;

use App\Models\order;


class OrderRepository
{
    public function create(array $data){
        $now = date('Y-m-d H:i:s');
        $data['created_at'] = $now;
        return  order::create($data);
    }
}
