@extends('layouts.app')
<title>{{ Auth::user()->shop->Shop_Name }}</title>
<!--
後台的主要模板
-->
@section('app_css')
<link href="{{asset('vendor/collapsible-sticky-sidebar-nav-next/css/perfect-scrollbar.css')}}" rel="stylesheet">
<link href="{{asset('vendor/collapsible-sticky-sidebar-nav-next/css/next-sidebar.css')}}" rel="stylesheet">
<style>
.hidden_object{
    display: none;
}
.vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
.stay-open {display:block ;}
.enlarge_text{
    font-size: x-large !important;
}
</style>
@yield('css')
@endsection

@section('body_bg_img')
<body id="back_home_body"class="app" style="background-image: url('{{asset('img/graphs-job-laptop-papers-590016.jpg')}}');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;background-color: rgba(255, 255, 255, 0.5);
  background-blend-mode: overlay;"><!-- class: is-collapsed-->
@endsection

@section('content')

<div class="sidebar">
  <div class="sidebar-inner">
    <ul class="sidebar-menu scrollable position-relative pt-3">
      <li id="close_sidebar_btn" class="nav-item dropdown hidden_object pb-3">
        <a  class="sidebar-toggle nav-link " href="#">
          <i class="far fa-times-circle"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#">
          <span class="icon-holder">
            <i class="fas fa-home"></i>
          </span>

          <span class="title">{{ Auth::user()->shop->Shop_Name }}</span>
          <span class="arrow">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>

        @php
        if(preg_match('(setting.page|setting.admin_info|setting.order|setting.member)', Route::currentRouteName()) === 1) {
            $setting_dropdown=true;
        }else{
            $setting_dropdown=false;
        }
        @endphp
        @if($setting_dropdown)
        <ul class="dropdown-menu stay-open">
        @else
        <ul class="dropdown-menu">
        @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#">
              <span><a href="{{route('setting.admin_info')}}" class="{{ (str_contains(Route::currentRouteName(),'setting.admin_info')) ? 'text-success enlarge_text' : '' }}">商家資訊</a></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#">
              <span><a href="{{route('setting.order')}}" class="{{ (str_contains(Route::currentRouteName(),'setting.order')) ? 'text-success enlarge_text' : '' }}">訂單管理</a></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#">
              <span><a href="{{route('setting.member')}}" class="{{ (str_contains(Route::currentRouteName(),'setting.member')) ? 'text-success enlarge_text' : '' }}">會員一覽</a></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#">
              <span><a href="{{route('setting.page')}}" class="{{ (str_contains(Route::currentRouteName(),'setting.page')) ? 'text-success enlarge_text' : '' }}">布景設定</a></span>
            </a>
          </li>
        </ul>

      </li>

      <!--<li class="nav-item dropdown">
        <a class="nav-link " href="#">
          <span class="icon-holder">
            <i class="fas fa-chart-bar"></i>
          </span>
          <span class="title">報告</span>
          <span class="arrow">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
        <ul class="dropdown-menu">

        </ul>
      </li>-->


      <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle " href="#">
          <span class="icon-holder">
            <!--<i class="fas fa-folder-plus"></i>-->
            <i class="fas fa-tag"></i>
          </span>
          <span class="title">商品</span>
          <span class="arrow">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>

        @php
        if(preg_match('(menu|category)', Route::currentRouteName()) === 1) {
            $merchandise_dropdown=true;
        }else{
            $merchandise_dropdown=false;
        }
        @endphp
        @if($merchandise_dropdown)
        <ul class="dropdown-menu stay-open">
        @else
        <ul class="dropdown-menu">
        @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#">
              <span><a href="{{ route('menu') }}" class="{{ (str_contains(Route::currentRouteName(),'menu')) ? 'text-success enlarge_text' : '' }}">商品列表</a></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
              <span><a href="{{ route('category') }}" class="{{ (str_contains(Route::currentRouteName(),'category')) ? 'text-success enlarge_text' : '' }}">類別</a></span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<div class="container-wide">
  <nav class="navbar navbar-expand navbar-light bg-success">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a id="sidebar-toggle" class="sidebar-toggle  nav-link" href="#">
          <i class="fas fa-bars text-light"></i>
        </a>
      </li>
      <li class="nav-item" >
        <!--<a class="nav-link text-light" href="#" id='nav_title'></a>-->
        <h3 class="nav-link text-light "  id='nav_title'></h3>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>-->

    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item" >
            <a class="nav-link text-light" href="{{route('setting.order')}}" id='nav_order'>訂單<span class="badge badge-danger badge-counter" id="update_order"><span class="hidden_object"></span></span></a>
        </li>
        <li class="nav-item dropdown ">
        <a class="nav-link text-light mx-3" href="/shop/{{Auth::user()->api_token}}/index/all" target="_blank" ><i class="fas fa-globe"></i> 前往前台</a>
        </i>
        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user text-light"></i>&nbsp;&nbsp;{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
        </li>
    </ul>
  </nav>


  <div class="container py-4">
    <div class="row justify-content-center">

        @yield('stage')
    </div>
</div>


</div>
@endsection

@section('app_js')
<script src="{{asset('vendor/collapsible-sticky-sidebar-nav-next/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('vendor/collapsible-sticky-sidebar-nav-next/js/next-sidebar.js')}}"></script>

<script>
function change_toggle(){
    const max_width=991;
    if(window.innerWidth<=max_width){
        $('#close_sidebar_btn').show();

    }else{
        $('#close_sidebar_btn').hide();

    }
}
change_toggle();
var toggle=document.getElementById('sidebar-toggle');
toggle.addEventListener('click', function(event){
    change_toggle();
});
window.addEventListener('resize', function(event){
    change_toggle();
});

function ajax_get_order(){
    $.ajax({
        type:'GET',
        url:'/setting/get_order',
        dataType:"json",
        success:function(data){
            var new_order_count=0;
            data.forEach(function(item,index){
                if(item.finished_status != '1'){
                    new_order_count++;
                }
            });

            if(document.getElementById('update_order').innerHTML != new_order_count){
                document.getElementById('update_order').innerHTML=new_order_count;
            }
        },
        error:function(e){
        }
    });
}

ajax_get_order();
const time_interval=1000*3; //毫秒
    setInterval(function(){
        ajax_get_order();
    }, time_interval);

</script>
@yield('js')
@endsection
