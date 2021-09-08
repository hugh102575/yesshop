@extends('shop.home')


@section('css')
<style>

</style>
@endsection


@section('stage')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow  ">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-fill nav-justified" id="ioTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="out-tab" data-toggle="tab" href="#out" role="tab" aria-controls="out" aria-selected="true">登入</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="in-tab" data-toggle="tab" href="#in" role="tab" aria-controls="in" aria-selected="true">註冊</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="ioContent">
                        <div class="tab-pane fade show active" id="out" role="tabpanel" aria-labelledby="out-tab">
                        <form action="/shop/{{$user->api_token}}/login" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mt-5">
                            <div class="form-group row">
                                <label for="account" class="col-md-4 col-form-label text-md-right">帳號</label>

                                <div class="col-md-6">
                                    <input id="account" type="account" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" autofocus>

                                    @error('account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <input class="hidden_object" name="Shop_id" value="{{$user->Shop_id}}">

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary float-left mt-3">
                                        {{--{{ __('Login') }}--}}
                                         登入
                                    </button>

                                    {{--@if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif--}}
                                </div>
                            </div>
                            </div>
                        </form>
                        </div>




                        <div class="tab-pane fade" id="in" role="tabpanel" aria-labelledby="in-tab">
                        <form action="/shop/{{$user->api_token}}/register" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mt-5">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="account" class="col-md-4 col-form-label text-md-right">帳號</label>

                                    <div class="col-md-6">
                                        <input id="account" type="account" class="form-control" name="account" value="{{ old('account') }}" required autocomplete="account">

                                        @error('account')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <input class="hidden_object" name="Shop_id" value="{{$user->Shop_id}}">

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary float-left mt-3">
                                            {{--{{ __('Register') }}--}}
                                            註冊
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const error_type = urlParams.get('error_type')
    if(error_type!=null){
        console.log('error_type',error_type)
        if(error_type=='register_failed'){
            $('#in-tab').click();
        }else if(error_type=='login_failed'){
            $('#out-tab').click();
        }
    }


</script>
@endsection
