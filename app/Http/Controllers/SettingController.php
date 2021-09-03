<?php

namespace App\Http\Controllers;
use App\Repositories\ShopRepository;
use App\Repositories\OrderRepository;
use Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $shopRepo;
    protected $orderRepo;

    public function __construct(ShopRepository $shopRepo, OrderRepository $orderRepo)
    {
        $this->middleware(['auth','verified']);
        $this->shopRepo=$shopRepo;
        $this->orderRepo=$orderRepo;
    }
    public function page(){
        $shop_config=Auth::user()->shop;
        return view('setting.page',['shop_config'=>$shop_config]);
    }
    public function member(){
        $shop_config=Auth::user()->shop;
        return view('setting.member',['shop_config'=>$shop_config]);
    }
    public function admin_info(){
        $shop_config=Auth::user()->shop;
        return view('setting.admin_info',['shop_config'=>$shop_config]);
    }
    public function admin_update(Request $request){
        $result=$this->shopRepo->update($request,$request->all());
        if($result){
            return redirect()->route('setting.admin_info')->with('success_msg', '商家資訊已設定！');
        }else{
            return redirect()->route('setting.admin_info')->with('error_msg', '商家資訊設定失敗！');
        }
    }
    public function page_update(Request $request){
        $result=$this->shopRepo->update($request,$request->all());
        if($result){
            return redirect()->route('setting.page')->with('success_msg', '布景已設定！');
        }else{
            return redirect()->route('setting.page')->with('error_msg', '布景設定失敗！');
        }
    }
    public function order(){
        $shop_config=Auth::user()->shop;
        return view('setting.order',['shop_config'=>$shop_config]);
    }
    public function get_order(){
        $order=Auth::user()->shop->order;
        return json_encode($order);
    }
    public function order_edit($id){
        $shop_config=Auth::user()->shop;
        $order=$this->orderRepo->find($id);
        return view('setting.order_edit',['shop_config'=>$shop_config,'order'=>$order,'user'=>Auth::user()]);
    }
    public function order_update(Request $request,$id){
        $result=$this->orderRepo->order_admin_update($request->all(),$id);
        if($result){
            return redirect()->route('setting.order')->with('success_msg', '訂單已更新！');
        }else{
            return redirect()->route('setting.order')->with('error_msg', '訂單更新失敗！');
        }
    }

}
