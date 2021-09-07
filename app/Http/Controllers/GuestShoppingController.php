<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\MerchandiseRepository;
use App\Repositories\MemberRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use DB;
use Illuminate\Support\Facades\Mail;

class GuestShoppingController extends Controller
{
    protected $userRepo;
    protected $merchanRepo;
    protected $memberRepo;
    protected $orderRepo;

    public function __construct(UserRepository $userRepo, MerchandiseRepository $merchanRepo, MemberRepository $memberRepo, OrderRepository $orderRepo)
    {
        $this->userRepo=$userRepo;
        $this->merchanRepo=$merchanRepo;
        $this->memberRepo=$memberRepo;
        $this->orderRepo=$orderRepo;
    }
    public function init_session($request,$key,$value){
        $request->session()->put($key, $value);
    }
    public function forget_session($request,$key){
        $request->session()->forget($key);
    }
    public function index($token,$cate_id){
        $user=$this->userRepo->token_index($token);
        return view('shop.index',['user'=>$user,'cate_id'=>$cate_id]);
    }
    public function index_($token){
        return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
    }
    public function index_all($token){
        return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
    }
    public function login_form($token){
        $user=$this->userRepo->token_index($token);
        if(request()->session()->has('member')&&request()->session()->get('member')->Shop_id==$user->Shop_id){
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
        }
        $user=$this->userRepo->token_index($token);
        return view('shop.login',['user'=>$user,'error_type'=>null]);
    }
    public function logout($token){
        $member=session()->get('member');
        $unfinished_id=$member['id'];
        $unfinished_cart = $member['cart'];
        $result=$this->memberRepo->save_unfinished_cart($unfinished_cart,$unfinished_id);
        $this->forget_session(request(),'member');
        return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all'])->with('success_msg', '您已登出！');;
    }
    public function product($token,$id){
        $user=$this->userRepo->token_index($token);
        $product=$this->merchanRepo->find($id);
        return view('shop.product',['user'=>$user,'product'=>$product]);
    }
    public function register(Request $request,$token){
        $user=$this->userRepo->token_index($token);

        Validator::extend('costomunique', function ($attribute, $value, $parameters, $validator) {
            $count = DB::table('member')->where('account', request()->input('account'))
                                        ->where('Shop_id', request()->input('Shop_id'))
                                        ->count();

            return $count === 0;
        }, '該帳號已被註冊');

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
           /* 'email' => ['required', 'string', 'email', 'max:255',
            'unique:member'], */
            //'email' => ['required', 'string', 'email', 'max:255'],
            //'email'=>"costomunique:{$request}",
            'account' => ['required', 'string', 'min:8', "costomunique:{$request}"],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('shop.login_form', ['api_token'=>$token, 'error_type'=> 'register_failed' ])
                    ->with('error_validation',$validator->errors())
                    ->withInput();
        }

