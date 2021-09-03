<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MerchandiseRepository;
use App\Repositories\ShopRepository;
use App\Repositories\CategoryRepository;
use App\Models\merchandise;
use Auth;

class MerchandiseController extends Controller
{
    protected $merchanRepo;
    protected $shopRepo;
    protected $cateRepo;

    public function __construct(MerchandiseRepository $merchanRepo, ShopRepository $shopRepo, CategoryRepository $cateRepo)
    {
        $this->middleware(['auth','verified']);
        $this->merchanRepo=$merchanRepo;
        $this->shopRepo=$shopRepo;
        $this->cateRepo=$cateRepo;
    }

    public function menu()
    {
        $shop_menu=Auth::user()->shop->merchandise;
        $shop_category=Auth::user()->shop->category;
        //$shop_category=json_decode($this->shopRepo->get_shop_category(),true);
        if(isset($_GET['success_msg'])){
            return redirect()->route('menu')->with('success_msg', $_GET['success_msg']);
        }elseif(isset($_GET['error_msg'])){
            return redirect()->route('menu')->with('error_msg', $_GET['error_msg']);
        }else{
            return view('merchandise.menu',['shop_menu'=>$shop_menu,'shop_category'=>$shop_category]);
        }
    }
    public function category(){

        //$shop_category=json_decode($this->shopRepo->get_shop_category(),true);
        $shop_category=Auth::user()->shop->category;
        if(isset($_GET['success_msg'])){
            return redirect()->route('category')->with('success_msg', $_GET['success_msg']);
        }elseif(isset($_GET['error_msg'])){
            return redirect()->route('category')->with('error_msg', $_GET['error_msg']);
        }else{
            return view('merchandise.category',['shop_category'=>$shop_category]);
        }

    }
    public function create()
    {   //$shop_category=json_decode($this->shopRepo->get_shop_category(),true);
        $shop_category=Auth::user()->shop->category;
        return view('merchandise.create',['shop_category'=>$shop_category]);
    }
    public function store(Request $request){
        $result=$this->merchanRepo->create($request->all());
        if($result){
            return redirect()->route('menu')->with('success_msg', '商品已創建！');
        }else{
            return redirect()->route('menu')->with('error_msg', '商品創建失敗！');
        }
    }
    public function edit($id){
        $merchan = $this->merchanRepo->find($id);
        if($merchan){
            //$shop_category=json_decode($this->shopRepo->get_shop_category(),true);
            $shop_category=Auth::user()->shop->category;
            return view('merchandise.edit',['merchan'=>$merchan, 'shop_category'=>$shop_category]);
        }else{
            return redirect()->route('menu')->with('error_msg', '商品編輯失敗！');
        }
    }
    public function update(Request $request,$id){
        $result=$this->merchanRepo->update($request->all(),$id);
        if($result){
            return redirect()->route('menu')->with('success_msg', '商品已編輯！');
        }else{
            return redirect()->route('menu')->with('error_msg', '商品編輯失敗！');
        }
    }

    public function delete($id){
        $result=$this->merchanRepo->delete($id);
        /*if($result){
            return redirect()->route('menu')->with('success_msg', '商品已刪除！');
        }else{
            return redirect()->route('menu')->with('error_msg', '商品刪除失敗！');
        }*/
        if($result){
            $return['result']="success";
            $return['msg']="商品已刪除！";
        }else{
            $return['result']="error";
            $return['msg']="商品刪除失敗！";
        }
        return json_encode($return);
    }
    public function category_store(Request $request){
        //dd($request->all());
        $result=$this->cateRepo->store($request->all());
        if($result){
            return redirect()->route('category')->with('success_msg', '類別已創建！');
        }else{
            return redirect()->route('category')->with('error_msg', '類別創建失敗！');
        }
    }
    public function category_update(Request $request,$id){
        //return $this->cateRepo->update($request->all(),$id);
        $result = $this->cateRepo->update($request->all(),$id);
        if($result){
            $return['result']="success";
            $return['msg']="類別已編輯！";
        }else{
            $return['result']="error";
            $return['msg']="類別編輯失敗！";
        }
        return json_encode($return);
    }
    public function category_delete($id){
        $result=$this->cateRepo->delete($id);
        if($result){
            $return['result']="success";
            $return['msg']="類別已刪除！";
        }else{
            $return['result']="error";
            $return['msg']="類別刪除失敗！";
        }
        return json_encode($return);
        /*
        if($result){
            return redirect()->route('category')->with('success_msg', '類別已刪除！');
        }else{
            return redirect()->route('category')->with('error_msg', '類別刪除失敗！');
        }*/
    }
    public function delete_others_img(Request $request){
        //return json_encode($request->all());
        $others_id=$request['others_id'];
        $merchan=$this->merchanRepo->find($request['id']);
        switch($others_id){
            case '1':
                $others_img=$merchan->Product_Img_others_1;
                break;
            case '2':
                $others_img=$merchan->Product_Img_others_2;
                break;
            case '3':
                $others_img=$merchan->Product_Img_others_3;
                break;
            case '4':
                $others_img=$merchan->Product_Img_others_4;
                break;
        }
        $result=$this->merchanRepo->delete_others_img($request['id'],$others_img,$others_id);
        return json_encode($result);
    }
}
