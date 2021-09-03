<?php

namespace App\Repositories;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberRepository
{
    public function login(array $data){
        $now = date('Y-m-d H:i:s');
        $result=false;
        $member = Member::where('account',$data['account'])->where('Shop_id',$data['Shop_id'])->first();
        if($member){
            if (Hash::check($data['password'], $member->password)){
                $member->update(array('last_login' => $now));
                $result=$member;
            }
        }
        return $result;
    }
    public function create(array $data){
        $now = date('Y-m-d H:i:s');
        $data['password']=Hash::make($data['password']);
        $data['created_at'] = $now;
        $data['last_login']=$now;
        return  Member::create($data);
    }
    public function update(array $data,$id){
        $now = date('Y-m-d H:i:s');
        if(isset($data['member_name'])){
            $data['name']=$data['member_name'];
        }
        $data['updated_at'] = $now;
        $me = Member::find($id);
        return  $me ? $me->update($data) : false;
    }
}
