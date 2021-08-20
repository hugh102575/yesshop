<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\MerchandiseRepository;

class GuestShoppingController extends Controller
{
    protected $userRepo;
    protected $merchanRepo;

    public function __construct(UserRepository $userRepo, MerchandiseRepository $merchanRepo)
    {
        $this->userRepo=$userRepo;
        $this->merchanRepo=$merchanRepo;
    }
    public function init_session($request,$token){
            $user=$this->userRepo->token_index($token);
            $request->session()->put('user', $user);
    }
    public function index(Request $request,$token,$cate_id){
      // $this->init_session($request,$token);
       $user=$this->userRepo->token_index($token);
       return view('shop.index',['user'=>$user,'cate_id'=>$cate_id]);
    }
    public function example(Request $request,$token){
       // $this->init_session($request,$token);
       $user=$this->userRepo->token_index($token);
        return view('shop.example',['user'=>$user]);
    }
    public function login($token){
        $user=$this->userRepo->token_index($token);
        return view('shop.login',['user'=>$user]);
    }
    public function product($token,$id){
        $user=$this->userRepo->token_index($token);
        $product=$this->merchanRepo->find($id);
        return view('shop.product',['user'=>$user,'product'=>$product]);
    }


}
