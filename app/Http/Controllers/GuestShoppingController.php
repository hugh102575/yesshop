<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class GuestShoppingController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo=$userRepo;
    }
    public function init_session($request,$token){
        $user=$this->userRepo->token_index($token);
        $request->session()->put('user', $user);
    }
    public function index(Request $request,$token){
        $this->init_session($request,$token);
        return view('shop.home');
    }
    public function example(Request $request,$token){
        $this->init_session($request,$token);
        return view('shop.example');
    }


}
