
@extends('layouts.app_shop')

<title>{{$user->shop->Shop_Name}}</title>

<!--
商店的主要模板
用來放商店每一頁都會出現的東西，例如nav,sidebar等等
-->
@section('app_css')
    @yield('css')
@endsection

@section('body_bg_img')


    <body class="" style="background-image: url('{{$user->shop->bg_img}}');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;background-color: rgba(255, 255, 255, 0.3);
    background-blend-mode: overlay;">




@endsection


@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand ml-3" href="#">{{$user->shop->Shop_Name}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
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
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜尋</button>
        </form>
      </li>

    </ul>
    <button class="btn btn-link text-primary"><i class="fas fa-shopping-cart nav-item"> 購物車</i></button>
  </div>
</nav>



<div class="container-fluid py-4 px-5">
    <div class="row">
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
                        @foreach($user->shop->category as $c)
                        <div class="form-group">
                            <a href="#" class="test-primary">{{$c->Category_Name}}</a>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>



        </div>
        <div class="col-sm-10 text-center ">

            @yield('stage')
        </div>
    </div>
</div>

@endsection
<body>

@section('app_js')
    @yield('js')
@endsection
