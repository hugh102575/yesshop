
@extends('layouts.app_shop')

<title>{{$user->shop->Shop_Name}}</title>

<!--
商店的主要模板
用來放商店每一頁都會出現的東西，例如nav,sidebar等等
-->
@section('app_css')
<style>
.hidden_object{
    display: none;
}
.enlarge_text{
    font-size: x-large !important;
}
form {
   display:inline;
   margin:0;
   padding:0;
}
</style>
    @yield('css')
@endsection

@section('body_bg_img')


    <body class="" style="background-image: url('{{$user->shop->bg_img}}');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;background-color: rgba(255, 255, 255, 0.3);
    background-blend-mode: overlay;">




@endsection


@section('content')

{{--@if(  session()->has('member') && session()->get('member')->email_verified_at==null  )
    @if(!str_contains(Route::currentRouteName(),'verify'))
    <meta http-equiv="refresh" content="0; url=/shop/{{$user->api_token}}/email/verify" />
    @endif
@endif--}}
<nav class="navbar navbar-expand-lg navbar-light bg-dark">

  <a class="navbar-brand ml-3 text-light" href="/shop/{{$user->api_token}}/index/all">
  <i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;{{$user->shop->Shop_Name}}


    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <div class="btn btn-success"><span class="navbar-toggler-icon"></span></div>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!--<li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>-->
      <li class="nav-item ">
        <form class="form-inline ml-5 my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="尋找商品" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">搜尋</button>
        </form>
      </li>

    </ul>




    @if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id)
    <form action="/shop/{{$user->api_token}}/cart" method="GET">
    <button class="btn btn-link text-success mr-3"><i class="fas fa-shopping-cart"> 購物車<span class="badge badge-danger badge-counter" id="cart_count">
        @if(isset(session()->get('member')->cart))
            @php
            $cart_count=count(session()->get('member')->cart);
            @endphp
            {{$cart_count}}
        @endif

        </span></i>
    </button>
    </form>
        {{--<a class="nav-link" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
          <span class="badge badge-danger badge-counter" id="littlebell_count">6</span>
        </a>--}}
    <div id="navbarDropdown" class="btn btn-link text-light mr-3 nav-item dropdown">
    <!--<li class="nav-item dropdown">-->
                                <a id="navbarDropdown" class="nav-item dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ session()->get('member')->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        會員中心
                                    </a>
                                    <a class="dropdown-item" href="/shop/{{$user->api_token}}/logout"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="/shop/{{$user->api_token}}/logout" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            <!--</li>-->
                            </div>
    @else
    <form action="/shop/{{$user->api_token}}/login_form" method="GET">
        <button class="btn btn-link text-light mr-3">登入</button>
    </form>
    @endif


  </div>
</nav>



<div class="container-fluid py-4 px-5">




    <div class="row justify-content-center">
        <div class="col-sm-2  text-center ">
            <div class="card">
                <div class="card-body ">
                    <div class="form-group">
                        <label class="font-weight-bold">類別</label>
                    </div>
                    <div class="form-group"><hr></div>
                    @if(count($user->shop->category)==0)
                        <label>類別尚未建立</label>
                    @else
                        <div class="form-group">
                            @if(str_contains(Route::currentRouteName(),'index'))
                            <a href="#" class="test-primary my_category" id="c_all">全部</a>
                            @else
                            <a href="/shop/{{$user->api_token}}/index/all" class="test-primary my_category" id="c_all">全部</a>
                            @endif
                        </div>

                        @foreach($user->shop->category as $c)
                        <div class="form-group">
                            @if(str_contains(Route::currentRouteName(),'index'))
                            <a href="#" class="test-primary my_category" id="c_{{$c->id}}" >{{$c->Category_Name}}</a>
                            @else
                            <a href="/shop/{{$user->api_token}}/index/{{$c->id}}" class="test-primary my_category" id="c_{{$c->id}}" >{{$c->Category_Name}}</a>
                            @endif


                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-10 text-center ">
            {{--{{ session()->get('member') }}--}}
            @if(session()->has('success_msg'))
                <div class="alert alert-success">
                    {{ session()->get('success_msg') }}
                </div>
            @endif
            @if(session()->has('error_msg'))
                <div class="alert alert-danger">
                    {{ session()->get('error_msg') }}
                </div>
            @endif
            @if(session()->has('other_msg'))
                <div class="alert alert-secondary">
                    {{ session()->get('other_msg') }}
                </div>
            @endif
            @if(session()->has('error_validation'))
                @php
                $error_validation=json_decode(session()->get('error_validation'),true);
                @endphp

                @foreach($error_validation as $error_v)

                    @php
                    //$error_v = str_replace("The email has already been taken.", "該email已被註冊", $error_v);
                    $error_v = str_replace("The account must be at least 8 characters.", "帳號至少需8個字元", $error_v);
                    $error_v = str_replace("The password must be at least 8 characters.", "密碼至少需8個字元", $error_v);
                    $error_v = str_replace("The password confirmation does not match.", "確認密碼不相符", $error_v);


                    @endphp
                    @if(count($error_v)==1)
                        <div class="alert alert-danger">
                        {{$error_v[0]}}
                        </div>
                    @else
                        @foreach($error_v as $e_v)
                        <div class="alert alert-danger">
                        {{$e_v}}
                        </div>
                        @endforeach
                    @endif


                @endforeach

            @endif
        @yield('stage')
        </div>
    </div>
</div>

@endsection
<body>

@section('app_js')
<script>

</script>
    @yield('js')
@endsection
