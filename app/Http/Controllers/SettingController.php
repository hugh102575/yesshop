<?php

namespace App\Http\Controllers;
use App\Repositories\ShopRepository;
use Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $shopRepo;
    public function __construct(ShopRepository $shopRepo)
    {
        $this->middleware(['auth','verified']);
        $this->shopRepo=$shopRepo;
    }
    public function page(){
        $shop_config=Auth::user()->shop;
        return view('setting.page',['shop_config'=>$shop_config]);
    }
    public function update(Request $request){
        $result=$this->shopRepo->update($request->all());
        if($result){
            return redirect()->route('setting.page')->with('success_msg', '布景已設定！');
        }else{
            return redirect()->route('setting.page')->with('error_msg', '布景設定失敗！');
        }
    }

}