        $result=$this->memberRepo->create($request->all());
        if($result){
            event(new Registered($result));
            $this->init_session($request,'member',$result);
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all'])->with('success_msg', ' 歡迎光臨！'.$result->name);
        }

    }
    public function login(Request $request,$token){
        //dd($request->all());
        $user=$this->userRepo->token_index($token);

        $member=$this->memberRepo->login($request->all());
        if($member){
            $me=$this->memberRepo->find($member['id']);
            if(isset($me['unfinished_cart'])){
                $member['cart']=$me['unfinished_cart'];
            }else{
                $member['cart']=null;
            }
            $this->init_session($request,'member',$member);
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all'])->with('success_msg', ' 歡迎光臨！'.$member->name);
        }else{
            return redirect()->route('shop.login_form', ['api_token'=>$token, 'error_type'=> 'login_failed'])
                ->with('error_msg','登入失敗！帳號或密碼錯誤')
                ->withInput();

        }
    }
    public function cart($token){
        $user=$this->userRepo->token_index($token);
        if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id){
        }else{
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
        }
        return view('shop.cart',['user'=>$user]);
    }
    public function add_cart(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id){
           $member=session()->get('member');
           $cart_a=array();
           unset($request['_token']);
           if(!isset($member['cart'])){
                array_push($cart_a,$request->all());
                $member['cart']=json_encode($cart_a);
           }else{
                foreach(json_decode($member['cart'],true) as $buy){
                    array_push($cart_a,$buy);
                }
                array_push($cart_a,$request->all());
                $member['cart']=json_encode($cart_a);
           }
           $this->init_session($request,'member',$member);
           return json_encode('updated_cart');
        }else{
            return json_encode('not_login');
        }

    }
    public function del_cart(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        $del_id=$request['del_id'];
        $del_index=$request['del_index'];
        $cart_a=array();
        $member=session()->get('member');
        $cart_count=0;
        foreach(json_decode($member['cart'],true) as $buy){
            if($buy['buy_id']!=$del_id || $cart_count!=$del_index ){
                array_push($cart_a,$buy);
            }
            $cart_count++;
        }
        if(count($cart_a)!=0){
            $member['cart']=json_encode($cart_a);
        }else{
            $member['cart']=null;
        }

        $this->init_session($request,'member',$member);
        return json_encode('deleted_cart');
    }
    public function update_cart(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        $update_id=$request['update_id'];
        $update_index=$request['update_index'];
        $update_type=$request['update_type'];
        $member=session()->get('member');
        if($update_type=='number'){
            $update_number=$request['update_number'];
            $per_price=$request['per_price'];
        }elseif($update_type=='model'){
            $update_model=$request['update_model'];
        }

        $cart_a=array();
        $cart_count=0;
        foreach(json_decode($member['cart'],true) as $buy){
            if($buy['buy_id']==$update_id  && $cart_count==$update_index){
                if($update_type=='number'){
                    $buy['buy_quantity']=$update_number;
                    $buy['buy_price']=$update_number * $per_price;
                }elseif($update_type=='model'){
                    $buy['buy_model']=$update_model;
                }
            }
            array_push($cart_a,$buy);
            $cart_count++;
        }
        $member['cart']=json_encode($cart_a);
        $this->init_session($request,'member',$member);
        return json_encode('updateed_cart');
    }

    public function checkout(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id){
        }else{
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
        }
        return view('shop.checkout',['user'=>$user]);
    }

    public function order(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        $member=session()->get('member');
        $request['Shop_id']=$user->Shop_id;
        $request['Member_id']=$member['id'];
        $request['order_content'] = $member['cart'];
        $result=$this->orderRepo->create($request->all());
        $member['cart']=null;
        if($result){
            $this->init_session($request,'member',$member);
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all'])->with('success_msg', '訂購成功！請在「訂單查詢」確認');
        }else{
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all'])->with('error_msg', '訂購失敗！麻煩請再試一次');
        }
    }
    public function order_update(Request $request,$token,$id){
        //dd($request->all());
        $result=false;
        if(isset($request['order_received_btn'])){
            $result=$this->orderRepo->order_received($id);
        }
        if(isset($request['order_payed_btn'])){
            $payed_card=$request['payed_card'];
            $result=$this->orderRepo->order_payed($payed_card,$id);
        }
        if($result){
            if(isset($request['order_received_btn'])){
                return redirect()->route('shop.order', ['api_token'=>$token])->with('success_msg', '已通知商家收到貨了！');
            }
            if(isset($request['order_payed_btn'])){
                return redirect()->route('shop.order', ['api_token'=>$token])->with('success_msg', '已經通知商家我已付款了！');
            }
        }else{
            return redirect()->route('shop.order', ['api_token'=>$token])->with('error_msg', '訂單狀態更新失敗！');
        }
    }

    public function my_order(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        $my_id=null;
        if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id){
            $my_id=session()->get('member')->id;
            $my_order=$this->orderRepo->get_my_order($my_id,$user->Shop_id);
        }else{
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
        }
        return view('shop.order',['user'=>$user,'my_order'=>$my_order]);

    }

    public function my_info(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id){
        }else{
            return redirect()->route('shop.index', ['api_token'=>$token, 'cate_id'=> 'all']);
        }
        return view('shop.info',['user'=>$user]);
    }
    public function my_update(Request $request,$token){
        $user=$this->userRepo->token_index($token);
        $my_id=session()->get('member')->id;
        $result=$this->memberRepo->update($request->all(),$my_id);
        if($result){
            $member=session()->get('member');
            $member['name']=$request['member_name'];
            $member['member_address']=$request['member_address'];
            $member['member_phone']=$request['member_phone'];
            $member['member_email']=$request['member_email'];
            $this->init_session($request,'member',$member);
            return redirect()->route('shop.my_info', ['api_token'=>$token, 'cate_id'=> 'all'])->with('success_msg', '會員資料已更新！');
        }else{
            return redirect()->route('shop.my_info', ['api_token'=>$token, 'cate_id'=> 'all'])->with('error_msg', '會員資料更新失敗！');
        }
    }


    /*public function example($token){
        $user=$this->userRepo->token_index($token);
        return view('shop.example',['user'=>$user]);
    }
    public function verify($token){
        $user=$this->userRepo->token_index($token);
        return view('shop.email_verify',['user'=>$user]);
    }
    public function resend($token){
        $user=$this->userRepo->token_index($token);
    }*/



}
