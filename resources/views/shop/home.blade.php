
@extends('layouts.app_shop')

@if(session()->has('user'))
<title>{{Session::get('user')->shop->Shop_Name}}</title>
@else
<title>{{ config('app.name', 'Laravel') }}</title>
@endif

@section('app_css')
    @yield('css')
@endsection

@section('body_bg_img')

    @if(session()->has('user'))
    <body class="app is-collapsed" style="background-image: url('{{Session::get('user')->shop->bg_img}}');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;background-color: rgba(255, 255, 255, 0.3);
    background-blend-mode: overlay;">
    @else
    <body class="app is-collapsed" style="background-image: url('{{asset('img/graphs-job-laptop-papers-590016.jpg')}}');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;background-color: rgba(255, 255, 255, 0.3);
    background-blend-mode: overlay;">
    @endif

@endsection


@section('content')
    @if(session()->has('user'))
    <div class="container py-4">
        <div class="row justify-content-center">
        @foreach(Session::get('user')->shop->merchandise as $m)
            <div class="card">
            <div class="card-body">
                <label class="form-group row">{{$m->Product_Name}}</label>
                <img src="{{$m->Product_Img}}" class="form-group row" style="max-height: 20rem; max-width: 20rem;">
                <label class="form-group row">{{$m->Product_Price}}</label>
            </div>
            </div>
        @endforeach

        @yield('stage')

        </div>
    </div>
    @else
    @endif
@endsection
<body>

@section('app_js')
    @yield('js')
@endsection
