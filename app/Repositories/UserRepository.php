<?php

namespace App\Repositories;

use App\Models\User;
use Auth;

class UserRepository
{
    public function token_index($token){
        return User::where('api_token',$token)->first();
    }
}
