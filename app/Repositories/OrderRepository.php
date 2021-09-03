<?php

namespace App\Repositories;

use App\Models\order;


class OrderRepository
{
    public function find($id){
        return  order::find($id);
    }
    public function create(array $data){
        $now = date('Y-m-d H:i:s');
        $data['created_at'] = $now;
        return  order::create($data);
    }
    public function order_received($id){
        $now = date('Y-m-d H:i:s');
        $data['updated_at']=$now;
        //$data['finished_status']='1';
        $data['received_status']='1';
        $data['shipped_status']='1';
        $order = order::find($id);
        return  $order ? $order->update($data) : false;
    }
    public function order_admin_update(array $data,$id){
        if($data['select_payed_status']=='1'){
            $data['payed_status']='1';
            $data['payed_pending']='0';
        }else{
            $data['payed_status']='0';
        }

        if($data['select_shipped_status']=='1'){
            $data['shipped_status']='1';
        }else{
            $data['shipped_status']='0';
        }

        if($data['select_finished_status']=='1'){
            $data['finished_status']='1';
        }else{
            $data['finished_status']='0';
        }

        $order = order::find($id);
        return  $order ? $order->update($data) : false;
    }
    public function order_payed($payed_card,$id){
        $now = date('Y-m-d H:i:s');
        $data['updated_at']=$now;
        $data['payed_card']=$payed_card;
        $data['payed_pending']='1';
        $order = order::find($id);
        return  $order ? $order->update($data) : false;
    }

    public function get_my_order($id,$Shop_id){
        $my_order = order::where('Member_id',$id)->where('Shop_id',$Shop_id)->get();
        return $my_order;
    }


}
